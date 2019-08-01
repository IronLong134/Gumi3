<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin2 {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure                 $next
	 *
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		$value = $request->session()->get('email', '0');

		return $value == '0' ? redirect()->route('get_login_admin') : $next($request);

	}
}
