<?php
namespace App\Http\Controllers;

use App\Posts;
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
        
        
        $post = new Posts();
        $data = $post->getAllPost();
        $id=Auth::user()->id;
        $count_friends=Friend::where('sender_id','=',$id)->orwhere('receive_id','=',$id)->where('accept','=',1)->where('delete_at','=',0)->get();
        $request=Friend::where('receive_id','=',$id)->where('accept','=',0)->where('delete_at','=',0)->get();

        return view('wall')->with('user', $user)->with('datas', $data)->with('count_friends',$count_friends)->with('request',$request);

    }
    /**
     * @param $users_id
     */
   

}
