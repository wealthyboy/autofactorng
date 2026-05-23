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

        $driverRows = $this->driverRows($drivers->getCollection(), $request);
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
                    foreach ($this->driverRows($drivers, $request) as $row) {
                        $driver = $row['driver'];

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
            Order::query()->indrive(),
            $request
        );
    }

    protected function trackingQuery(Request $request)
    {
        $query = UserTracking::query()->where('is_indrive', true);

        if ($from = $request->get('from')) {
            $query->where('visited_at', '>=', $from . ' 00:00:00');
        }

        if ($to = $request->get('to')) {
            $query->where('visited_at', '<=', $to . ' 23:59:59');
        }

        return $query;
    }

    protected function applyOrderFilters($query, Request $request)
    {
        if ($from = $request->get('from')) {
            $query->where('created_at', '>=', $from . ' 00:00:00');
        }

        if ($to = $request->get('to')) {
            $query->where('created_at', '<=', $to . ' 23:59:59');
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
        return $this->driverRows(collect([$driver]), $request)->first();
    }

    protected function driverRows($drivers, Request $request)
    {
        $drivers = collect($drivers)->values();

        if ($drivers->isEmpty()) {
            return collect();
        }

        $driverIds = $drivers->pluck('id')->filter()->values();
        $indriveDriverIds = $drivers->pluck('indrive_driver_id')->filter()->values();
        $sessionIds = $drivers->pluck('indrive_session_id')->filter()->values();

        $orders = $this->ordersQuery($request)
            ->whereIn('user_id', $driverIds)
            ->select('id', 'user_id', 'status', 'zone', 'city', 'state', 'total', 'created_at')
            ->latest('created_at')
            ->get();

        $ordersByDriver = $orders->groupBy('user_id');
        $orderDriverMap = $orders->pluck('user_id', 'id');
        $orderIds = $orders->pluck('id');

        $topItemsByDriver = collect();
        $returnedItemsByDriver = collect();

        if ($orderIds->isNotEmpty()) {
            $topItemsByDriver = OrderedProduct::query()
                ->select('order_id', 'product_name', DB::raw('SUM(quantity) as qty'))
                ->whereIn('order_id', $orderIds)
                ->groupBy('order_id', 'product_name')
                ->get()
                ->groupBy(fn ($item) => $orderDriverMap[$item->order_id] ?? null)
                ->map(function ($items) {
                    return $items
                        ->groupBy('product_name')
                        ->map(fn ($group) => $group->sum('qty'))
                        ->sortDesc()
                        ->keys()
                        ->first();
                });

            $returnedOrderIds = $orders
                ->whereIn('status', ['Refunded', 'Returned', 'Cancelled'])
                ->pluck('id');

            if ($returnedOrderIds->isNotEmpty()) {
                $returnedItemsByDriver = OrderedProduct::query()
                    ->select('order_id', DB::raw('SUM(quantity) as qty'))
                    ->whereIn('order_id', $returnedOrderIds)
                    ->groupBy('order_id')
                    ->get()
                    ->groupBy(fn ($item) => $orderDriverMap[$item->order_id] ?? null)
                    ->map(fn ($items) => $items->sum('qty'));
            }
        }

        $trackingRows = $this->trackingQuery($request)
            ->where(function ($q) use ($driverIds, $indriveDriverIds, $sessionIds) {
                $q->whereIn('user_id', $driverIds);

                if ($indriveDriverIds->isNotEmpty()) {
                    $q->orWhereIn('indrive_driver_id', $indriveDriverIds);
                }

                if ($sessionIds->isNotEmpty()) {
                    $q->orWhereIn('session_id', $sessionIds);
                }
            })
            ->select('user_id', 'session_id', 'indrive_driver_id', 'page_url', 'action')
            ->get();

        $driverByUserId = $drivers->keyBy('id');
        $driverByIndriveId = $drivers->whereNotNull('indrive_driver_id')->keyBy('indrive_driver_id');
        $driverBySessionId = $drivers->whereNotNull('indrive_session_id')->keyBy('indrive_session_id');
        $trackingStats = [];

        foreach ($trackingRows as $tracking) {
            $driver = $driverByUserId->get($tracking->user_id)
                ?: $driverByIndriveId->get($tracking->indrive_driver_id)
                ?: $driverBySessionId->get($tracking->session_id);

            if (! $driver) {
                continue;
            }

            $trackingStats[$driver->id]['website_visits'] = ($trackingStats[$driver->id]['website_visits'] ?? 0) + 1;

            if (str_contains((string) $tracking->page_url, 'isindrive') || $tracking->action !== 'viewed') {
                $trackingStats[$driver->id]['clicks'] = ($trackingStats[$driver->id]['clicks'] ?? 0) + 1;
            }
        }

        return $drivers->map(function (User $driver) use ($ordersByDriver, $topItemsByDriver, $returnedItemsByDriver, $trackingStats) {
            $driverOrders = $ordersByDriver->get($driver->id, collect());
            $latestOrder = $driverOrders->first();
            $orderValue = (float) $driverOrders->sum(fn ($order) => (float) $order->total);

            return [
                'driver' => $driver,
                'clicks' => $trackingStats[$driver->id]['clicks'] ?? 0,
                'website_visits' => $trackingStats[$driver->id]['website_visits'] ?? 0,
                'location' => $this->locationFromOrder($latestOrder),
                'delivery_orders' => $driverOrders->filter(fn ($order) => $order->zone !== 'Pickup')->count(),
                'pickup_orders' => $driverOrders->where('zone', 'Pickup')->count(),
                'order_count' => $driverOrders->count(),
                'order_value' => Helper::currencyWrapper($orderValue),
                'order_value_raw' => $orderValue,
                'top_purchased_item' => $topItemsByDriver->get($driver->id) ?: '---',
                'returned_items' => $returnedItemsByDriver->get($driver->id, 0),
            ];
        });
    }

    protected function overviewStats(Request $request): array
    {
        $orders = $this->ordersQuery($request);
        $drivers = $this->driversQuery($request);
        $orderIds = (clone $orders)->pluck('id');
        $driverOrderStats = (clone $orders)
            ->select('user_id', DB::raw('COUNT(*) as order_count'), DB::raw('SUM(CAST(total AS DECIMAL(12,2))) as order_value'))
            ->groupBy('user_id')
            ->orderByDesc('order_count')
            ->first();
        $topDriver = $driverOrderStats
            ? User::query()->find($driverOrderStats->user_id)
            : null;

        return [
            'drivers' => (clone $drivers)->count(),
            'orders' => (clone $orders)->count(),
            'order_value' => Helper::currencyWrapper((float) (clone $orders)->sum(DB::raw('CAST(total AS DECIMAL(12,2))'))),
            'pickup_orders' => (clone $orders)->where('zone', 'Pickup')->count(),
            'delivery_orders' => (clone $orders)->where(function ($q) {
                $q->whereNull('zone')
                    ->orWhere('zone', '!=', 'Pickup');
            })->count(),
            'top_driver' => $topDriver ? $topDriver->fullname() : '---',
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
