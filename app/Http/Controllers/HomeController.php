<?php
namespace App\Http\Controllers;

use App\Posts;
use App\User;
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
        //return view('home');
        $user = Auth::user();
        //$post = new Post();
        $post = new Posts();
        $data = $post->getAllPost();
        // foreach ($data as $key) {
        //     # code...
        //     echo $key['id'];
        //     echo $key->content.'<br>';
        // }
        // dd($data);
        //$data1 = $data->get_all();

        return view('wall')->with('user', $user)->with('datas', $data);

    }
    /**
     * @param $users_id
     */

}