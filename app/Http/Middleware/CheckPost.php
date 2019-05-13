<?php
    
    namespace App\Http\Middleware;
    
    use App\Friend;
    use App\User;
    use App\Post;
    use Illuminate\Support\Facades\Auth;
    use Closure;
    
    class CheckPost {
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  \Closure                 $next
         *
         * @return mixed
         */
        public function handle($request, Closure $next) {
            $post = Post::where('id', '=', $request->id)->first();
            $friend1 = new Friend();
            $listFriends = $friend1->getFriend();
            $dem = 0;
            //dd($listFriends);
            foreach ($listFriends as $friend) {
                if ($friend == $post->user_id) {
                    $dem++;
                }
            }
           // dd($dem);
            return $dem > 0 ? $next($request) : redirect()->back();
            
        }
    }
