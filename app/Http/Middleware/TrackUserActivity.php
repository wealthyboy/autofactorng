<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\UserTracking;
use App\Models\Product;
use App\Models\Category;
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

        $this->captureIndriveReferral($request);

        return $next($request);
    }

    protected function captureIndriveReferral(Request $request): void
    {
        if (! $request->boolean('isindrive')) {
            return;
        }

        if (! $this->hasValidIndriveToken($request)) {
            return;
        }

        $driverId = $request->query('driver_id');

        Session::put('is_indrive_customer', true);
        Session::put('acquisition_source', 'indrive');
        Session::put('acquisition_source_at', now()->toDateTimeString());
        Session::put('indrive_session_id', $request->session()->getId());
        Session::put('indrive_driver_id', $driverId);
        Session::put('indrive_verified', true);

        if ($request->user()) {
            $request->user()->forceFill([
                'is_indrive_customer' => true,
                'acquisition_source' => $request->user()->acquisition_source ?: 'indrive',
                'acquisition_source_at' => $request->user()->acquisition_source_at ?: now(),
                'indrive_session_id' => $request->user()->indrive_session_id ?: $request->session()->getId(),
                'indrive_driver_id' => $request->user()->indrive_driver_id ?: $driverId,
            ])->save();
        }
    }

    protected function hasValidIndriveToken(Request $request): bool
    {
        $expectedToken = (string) config('services.indrive.token');
        $providedToken = (string) ($request->query('indrive_token') ?: $request->query('token'));

        return $expectedToken !== ''
            && $providedToken !== ''
            && hash_equals($expectedToken, $providedToken);
    }



    public function terminate(Request $request, $response = null)
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
        $routeProduct = $request->route('product');
        $routeCategory = $request->route('category');
        $productId = $routeProduct instanceof Product ? $routeProduct->id : null;
        $action = $this->trackingAction($request, $productId, $routeCategory);

        if (Cache::add($cacheKey, true, 30)) {
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
                'product_id' => $productId,
                'action' => $action,
                'is_indrive' => (bool) session('is_indrive_customer'),
                'source_channel' => session('acquisition_source') ?: $this->sourceFromReferer($referer),
                'indrive_driver_id' => session('indrive_driver_id'),
                'indrive_verified' => (bool) session('indrive_verified'),
                'created_at' => now(),
            ]);
        }

        if (!session()->has('tracking_id')) {
            $lastId = Cache::remember('last_tracking_id', 30, function () {
                return UserTracking::latest('id')->value('id');
            });

            if ($lastId) {
                Session::put('tracking_id', $lastId);
            }
        }
    }

    protected function trackingAction(Request $request, $productId, $routeCategory): string
    {
        if ($request->is('search')) {
            $resultCount = $request->attributes->get('analytics_search_results_count');

            if ($resultCount !== null && (int) $resultCount === 0) {
                return 'search_no_results';
            }

            return 'search';
        }

        if ($productId) {
            return 'product_view';
        }

        if ($routeCategory instanceof Category && $request->is('products/*')) {
            return 'category_view';
        }

        return (string) $request->input('action', 'viewed');
    }

    protected function shouldSkipTracking(Request $request): bool
    {
        return $request->ajax()
            || ! in_array($request->method(), ['GET', 'HEAD'], true)
            || Str::startsWith($request->path(), ['admin', 'api']);
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

    protected function sourceFromReferer(?string $referer): string
    {
        if (! $referer) {
            return 'direct';
        }

        $host = strtolower((string) parse_url($referer, PHP_URL_HOST));
        foreach (['google', 'facebook', 'instagram', 'twitter', 'youtube', 'tiktok', 'linkedin'] as $source) {
            if (Str::contains($host, $source)) {
                return $source;
            }
        }

        return $host ?: 'referral';
    }
}
