<?php

namespace App\Http\Middleware;

use Closure;

class CheckBlockAcount2 {
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
		if ($blocks) {
			foreach ($blocks as $block) {
				if ($block->id == $request->user_id) {
					$msg = "trang bạn tìm thấy ko có ";

					return redirect()->route('error', ['msg' => $msg]);
				}
			}
		} else {
			return $next($request);
		}
	}
}

