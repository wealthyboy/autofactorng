<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\UserTracking;
use Carbon\Carbon;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Session;


class TrackUserActivity
{
    /**
     * Store the current request so we can track it after response.
     *
     * @var Request|null
     */
    protected $request = null;

    public function handle(Request $request, Closure $next)
    {
        $this->request = $request;

        return $next($request);
    }

    public function terminate(Request $request, $response)
    {
        if ($this->shouldSkipTracking($request)) {
            return;
        }

        $sessionId = $request->session()->getId();
        $path = $request->fullUrl();
        $user = auth()->user();
        $referer = $request->headers->get('referer');

        // Store the original referer in session (only once on first visit)
        if (!session()->has('original_referer') && $referer) {
            Session::put('original_referer', $referer);
        }


        $cacheKey = 'user_tracking_' . $sessionId . '_' . md5($path);

        Cache::remember($cacheKey, 30, function () use ($request, $sessionId, $path, $user, $referer) {
            UserTracking::create([
                'session_id' => $sessionId,
                'page_url' => $path,
                'ip_address' => $request->ip(),
                'device_type' => $this->detectDevice($request),
                'user_agent' => $request->header('User-Agent'),
                'referer' => $referer,
                'user_id' => optional($user)->id,
                'first_name' => optional($user)->name,
                'last_name' => optional($user)->last_name,
                'visited_at' => now(),
                'method' => $request->method(),
                'product_id' => $request->routeIs('products.show') ? optional($request->route('product'))->id : null,
                'action' => $request->input('action', 'viewed'),
                'created_at' => now(),
            ]);
        });

        if (!session()->has('tracking_id')) {
            $lastId = Cache::remember('last_tracking_id', 30, function () {
                return UserTracking::latest('id')->value('id');
            });

            if ($lastId) {
                Session::put('tracking_id', $lastId);
            }
        }
    }

    protected function shouldSkipTracking(Request $request): bool
    {
        return ($request->ajax() && $request->input('ignore') === 'true')
            || Str::contains($request->path(), 'admin');
    }

    public function detectDevice(Request $request)
    {
        $userAgent = $request->header('User-Agent');

        if (preg_match('/mobile/i', $userAgent)) {
            return 'mobile';
        }

        if (preg_match('/tablet|ipad/i', $userAgent)) {
            return 'tablet';
        }

        return 'desktop';
    }
}
