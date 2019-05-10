<?php
    
    namespace App;
    
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Auth;
    
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
            // TODO: suy nghĩ cách viết lại chỗ này cho ngắn gọn
            if ($check == 'no') {
                $like = new Like();
                $like->post_id = $post_id;
                $like->user_id = $user_id;
                
                return ['success' => $like->save(), 'fail' => 0, 'likes' => $post->getLike($post_id)];
            } else if ($check == 'unlike') {
                $success = Like::where('post_id', '=', $post_id)->where('user_id', '=', $user_id)->update(['delete_at' => 0]);
                
                return ['success' => $success, 'fail' => 0, 'likes' => $post->getLike($post_id)];
            } else if ($check == 'liked') {
                $fail = Like::where('post_id', '=', $post_id)->where('user_id', '=', $user_id)->update(['delete_at' => 1]);
                
                return ['fail' => $fail, 'success' => 0, 'likes' => $post->getLike($post_id)];
            }
        }
        
        /**
         * @param $post_id
         * @param $user_id
         *
         * @return string
         */
        public function checkLike($post_id, $user_id) {
            $check = '';
            $is_Like= Like::where('post_id', '=', $post_id)->where('user_id', '=', $user_id)->first();
            if($is_Like)
            {
                $check=$is_Like->delete_at ? 'unlike' : 'liked';
            }
            else
            {
                $check='no';
            }
            return $check;
        }
    }
