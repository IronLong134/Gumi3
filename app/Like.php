<?php
    
    namespace App;
    
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Auth;
    use App\Post;
    
    class Like extends Model {
        /**
         * @var string
         */
        protected $table = 'likes';
        
        /**
         * @return mixed
         */
        public function post() {
            return $this->belongsTo('App\Post', 'post_id');
        }
        
        /**
         * @param $post_id
         *
         * @return array
         */
        public function addLike($post_id) {
            $user = Auth::user();
            
            $user_id = $user->id;
            $check = Like::checkLike($post_id, $user_id);
            $post = new Post();
            if ($check == 'no') {
                //return 0;
                $like = new Like();
                $like->post_id = $post_id;
                $like->user_id = $user_id;
                if ($like->save()) {
                    
                    $success = 1;
                } else {
                    $success = 0;
                }
                $post = new Post();
                
                return ['success' => $success, 'fail' => 0, 'likes' => $post->getLike($post_id)];
                
            } else if ($check == 'unlike') {
                
                if (Like::where('post_id', '=', $post_id)->where('user_id', '=', $user_id)->update(['delete_at' => 0])) {
                    $success = 1;
                } else {
                    $success = 0;
                }
                //dd($check);
                $post = new Post();
                
                return ['success' => $success, 'fail' => 0, 'likes' => $post->getLike($post_id)];
            } else if ($check == 'liked') {
                
                $like = Like::where('post_id', '=', $post_id)->where('user_id', '=', $user_id)->update(['delete_at' => 1]);
                if ($like) {
                    $fail = 1;
                } else {
                    $fail = 0;
                }
                $post1 = new Post();
                $like1 = $post1->getLike($post_id);
                
                return ['fail' => $fail, 'success' => 0, 'likes' => $like1];
            }
            
        }
        
        /**
         * @param $post_id
         * @param $user_id
         */
        public
        function checkLike($post_id, $user_id) {
            $check = 'no';
            $data = Like::where('post_id', '=', $post_id)->where('user_id', '=', $user_id)->count();
            $data1 = Like::where('post_id', '=', $post_id)->where('user_id', '=', $user_id)->where('delete_at', '=', 1)->count();
            $data2 = Like::where('post_id', '=', $post_id)->where('user_id', '=', $user_id)->where('delete_at', '=', 0)->count();
            if ($data > 0) {
                if ($data2 > 0 && $data1 == 0) {
                    $check = 'liked';
                } else if ($data1 > 0) {
                    $check = 'unlike';
                }
                
            } else if ($data == 0) {
                $check = 'no';
            }
            
            return $check;
        }
        //
        
        
    }
