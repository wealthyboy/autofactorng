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


        // Default to today if no date filter is set
        $startDate = $from ? Carbon::parse($from)->startOfDay() : now()->startOfDay();
        $endDate = $to ? Carbon::parse($to)->endOfDay() : now()->endOfDay();

        $visits = \DB::table('user_trackings')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->whereIn('id', function ($query) {
                $query->selectRaw('MIN(id)')
                    ->from('user_trackings')
                    ->groupBy('session_id');
            })
            ->when($source, function ($query, $source) {
                $query->where('referer', 'like', "%{$source}%");
            })
            ->orderByDesc('id')
            ->paginate(20);


        $knownSources = ['google', 'instagram', 'twitter', 'facebook'];

        $otherCount = UserTracking::whereBetween('created_at', [$startDate, $endDate])
            ->where(function ($query) use ($knownSources) {
                foreach ($knownSources as $source) {
                    $query->where('referer', 'not like', '%' . $source . '%');
                }
            })->count();

        $sourceCounts = [
            'google' => UserTracking::whereBetween('created_at', [$startDate, $endDate])->where('referer', 'like', '%google%')->count(),
            'instagram' => UserTracking::whereBetween('created_at', [$startDate, $endDate])->where('referer', 'like', '%instagram%')->count(),
            'twitter' => UserTracking::whereBetween('created_at', [$startDate, $endDate])->where('referer', 'like', '%twitter%')->count(),
            'facebook' => UserTracking::whereBetween('created_at', [$startDate, $endDate])->where('referer', 'like', '%facebook%')->count(),
            'others' => $otherCount,
        ];

        $trackings = $this->getColumnListings(request(), $visits);

        return view('admin.tracking.index', compact('trackings', 'sourceCounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $userTracking = UserTracking::find($id);
        $userTrackings = UserTracking::where('ip_address', $userTracking->ip_address)->orderByDesc('id')->get();
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
