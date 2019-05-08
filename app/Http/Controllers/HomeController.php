<?php
namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Friend;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $user = Auth::user();
        
        
        $post = new Post();
        $data = $post->getAllPost();
        $my_posts=$post->getPostID( Auth::user()->id);
        $id=Auth::user()->id;
        $count_friends=Friend::where(function ($q) {
            $q->where('sender_id','=',Auth::user()->id)->orWhere('receive_id','=',Auth::user()->id);})
                             ->where('accept', '=', 1)
                             ->where('delete_at','=',0)
                             ->get();
        $request=Friend::where('receive_id','=',$id)->where('accept','=',0)->where('delete_at','=',0)->get();

        return view('wall')->with('user', $user)->with('datas', $data)->with('count_friends',$count_friends)->with('request',$request)->with('my_posts',$my_posts);
       // return view('test')->with('user', $user)->with('datas', $data);
    }
    /**
     * @param $user_id
     */
   

}
