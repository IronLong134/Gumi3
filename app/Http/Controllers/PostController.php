<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use App\Post;
use App\User;
use App\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    //
    /**
     * @param $id
     */
    public function profilePost()
    {
        $user_id = Auth::id();
        $user = Auth::user();
        $post = new Post();
        $data = $post->getPostID($user_id);
    
        $id=Auth::user()->id;
        $count_friends=Friend::where(function ($q) {
            $q->where('sender_id','=',Auth::user()->id)->orWhere('receive_id','=',Auth::user()->id);})
                             ->where('accept', '=', 1)
                             ->where('delete_at','=',0)
                             ->get();
        $request=Friend::where('receive_id','=',$id)->where('accept','=',0)->where('delete_at','=',0)->get();
        
        return view('add_post')->with('user_id', $user_id)->with('data', $data)->with('user', $user)->with('count_friends',$count_friends)->with('request',$request);
    }
    /**
     * @param request $rq
     */

    /**
     * @param Request $request
     */
    public function addPost(Request $request)
    {
        $id = Auth::id();
        $new_post = new Post();
        $data = $new_post->getPostID($id);
        $new_post->addPost($request);
        
        return Redirect()->back();
    }
    public function test()
    {
        $new_post = new Post();
        $data = $new_post->getAllPost();
        dd($data);
    }
    /**
     * @param Request $rq
     */
    public function addComment(Request $rq)
    {
        $new_comment = new Comment();
        $new_comment->addComment($rq);
        return Redirect()->back();

    }
    /**
     * @param $id
     */
    public function getPost($id)
    {
        $user = Auth::user();
        $post = new Post();
        //  $post1 = App\Posts::leftjoin('users', 'posts.user_id', '=', 'users.id')->where('posts.id', '=', $id)->get();
        $comments = $post->getCmtPost($id);
        $post1 = $post->getPostById($id);
    
        $id=Auth::user()->id;
        $count_friends=Friend::where(function ($q) {
            $q->where('sender_id','=',Auth::user()->id)->orWhere('receive_id','=',Auth::user()->id);})
                             ->where('accept', '=', 1)
                             ->where('delete_at','=',0)
                             ->get();
        $request=Friend::where('receive_id','=',$id)->where('accept','=',0)->where('delete_at','=',0)->get();
        
        return view('post')->with('comments', $comments)->with('post', $post1)->with('user', $user)->with('post_id', $id)->with('count_friends',$count_friends)->with('request',$request);
    }
    /**
     * @param Request $rq
     */
    public function addcomment2(Request $rq)
    {
        $new_comment = new Comment();
        $new_comment->addComment($rq);
        $id = $rq->post_id;
        return redirect()->back();

    }
    /**
     * @param Request $request
     */
    public function update(Request $request)
    {
        $new = User::find($request->id);
        //******* */
        $this->validate($request, [
            'select_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
        ]);

        $image = $request->file('select_file');

        $new_name = rand().'.'.$image->getClientOriginalExtension();

        $image->move(public_path('imgs'), $new_name);
        $new->avatar = $new_name;
        $new->save();
        return Redirect()->back();

    }
    /**
     * @param $id
     */
    public function delete($post_id)
    {
        $id = Auth::id();
        $post = new Post();
        // Schema::disableForeignKeyConstraints();
        $comments = new Comment();
        $comments->deleteComment($post_id);
        $post->deletePost($post_id);
        // Schema::enableForeignKeyConstraints();

        return Redirect()->back();
    }

    /**
     * @param $post_id
     * @return array
     */
    public function addLike($post_id)
    {
        $like = new Like();
        return response()->json([
            'data' => $like->addLike($post_id)
        ]);
    }
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
        
        echo $check;
    }
}
