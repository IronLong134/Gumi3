<?php
    
    namespace App\Http\Middleware;
    
    use App\Friend;
    use App\User;
    use Illuminate\Support\Facades\Auth;
    
    use Closure;
    
    class CheckFriend {
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  \Closure                 $next
         *
         * @return mixed
         */
        public function handle($request, Closure $next) {
            $friend1 = new Friend();
            $listFriends = $friend1->getFriend();
            $friend_id = $request->friend_id;
            $dem = 0;
            foreach ($listFriends as $friend) {
                if ($friend == $friend_id) {
                    $dem++;
                }
            }
            
            return $dem > 0 ? $next($request) : redirect()->back();
            
        }
    }
