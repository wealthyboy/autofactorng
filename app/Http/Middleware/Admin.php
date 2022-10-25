<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$user = $request->user();
		//if no user is logged in go to loggin

		//allow to see the admin page
		if (!$user) {
			abort('/login');
		}

		if ($user) {
			if (!$user->users_permission) {
				abort('/login');
			}
		}

		return $next($request);
	}
}
