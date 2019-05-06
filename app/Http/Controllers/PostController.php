<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use App\Posts;
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
        $users_id = Auth::id();
        $user = Auth::user();
        $post = new Posts();
        $data = $post->getPostID($users_id);
    
        $id=Auth::user()->id;
        $count_friends=Friend::where('sender_id','=',$id)->orwhere('receive_id','=',$id)->where('accept','=',1)->get();
        $request=Friend::where('receive_id','=',$id)->where('accept','=',0)->get();
        
        return view('add_post')->with('users_id', $users_id)->with('data', $data)->with('user', $user)->with('count_friends',$count_friends)->with('request',$request);
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
        $new_post = new Posts();
        $data = $new_post->getPostID($id);
        $new_post->addPost($request);
        
        return Redirect()->back();
    }
    public function test()
    {
        $new_post = new Posts();
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
        $post = new Posts();
        //  $post1 = App\Posts::leftjoin('users', 'posts.users_id', '=', 'users.id')->where('posts.id', '=', $id)->get();
        $data = $post->getPost($id);
        $post1 = $post->getUserPost($id);
    
        $id=Auth::user()->id;
        $count_friends=Friend::where('sender_id','=',$id)->orwhere('receive_id','=',$id)->where('accept','=',1)->get();
        $request=Friend::where('receive_id','=',$id)->where('accept','=',0)->get();
        
        return view('post')->with('data', $data)->with('post', $post1)->with('user', $user)->with('posts_id', $id)->with('count_friends',$count_friends)->with('request',$request);
    }
    /**
     * @param Request $rq
     */
    public function addcomment2(Request $rq)
    {
        $new_comment = new Comment();
        $new_comment->addComment($rq);
        $id = $rq->posts_id;
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
    public function delete($posts_id)
    {
        $id = Auth::id();
        $post = new Posts();
        // Schema::disableForeignKeyConstraints();
        $comments = new Comment();
        $comments->deleteComment($posts_id);
        $post->deletePost($posts_id);
        // Schema::enableForeignKeyConstraints();

        return Redirect()->back();
    }

    /**
     * @param $posts_id
     * @return array
     */
    public function addLike($posts_id)
    {
        $like = new Like();
        return response()->json([
            'data' => $like->addLike($posts_id)
        ]);
    }
}
