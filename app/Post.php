<?php
    
    namespace App;
    
    use App\Like;
    use App\User;
    use App\Comment;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Http\Request;
    
    class Post extends Model {
        //
        /**
         * @var string
         */
        protected $table = 'posts';
        /**
         * @var string
         */
        protected $primaryKey = 'id';
        //public $content='content';
        
        /**
         * @return mixed
         */
        public function comment() {
            return $this->hasMany('App\Comment');
        }
        
        /**
         * @return mixed
         */
        public function like() {
            return $this->hasMany('App\Like');
        }
        
        /**
         * @return mixed
         */
        public function user() {
            return $this->belongsTo('App\User', 'user_id');
        }
        
        /**
         * @param $user_id
         *
         * @return mixed
         */
        public function getPostID($user_id) {
            $data = Post::orderBy('created_at', 'desc')->whereHas('user', function ($query) use ($user_id) {
                $query->where('id', $user_id)->where('delete_at', '=', 0);
            })->get();
            
            return $data;
        }
        
        /**
         * @return mixed
         */
        public function getAllPost() {
            $id = Auth::user()->id;
            $friends = Friend::where(function ($q) {
                $q->where('sender_id', '=', Auth::user()->id)
                  ->orWhere('receive_id', '=', Auth::user()->id);
            })
                             ->orderBy('updated_at', 'DESC')
                             ->where('accept', '=', 1)
                             ->where('delete_at', '=', 0)
                             ->get();
            
            $receive_ids = $friends->where('sender_id', '=', Auth::user()->id)->pluck('receive_id');
            $sender_ids = $friends->where('receive_id', '=', Auth::user()->id)->pluck('sender_id');
            $list = array_merge($receive_ids->toArray(), $sender_ids->toArray());
            array_push($list, $id);
            // dd($list);
            $post = Post::whereIn('user_id', $list)
                        ->with(['user', 'comment'])
                        ->with(['like' => function ($q) {
                            $q->where('delete_at', '=', 0);
                        }])
                        ->where('delete_at', '=', 0)
                        ->orderBy('id', 'DESC')->get();
            
            //dd($post);
            
            return $post;
        }
        
        /**
         * @param Request $rq
         */
        public function addPost(Request $rq) {
            $new_post = new Post();
            //$new_post->post_id = $rq->id;
            $new_post->user_id = $rq->user_id;
            $new_post->content = $rq->content;
            $new_post->save();
        }
        
        /**
         * @param $id
         *
         * @return mixed
         */
        public function getCmtPost($id) {
            
            $data = Comment::where('post_id', '=', $id)
                        ->with('user')
                        ->get();
            
            return $data;
           //dd($data);
        }
        
        /**
         * @param  $post_id
         *
         * @return mixed
         */
        public function getLike($post_id) {
            $data = Like::where('post_id', '=', $post_id)->where('delete_at', '=', 0)->count();
            
            return $data;
        }
        
        /**
         * @param  $id
         *
         * @return mixed
         */
        public function getPostById($id) {
            $user_post = Post::where('id', '=', $id)
                             ->where('delete_at', '=', 0)
                             ->with('user', 'comment')
                             ->with(['like' => function ($q) {
                $q->where('delete_at', '=', 0);
            }])->orderBy('updated_at', 'DESC')->get();
            
            return $user_post;
            //dd($user_post);
            
        }
        
        /**
         * @param $id
         */
        public function deletePost($id) {
            
            $post = Post::where('id', '=', $id)->update(['delete_at' => 1]);
            
            
        }
    }
