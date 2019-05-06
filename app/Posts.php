<?php

namespace App;
use App\Like;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Posts extends Model
{
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
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * @return mixed
     */
    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }

    /**
     * @param $users_id
     * @return mixed
     */
    public function getPostID($users_id)
    {
        $data = Posts::orderBy('id', 'desc')->whereHas('user', function ($query) use ($users_id) {
            $query->where('id', $users_id)->where('delete_at','=',0);
        })->get();
        return $data;
    }

    /**
     * @return mixed
     */
    public function getAllPost()
    {

        $data = Posts::where('delete_at','=',0)->with(['user', 'comments', 'likes'])->orderBy('posts.id', 'desc')->get();
        return $data;
    }

    /**
     * @param Request $rq
     */
    public function addPost(Request $rq)
    {
        $new_post = new Posts();
        //$new_post->posts_id = $rq->id;
        $new_post->users_id = $rq->users_id;
        $new_post->content = $rq->content;
        $new_post->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getPost($id)
    {

        $data = Posts::leftjoin('comments', 'posts.id', '=', 'comments.posts_id')
            ->leftjoin('users', 'comments.users_id', '=', 'users.id')
            ->where('posts.id', $id)->with('likes')
            ->orderBy('comments.id', 'desc')->get();
        return $data;
    }

    /**
     * @param  $posts_id
     * @return mixed
     */
    public function getLike($posts_id)
    {
        $data = Like::where('posts_id','=',$posts_id)->count();
        return $data;
    }

    /**
     * @param  $id
     * @return mixed
     */
    public function getUserPost($id)
    {
        $user = Posts::where('id', '=', $id)->where('delete_at','=',0)->with('user', 'likes', 'comments')->get();
        //$post = new Posts();
        // $user = Posts::select('posts.content', 'posts.created_at', 'users.name', 'users.avatar', 'posts.id')->where('posts.id', '=', $id)->leftjoin('users', 'posts.users_id', '=', 'users.id')->get();
        // // dd($id);
        //dd($user);
        return $user;
        //dd($user);
    }

    /**
     * @param $id
     */
    public function deletePost($id)
    {
        
        $post = Posts::where('id', '=', $id)->update(['delete_at'=>1]);
        
        
    }
}
