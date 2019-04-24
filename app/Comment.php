<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Comment extends Model
{
    //
    /**
     * @var string
     */
    protected $table = 'comments';
    /**
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    /**
     * @return mixed
     */
    public function post()
    {
        return $this->belongsTo('App\Posts');
    }
    /**
     * @param Request $rq
     */
    public function addComment(Request $rq)
    {
        $new_comment = new Comment();
        $new_comment->users_id = $rq->users_id;
        $new_comment->posts_id = $rq->posts_id;
        $new_comment->content = $rq->content;
        $new_comment->save();

    }
    /**
     * @param $posts_id
     */
    public function deleteComment($posts_id)
    {
        $new = Comment::where('posts_id', '=', $posts_id)->delete();

    }
}