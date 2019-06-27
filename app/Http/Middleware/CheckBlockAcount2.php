<?php

namespace App\Http\Middleware;
use App\User;
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
		$friend_id=$request->friend_id;
		$dem=0;
		if ($blocks) {
			foreach ($blocks as $block) {
				if ($block->id == $friend_id) {
					$msg = "trang bạn tìm thấy ko có ";
					$dem++;
					return redirect()->route('error', ['msg' => $msg]);
				}
			}
		}
		if($dem==0){
			return $next($request);
		}
	}
}

