<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Comment extends Model {
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
	public function user() {
		return $this->belongsTo('App\User');
	}

	/**
	 * @return mixed
	 */
	public function post() {
		return $this->belongsTo('App\Post');
	}

	/**
	 * @param Request $rq
	 */
	public function addComment(Request $rq) {
		$new_comment = new Comment();
		$new_comment->user_id = $rq->user_id;
		$new_comment->post_id = $rq->post_id;
		$new_comment->content = $rq->content;
		$new_comment->save();

	}

	/**
	 * @param $post_id
	 */
	public function deleteComment($post_id) {
		// TODO: nếu ko return gì thì ko nên tạo biến mới
		$new = Comment::where('post_id', '=', $post_id)->delete();

	}
}
