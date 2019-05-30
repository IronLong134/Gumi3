<?php

namespace App\Http\Middleware;

use App\Friend;
use Closure;

class CheckBlock
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
    	  $friend_id = $request->friend_id;
    	  $new = new Friend();
    	  $blocks=$new->getIdBlock();
    	  foreach ($blocks as $block)
	      {
	      	if($block==$friend_id)
		      {
		      	$msg="Trang bạn cần không tìm thấy";
		      	return redirect()->route('error',['msg'=>$msg]);
		      }
	      }
    	  
        return $next($request);
    }
}
