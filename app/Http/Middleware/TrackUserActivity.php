<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserTracking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;


class TrackUserActivity
{
    public function handle(Request $request, Closure $next)
    {

        $response = $next($request);
        $sessionId = session()->getId();
        $path = $request->fullUrl();
        UserTracking::updateOrInsert(
            ['session_id' => $sessionId,  'page_url' => $path],
            [
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'referer' => $request->headers->get('referer'),
                'user_id' => optional(auth()->user())->id,
                'first_name' => optional(auth()->user())->name,
                'last_name' => optional(auth()->user())->last_name,
                'visited_at' => now(),
                'method' => $request->method(),
                'product_id' => $request->routeIs('products.show') ? optional($request->route('product'))->id : null,
                'ip_address' => $request->ip(),
                'action' => $request->action ?  $request->action : "viewed",
                'page_url' => $request->fullUrl(),
                'visited_at' => now(),
                'created_at' => now(),
                'referer' => $request->headers->get('referer'),
            ]
        );

        if (!Session::has('tracking_id')) {
            $last_id = UserTracking::latest('id')->value('id');
            if ($last_id) {
                Session::put('tracking_id', $last_id);
            }
        }

        return $response;
    }
}
