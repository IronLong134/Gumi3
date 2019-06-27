<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use App\User;
use Closure;

class CheckBlockAcount {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure                 $next
	 *
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		$user1 = new User();
		$blocks = $user1->getListBlockAcount();
		$dem = 0;
		if ($blocks) {
			foreach ($blocks as $block) {
				if ($block->id == Auth::id()) {
					$msg = "Tài khoản của bạn đã bị khoá";
					Auth::logout();
					$dem++;
					return redirect()->route('error2', ['msg' => $msg]);
				}
			}
		}
		if ($dem == 0) {
			//return redirect()->route('home');
			return $next($request);
		}
		//			return $next($request);
	}
}
