<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\UserTracking;
use Carbon\Carbon;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Session;


class TrackUserActivity
{
    public function handle(Request $request, Closure $next)
    {

         $response = $next($request);

        if ( $request->debug === "ja" ) {
             // Skip admin and ignored AJAX requests
        if (
            $request->ajax() && $request->ignore === "true" ||
            Str::contains($request->path(), 'admin')
        ) {
            return $response;
        }

        $sessionId = session()->getId();
        $path = $request->fullUrl();
        $user = auth()->user();

        // Throttle or defer this logic if needed (e.g. using queues)
        $trackingData = [
            'session_id' => $sessionId,
            'page_url' => $path,
            'ip_address' => $request->ip(),
            'user_agent' => $this->detectDevice($request),
            'referer' => $request->headers->get('referer'),
            'user_id' => optional($user)->id,
            'first_name' => optional($user)->name,
            'last_name' => optional($user)->last_name,
            'visited_at' => now(),
            'method' => $request->method(),
            'product_id' => $request->routeIs('products.show') ? optional($request->route('product'))->id : null,
            'action' => $request->input('action', 'viewed'),
            'created_at' => now(),
        ];

        // Cache per session to avoid multiple writes per session per second
        $cacheKey = "user_tracking_{$sessionId}_{$path}";
        if (!Cache::has($cacheKey)) {
            UserTracking::updateOrInsert(
                ['session_id' => $sessionId, 'page_url' => $path],
                $trackingData
            );
            Cache::put($cacheKey, true, 30); // 30 seconds debounce to avoid overloading
    }

    // Track ID just once
    if (!Session::has('tracking_id')) {
        $lastId = Cache::remember('last_tracking_id', 30, function () {
            return UserTracking::latest('id')->value('id');
        });

        if ($lastId) {
            Session::put('tracking_id', $lastId);
        }
    }
        }

       

       return $response;
    }



    public function detectDevice(Request $request)
    {
        $userAgent = $request->header('User-Agent');

        if (preg_match('/mobile/i', $userAgent)) {
            $device = 'mobile';
        } elseif (preg_match('/tablet|ipad/i', $userAgent)) {
            $device = 'tablet';
        } else {
            $device = 'desktop';
        }

        return $device;
    }
}
