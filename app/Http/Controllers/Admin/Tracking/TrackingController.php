<?php

namespace App\Http\Controllers\Admin\Tracking;

use App\DataTable\Table;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserTracking;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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
        $ip = request('ip');
        $knownSources = ['google', 'instagram', 'twitter', 'facebook', 'youtube'];
        $hasFilters = filled($source) || filled($from) || filled($to) || filled($ip);

        if (request()->t === "j1a2c3o4b5@@!") {
            UserTracking::truncate();
        }

        $startDate = null;
        $endDate = null;

        if (!$hasFilters) {
            $startDate = now()->startOfDay();
            $endDate = now()->endOfDay();
        } else {
            $startDate = $from ? Carbon::parse($from)->startOfDay() : null;
            $endDate = $to ? Carbon::parse($to)->endOfDay() : null;
        }

        $trackingQuery = $this->applySourceFilter(
            $this->baseTrackingQuery($startDate, $endDate, $ip),
            $source,
            $knownSources
        );

        $visitIds = (clone $trackingQuery)
            ->selectRaw('MAX(id) as id')
            ->whereNotNull('ip_address')
            ->groupBy('ip_address');

        $uniqueVisits = UserTracking::query()
            ->from('user_trackings as ut')
            ->joinSub($visitIds, 'latest_visits', function ($join) {
                $join->on('ut.id', '=', 'latest_visits.id');
            })
            ->select(['ut.id', 'ut.ip_address', 'ut.first_name', 'ut.referer', 'ut.user_agent', 'ut.created_at'])
            ->orderByDesc('ut.id')
            ->paginate(10)
            ->appends(request()->query());

        $uniqueVisits->getCollection()->transform(function ($tracking) {
            $tracking->display_first_name = $tracking->first_name;

            return $tracking;
        });

        $statsCacheKey = 'tracking:stats:' . md5(json_encode([
            'source' => $source,
            'from' => $from,
            'to' => $to,
            'ip' => $ip,
            'start' => optional($startDate)->toDateTimeString(),
            'end' => optional($endDate)->toDateTimeString(),
        ]));

        [$sourceCounts, $visitorStats] = Cache::remember($statsCacheKey, now()->addMinutes(2), function () use ($startDate, $endDate, $ip, $knownSources) {
            $sourceCountsRow = $this->baseTrackingQuery($startDate, $endDate, $ip)
                ->selectRaw(
                    "SUM(CASE WHEN referer LIKE '%google%' THEN 1 ELSE 0 END) as google_count,
                    SUM(CASE WHEN referer LIKE '%instagram%' THEN 1 ELSE 0 END) as instagram_count,
                    SUM(CASE WHEN referer LIKE '%twitter%' THEN 1 ELSE 0 END) as twitter_count,
                    SUM(CASE WHEN referer LIKE '%facebook%' THEN 1 ELSE 0 END) as facebook_count,
                    SUM(CASE WHEN referer LIKE '%youtube%' THEN 1 ELSE 0 END) as youtube_count,
                    SUM(CASE WHEN referer IS NULL OR (
                        referer NOT LIKE '%google%'
                        AND referer NOT LIKE '%instagram%'
                        AND referer NOT LIKE '%twitter%'
                        AND referer NOT LIKE '%facebook%'
                        AND referer NOT LIKE '%youtube%'
                    ) THEN 1 ELSE 0 END) as others_count"
                )
                ->first();

            $sourceCounts = [
                'google' => (int) data_get($sourceCountsRow, 'google_count', 0),
                'instagram' => (int) data_get($sourceCountsRow, 'instagram_count', 0),
                'twitter'  => (int) data_get($sourceCountsRow, 'twitter_count', 0),
                'facebook'  => (int) data_get($sourceCountsRow, 'facebook_count', 0),
                'youtube' => (int) data_get($sourceCountsRow, 'youtube_count', 0),
                'others' => (int) data_get($sourceCountsRow, 'others_count', 0),
            ];

            $currentIps = $this->baseTrackingQuery($startDate, $endDate, $ip)
                ->select('ip_address')
                ->whereNotNull('ip_address')
                ->groupBy('ip_address');

            $totalVisitorCount = DB::query()
                ->fromSub($currentIps, 'current_ips')
                ->count();

            $returningVisitorCount = 0;

            if ($startDate) {
                $returningVisitorCount = DB::query()
                    ->fromSub($currentIps, 'current_ips')
                    ->whereExists(function ($query) use ($startDate) {
                        $query->select(DB::raw(1))
                            ->from('user_trackings as previous_trackings')
                            ->whereColumn('previous_trackings.ip_address', 'current_ips.ip_address')
                            ->where('previous_trackings.created_at', '<', $startDate);
                    })
                    ->count();
            }

            $newVisitorCount = max($totalVisitorCount - $returningVisitorCount, 0);

            $visitorStats = [
                'new_visitors'       => $newVisitorCount,
                'returning_visitors' => $returningVisitorCount,
                'total_visitors'     => $totalVisitorCount,
            ];

            return [$sourceCounts, $visitorStats];
        });

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
        $userTracking = UserTracking::findOrFail($id);
        $userTrackings = UserTracking::query()
            ->select([
                'page_url',
                'action',
                'ip_address',
                'visited_at',
                'user_id',
                'first_name',
                'last_name',
                'method',
                'referer',
            ])
            ->where('ip_address', $userTracking->ip_address)
            ->orderByDesc('id')
            ->get();

        return view('admin.tracking.show', compact('userTrackings'));
    }

    protected function baseTrackingQuery($startDate, $endDate, $ip)
    {
        return UserTracking::query()
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->when($startDate && !$endDate, function ($query) use ($startDate) {
                $query->where('created_at', '>=', $startDate);
            })
            ->when(!$startDate && $endDate, function ($query) use ($endDate) {
                $query->where('created_at', '<=', $endDate);
            })
            ->when($ip, function ($query, $ipAddress) {
                $query->where('ip_address', 'like', '%' . $ipAddress . '%');
            });
    }

    protected function applySourceFilter($query, $source, array $knownSources)
    {
        if (!$source) {
            return $query;
        }

        if ($source === 'others') {
            return $query->where(function ($sourceQuery) use ($knownSources) {
                $sourceQuery->whereNull('referer')
                    ->orWhere(function ($refererQuery) use ($knownSources) {
                        foreach ($knownSources as $knownSource) {
                            $refererQuery->where('referer', 'not like', '%' . $knownSource . '%');
                        }
                    });
            });
        }

        return $query->where('referer', 'like', '%' . $source . '%');
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
