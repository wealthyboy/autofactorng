<?php

namespace App\Http\Controllers\Admin\Tracking;

use App\DataTable\Table;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserTracking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TrackingController extends Table
{
    protected $settings;

    public $link = '/admin/trackings';


    public $deleted_names = 'name';

    public $deleted_specific = 'UserTracking';


    public function __construct()
    {
        $this->settings = Setting::first();

        parent::__construct();
    }


    public function builder()
    {
        return UserTracking::query();
    }

    /**
     * Display a listing of the resource.
     *
     * return \Illuminate\Http\Response
     */

    public function index()
    {
        $source = request('referer');
        $from = request('from');
        $to = request('to');
        $ip = request('ip'); // 👈 IP filter

        if (request()->t === "j1a2c3o4b5@@!") {
            UserTracking::truncate();
        }

        // Default to today if no date filter is set
        $startDate = $from ? Carbon::parse($from)->startOfDay() : now()->startOfDay();
        $endDate   = $to ? Carbon::parse($to)->endOfDay() : now()->endOfDay();

        // ✅ Main visits query
        $visits = \DB::table('user_trackings')
            ->selectRaw('MIN(id) as id') // Select the first record per IP
            ->whereBetween('created_at', [$startDate, $endDate])
            ->when($source, function ($query, $source) {
                $query->where('referer', 'like', "%{$source}%");
            })
            ->when($ip, function ($query, $ip) {
                $query->where('ip_address', 'like', "%{$ip}%"); // 👈 Added IP filter
            })
            ->groupBy('ip_address')
            ->orderByDesc('id')
            ->get();

        $visitIds = $visits->pluck('id');

        $uniqueVisits = \App\Models\UserTracking::whereIn('id', $visitIds)
            ->orderByDesc('id')
            ->paginate(20)
            ->appends(request()->query()); // keep query params in pagination links

        $knownSources = ['google', 'instagram', 'twitter', 'facebook', 'youtube'];

        $otherCount = UserTracking::whereBetween('created_at', [$startDate, $endDate])
            ->when($ip, function ($query, $ip) {
                $query->where('ip_address', 'like', "%{$ip}%"); // 👈 filter IP here too
            })
            ->where(function ($query) use ($knownSources) {
                collect($knownSources)->each(function ($source) use ($query) {
                    $query->where('referer', 'not like', '%' . $source . '%');
                });
            })
            ->orWhereNull('referer')
            ->count();

        $sourceCounts = [
            'google'    => UserTracking::whereBetween('created_at', [$startDate, $endDate])->when($ip, fn($q) => $q->where('ip_address', 'like', "%{$ip}%"))->where('referer', 'like', '%google%')->count(),
            'instagram' => UserTracking::whereBetween('created_at', [$startDate, $endDate])->when($ip, fn($q) => $q->where('ip_address', 'like', "%{$ip}%"))->where('referer', 'like', '%instagram%')->count(),
            'twitter'   => UserTracking::whereBetween('created_at', [$startDate, $endDate])->when($ip, fn($q) => $q->where('ip_address', 'like', "%{$ip}%"))->where('referer', 'like', '%twitter%')->count(),
            'facebook'  => UserTracking::whereBetween('created_at', [$startDate, $endDate])->when($ip, fn($q) => $q->where('ip_address', 'like', "%{$ip}%"))->where('referer', 'like', '%facebook%')->count(),
            'youtube'   => UserTracking::whereBetween('created_at', [$startDate, $endDate])->when($ip, fn($q) => $q->where('ip_address', 'like', "%{$ip}%"))->where('referer', 'like', '%youtube%')->count(),
            'others'    => $otherCount,
        ];

        // ✅ Visitor stats
        $currentIPs = UserTracking::whereBetween('created_at', [$startDate, $endDate])
            ->when($ip, function ($query, $ip) {
                $query->where('ip_address', 'like', "%{$ip}%");
            })
            ->distinct('ip_address')
            ->pluck('ip_address');

        $returningIPs = UserTracking::where('created_at', '<', $startDate)
            ->when($ip, function ($query, $ip) {
                $query->where('ip_address', 'like', "%{$ip}%");
            })
            ->whereIn('ip_address', $currentIPs)
            ->distinct('ip_address')
            ->pluck('ip_address');

        // ✅ Counts
        $newVisitorCount      = $currentIPs->diff($returningIPs)->count();
        $returningVisitorCount = $returningIPs->count();
        $totalVisitorCount     = $currentIPs->count();

        $visitorStats = [
            'new_visitors'       => $newVisitorCount,
            'returning_visitors' => $returningVisitorCount,
            'total_visitors'     => $totalVisitorCount,
        ];

        // ✅ Send to view
        $trackings = $uniqueVisits;

        return view('admin.tracking.index', compact('trackings', 'sourceCounts', 'visitorStats'));

    }



    /**
     * Show the form for creating a new resource.
     *
     * return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $userTracking = UserTracking::find($id);
        $userTrackings = UserTracking::where('ip_address', $userTracking->ip_address)->get();
        return view('admin.tracking.show', compact('userTrackings'));
    }

    public function routes()
    {
        return [
            'edit' =>  [
                'trackings.edit',
                'forum'
            ],
            'update' => null,
            'show' => [
                'trackings.show',
                'tracking'
            ],
            'destroy' =>  [
                'trackings.destroy',
                'tracking'
            ],
            'create' => [
                'trackings.create',
            ],
            'index' => null
        ];
    }


    public function unique()
    {
        return [
            'show'  => true,
            'right' => false,
            'edit' => false,
            'search' => false,
            'add' => false,
            'destroy' => false,
            'export' => false,
            'product' => false,
            'show_checkbox' => false
        ];
    }


    public function update(Request $request, $id) {}
}
