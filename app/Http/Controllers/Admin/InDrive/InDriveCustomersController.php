<?php

namespace App\Http\Controllers\Admin\InDrive;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class InDriveCustomersController extends Controller
{
    public function index(Request $request)
    {
        User::canTakeAction(User::canAccessAdminUsers);

        $customers = $this->query($request)
            ->latest()
            ->paginate(50)
            ->appends($request->query());

        return view('admin.indrive-customers.index', [
            'customers' => $customers,
            'filters' => $request->only(['q', 'from', 'to', 'has_orders']),
        ]);
    }

    public function export(Request $request): StreamedResponse
    {
        User::canTakeAction(User::canAccessExport);

        $filename = 'indrive-customers-' . now()->format('Y-m-d-His') . '.csv';

        return response()->streamDownload(function () use ($request) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'ID',
                'Name',
                'Last Name',
                'Email',
                'Phone Number',
                'Orders',
                'Acquisition Source',
                'Acquisition Source At',
                'Joined',
            ]);

            $this->query($request)
                ->latest()
                ->chunk(500, function ($users) use ($handle) {
                    foreach ($users as $user) {
                        fputcsv($handle, [
                            $user->id,
                            $user->name,
                            $user->last_name,
                            $user->email,
                            $user->phone_number,
                            $user->orders_count,
                            $user->acquisition_source,
                            optional($user->acquisition_source_at)->format('Y-m-d H:i:s'),
                            optional($user->created_at)->format('Y-m-d H:i:s'),
                        ]);
                    }
                });

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }

    protected function query(Request $request)
    {
        $query = User::query()
            ->where(function ($q) {
                $q->where('type', 'subscriber')
                    ->orWhereNull('type');
            })
            ->where('is_indrive_customer', true)
            ->withCount('orders');

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        if ($from = $request->get('from')) {
            $query->whereDate('created_at', '>=', $from);
        }

        if ($to = $request->get('to')) {
            $query->whereDate('created_at', '<=', $to);
        }

        if ($request->get('has_orders') === 'yes') {
            $query->has('orders');
        }

        if ($request->get('has_orders') === 'no') {
            $query->doesntHave('orders');
        }

        return $query;
    }
}
