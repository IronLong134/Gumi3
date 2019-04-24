<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use App\Posts;
use App\User;
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
        return view('add_post')->with('users_id', $users_id)->with('data', $data)->with('user', $user);
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
        return Redirect()->route('profilePost', ['id' => $id]);
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
        return Redirect()->route('home');

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

        //dd($data);
        // dd($post1[0]['name']);
        //echo $post1[0]['name'];
        //dd($id);
        return view('post')->with('data', $data)->with('post', $post1)->with('user', $user)->with('posts_id', $id);
    }
    /**
     * @param Request $rq
     */
    public function addcomment2(Request $rq)
    {
        $new_comment = new Comment();
        $new_comment->addComment($rq);
        $id = $rq->posts_id;
        return redirect()->route('post', ['id' => $id]);

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
        return Redirect()->route('profilePost', ['id' => $request->id]);

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

        return Redirect()->route('profilePost', ['id' => $id]);
    }
    /**
     * @param $posts_id
     */
    public function addLike($posts_id)
    {
        $like = new Like();
        //dd($posts_id);
        $like->addLike($posts_id);
        return redirect()->back();
    }
}
