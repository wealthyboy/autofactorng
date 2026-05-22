<?php

namespace App\Http\Controllers\Admin\InDrive;

use App\Http\Controllers\Controller;
use App\Http\Helper;
use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\User;
use App\Models\UserTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class InDriveOrdersController extends Controller
{
    public function index(Request $request)
    {
        User::canTakeAction(User::canAccessAdminUsers);

        $drivers = $this->driversQuery($request)
            ->latest('users.created_at')
            ->paginate(50)
            ->appends($request->query());

        $driverRows = $drivers->getCollection()->map(fn (User $driver) => $this->driverRow($driver, $request));
        $drivers->setCollection($driverRows);

        return view('admin.indrive-orders.index', [
            'drivers' => $drivers,
            'filters' => $request->only(['q', 'from', 'to', 'fulfillment', 'status']),
            'stats' => $this->overviewStats($request),
        ]);
    }

    public function show(Request $request, $id)
    {
        User::canTakeAction(User::canAccessAdminUsers);

        $driver = User::query()
            ->where('is_indrive_customer', true)
            ->findOrFail($id);

        $orders = $this->ordersQuery($request)
            ->where('user_id', $driver->id)
            ->with('ordered_products')
            ->latest()
            ->paginate(25)
            ->appends($request->query());

        $visits = $this->driverTrackingQuery($driver, $request)
            ->latest('visited_at')
            ->paginate(50, ['*'], 'visits_page')
            ->appends($request->query());

        return view('admin.indrive-orders.show', [
            'driver' => $driver,
            'orders' => $orders,
            'visits' => $visits,
            'row' => $this->driverRow($driver, $request),
            'filters' => $request->only(['from', 'to', 'fulfillment', 'status']),
        ]);
    }

    public function export(Request $request): StreamedResponse
    {
        User::canTakeAction(User::canAccessExport);

        $filename = 'indrive-orders-' . now()->format('Y-m-d-His') . '.csv';

        return response()->streamDownload(function () use ($request) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'Driver ID',
                'Name',
                'Email',
                'Phone',
                'inDrive Driver ID',
                'Clicks',
                'Website Visits',
                'Location',
                'Delivery Orders',
                'Pickup Orders',
                'Order Count',
                'Order Value',
                'Top Purchased Item',
                'Returned Items',
            ]);

            $this->driversQuery($request)
                ->latest('users.created_at')
                ->chunk(250, function ($drivers) use ($handle, $request) {
                    foreach ($drivers as $driver) {
                        $row = $this->driverRow($driver, $request);

                        fputcsv($handle, [
                            $driver->id,
                            $driver->fullname(),
                            $driver->email,
                            $driver->phone_number,
                            $driver->indrive_driver_id,
                            $row['clicks'],
                            $row['website_visits'],
                            $row['location'],
                            $row['delivery_orders'],
                            $row['pickup_orders'],
                            $row['order_count'],
                            $row['order_value_raw'],
                            $row['top_purchased_item'],
                            $row['returned_items'],
                        ]);
                    }
                });

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }

    protected function driversQuery(Request $request)
    {
        $query = User::query()
            ->where('is_indrive_customer', true)
            ->where(function ($q) {
                $q->where('type', 'subscriber')
                    ->orWhereNull('type');
            });

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('indrive_driver_id', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        if ($this->hasOrderFilters($request)) {
            $query->whereHas('orders', fn ($q) => $this->applyOrderFilters($q, $request));
        }

        return $query;
    }

    protected function ordersQuery(Request $request)
    {
        return $this->applyOrderFilters(
            Order::query()->where('is_indrive_order', true),
            $request
        );
    }

    protected function trackingQuery(Request $request)
    {
        $query = UserTracking::query()->where('is_indrive', true);

        if ($from = $request->get('from')) {
            $query->whereDate('visited_at', '>=', $from);
        }

        if ($to = $request->get('to')) {
            $query->whereDate('visited_at', '<=', $to);
        }

        return $query;
    }

    protected function applyOrderFilters($query, Request $request)
    {
        if ($from = $request->get('from')) {
            $query->whereDate('created_at', '>=', $from);
        }

        if ($to = $request->get('to')) {
            $query->whereDate('created_at', '<=', $to);
        }

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        if ($request->get('fulfillment') === 'pickup') {
            $query->where('zone', 'Pickup');
        }

        if ($request->get('fulfillment') === 'delivery') {
            $query->where(function ($q) {
                $q->whereNull('zone')
                    ->orWhere('zone', '!=', 'Pickup');
            });
        }

        return $query;
    }

    protected function hasOrderFilters(Request $request): bool
    {
        return $request->filled('from')
            || $request->filled('to')
            || $request->filled('status')
            || $request->filled('fulfillment');
    }

    protected function driverRow(User $driver, Request $request): array
    {
        $orders = $this->ordersQuery($request)->where('user_id', $driver->id);
        $tracking = $this->driverTrackingQuery($driver, $request);
        $latestOrder = (clone $orders)->latest()->first();

        $orderIds = (clone $orders)->pluck('id');
        $topItem = $orderIds->isEmpty()
            ? null
            : OrderedProduct::query()
                ->select('product_name', DB::raw('SUM(quantity) as qty'))
                ->whereIn('order_id', $orderIds)
                ->groupBy('product_name')
                ->orderByDesc('qty')
                ->value('product_name');

        $returnedOrderIds = (clone $orders)
            ->whereIn('status', ['Refunded', 'Returned', 'Cancelled'])
            ->pluck('id');

        $orderValue = (float) (clone $orders)->sum(DB::raw('CAST(total AS DECIMAL(12,2))'));

        return [
            'driver' => $driver,
            'clicks' => (clone $tracking)
                ->where(function ($q) {
                    $q->where('page_url', 'like', '%isindrive%')
                        ->orWhere('action', '!=', 'viewed');
                })
                ->count(),
            'website_visits' => (clone $tracking)->count(),
            'location' => $this->locationFromOrder($latestOrder),
            'delivery_orders' => (clone $orders)->where(function ($q) {
                $q->whereNull('zone')
                    ->orWhere('zone', '!=', 'Pickup');
            })->count(),
            'pickup_orders' => (clone $orders)->where('zone', 'Pickup')->count(),
            'order_count' => (clone $orders)->count(),
            'order_value' => Helper::currencyWrapper($orderValue),
            'order_value_raw' => $orderValue,
            'top_purchased_item' => $topItem ?: '---',
            'returned_items' => $returnedOrderIds->isEmpty()
                ? 0
                : OrderedProduct::whereIn('order_id', $returnedOrderIds)->sum('quantity'),
        ];
    }

    protected function overviewStats(Request $request): array
    {
        $orders = $this->ordersQuery($request);
        $driverRows = $this->driversQuery($request)->get()->map(fn (User $driver) => $this->driverRow($driver, $request));
        $topDriver = $driverRows->sortByDesc('order_count')->first();
        $orderIds = (clone $orders)->pluck('id');

        return [
            'drivers' => $driverRows->count(),
            'orders' => (clone $orders)->count(),
            'order_value' => Helper::currencyWrapper((float) (clone $orders)->sum(DB::raw('CAST(total AS DECIMAL(12,2))'))),
            'pickup_orders' => (clone $orders)->where('zone', 'Pickup')->count(),
            'delivery_orders' => (clone $orders)->where(function ($q) {
                $q->whereNull('zone')
                    ->orWhere('zone', '!=', 'Pickup');
            })->count(),
            'top_driver' => $topDriver ? $topDriver['driver']->fullname() : '---',
            'top_item' => $orderIds->isEmpty()
                ? '---'
                : OrderedProduct::query()
                    ->select('product_name', DB::raw('SUM(quantity) as qty'))
                    ->whereIn('order_id', $orderIds)
                    ->groupBy('product_name')
                    ->orderByDesc('qty')
                    ->value('product_name'),
        ];
    }

    protected function locationFromOrder(?Order $order): string
    {
        if (! $order) {
            return '---';
        }

        return collect([$order->city, $order->state, $order->zone])
            ->filter()
            ->implode(', ') ?: '---';
    }

    protected function driverTrackingQuery(User $driver, Request $request)
    {
        return $this->trackingQuery($request)
            ->where(function ($q) use ($driver) {
                $q->where('user_id', $driver->id);

                if ($driver->indrive_session_id) {
                    $q->orWhere('session_id', $driver->indrive_session_id);
                }

                if ($driver->indrive_driver_id) {
                    $q->orWhere('indrive_driver_id', $driver->indrive_driver_id);
                }
            });
    }
}
