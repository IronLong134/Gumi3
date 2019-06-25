<?php

namespace App\Http\Controllers;

use App\Report;
use App\Friend;
use App\Image;
use App\Masterdata;
use App\Messenger;
use App\Post;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller {
	//
	public function admin_member() {
		$user1 = Auth::user();
		$id = $user1->id;
		$user1=new User();
		$users=$user1->getAllPeople();
		$json = json_encode($users);
		//dd($users);
		return $json;
	}

	public function admin_report() {
		$new = new Report();
		$reports = $new->getReport_Nodelete();
		$reports_delete = $new->getReport_delete();

		//dd($reports);
		return view('admin-reports')
				->with('reports', $reports)
				->with('reports_delete', $reports_delete);
	}

	public function admin_report_nodelete() {
		$new = new Report();
		$reports = $new->getReport_Nodelete();
		$reports_nodelete = json_encode($reports);

		return $reports_nodelete;
	}

	public function admin_report_delete() {
		$new = new Report();
		$reports = $new->getReport_delete();
		$reports_delete = json_encode($reports);

		return $reports_delete;
	}
	public function update_report(Request $rq){
		$new = new Report();
		return $new->update_report($rq->report_id);
	}
	public function profile_user($id){
		$user1 = new User();
		$user = $user1->getInfoUser($id);
		return view('admin-profile-friend')->with('data',$user);
	}
	public function Block_Acount(Request $rq){
		$user1 = new User();
		$user = $user1->getInfoUser($rq->user_id);
		if($user[0]->block==0){
			$user1->BlockAcount($rq->user_id);
			return 1;
		}else{
			$user1->UnBlockAcount($rq->user_id);
			return 2;
		}
	}
	public function getListBlock(){
		$user1 = new User();
		dd($user1->getListBlockAcount());
	}
}
