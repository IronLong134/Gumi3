<?php
    
    namespace App;
    
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Auth;
    use App\Posts;
    
    class Like extends Model {
        /**
         * @var string
         */
        protected $table = 'likes';
        
        /**
         * @return mixed
         */
        public function posts() {
            return $this->belongsTo('App\Posts', 'posts_id');
        }
        
        /**
         * @param $posts_id
         *
         * @return array
         */
        public function addLike($posts_id) {
            $user = Auth::user();
            
            $users_id = $user->id;
            $check = Like::checkLike($posts_id, $users_id);
            $post = new Posts();
            if (0 == $check) {
                $like = new Like();
                $like->posts_id = $posts_id;
                $like->users_id = $users_id;
                if ($like->save()) {
                    $success = 1;
                } else {
                    $success = 0;
                }
                $post = new Posts();
                
                return ['success' => $success, 'fail' => 0, 'likes' => $post->getLike($posts_id)];
                
            } else {
                
                $like = Like::where('posts_id', '=', $posts_id)->where('users_id', '=', $users_id);
                
                if ($like->delete()) {
                    $fail = 1;
                } else {
                    $fail = 0;
                }
                $post1 = new Posts();
                $like1 = $post1->getLike($posts_id);
                
                return ['fail' => $fail, 'success' => 0, 'likes' => $like1];
            }
            
        }
        
        /**
         * @param $posts_id
         * @param $users_id
         */
        public function checkLike($posts_id, $users_id) {
            $data = Like::where('posts_id', '=', $posts_id)->where('users_id', '=', $users_id)->count();
            
            return $data;
        }
        //
        
        
    }
