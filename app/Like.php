<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Like extends Model
{
    /**
     * @var string
     */
    protected $table = 'likes';
    /**
     * @return mixed
     */
    public function posts()
    {
        return $this->belongsTo('App\Posts', 'posts_id');
    }
    /**
     * @param $posts_id
     */
    public function addLike($posts_id)
    {
        $user = Auth::user();

        $users_id = $user->id;
        $check = Like::checkLike($posts_id, $users_id);
        // dd($check);
        if (0 == $check) {
            $like = new Like();
            $like->posts_id = $posts_id;
            $like->users_id = $users_id;
            $like->save();
        } else {
            $like = Like::where('posts_id', '=', $posts_id)->where('users_id', '=', $users_id);
            $like->delete();
        }

    }
    /**
     * @param $posts_id
     * @param $users_id
     */
    public function checkLike($posts_id, $users_id)
    {
        $data = Like::where('posts_id', '=', $posts_id)->where('users_id', '=', $users_id)->count();
        return $data;
    }
    //
}