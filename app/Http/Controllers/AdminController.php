<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller {
	//
	public function admin(Request $request) {
		$user1 = Auth::user();
		$id = $user1->id;
		$user = User::all();
		$count_friends = Friend::where(function ($q) {
			$q->where('sender_id', '=', Auth::user()->id)->orWhere('receiver_id', '=', Auth::user()->id);
		})
													 ->where('accept', '=', 1)
													 ->where('delete_at', '=', 0)
													 ->get();
		$request = Friend::where('receiver_id', '=', $id)->where('accept', '=', 0)->where('delete_at', '=', 0)->get();

		return view('admin')->with('user', $user)->with('user1', $user1)->with('count_friends', $count_friends)->with('request', $request);
	}

	public function Admin_report(){

}
}
