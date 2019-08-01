<?php

namespace App\Http\Controllers;

use App\Admin;
use Cookie;
use App\Report;
use Illuminate\Http\Response;
use App\Friend;
use App\Image;
use App\Masterdata;
use App\Messenger;
use App\Post;
//use Illuminate\Validation\Validator;
use Validator;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class AdminController extends Controller {

	public function get_login() {
		return view('admin-view.admin-login');
	}

	public function PostLogin(Request $request) {
		$admin = new Admin();
		$rules = [
				'email'    => 'required|string|email',
				'password' => 'required|string|min:8'
		];
		$messages = [
				'email.required'    => 'Email là trường bắt buộc',
				'email.email'       => 'Email không đúng định dạng',
				//				'email.unique:admins' => 'email này đã được sử dụng',
				'password.required' => 'Mật khẩu là trường bắt buộc',
				'password.min'      => 'Mật khẩu phải chứa ít nhất 8 ký tự',
		];
		$validator = Validator::make($request->all(), $rules, $messages);

		if ($validator->fails()) {
			$error = $validator->errors()->first();
			//return redirect()->back()->withErrors($validator);
			$json = json_encode($error);

			return $json;

		} else {
			$email = $request->email;
			$password = $request->password;
			if (count($admin->checklogin($email, $password)) > 0) {
				//dd($admin->checklogin($email,$password));
				session(['email' => $email, 'password' => $password]);

				return 1;
				//				$new = new Report();
				//				$reports = $new->getReport_Nodelete();
				//				$reports_delete = $new->getReport_delete();
				//				return view('admin-view.report')->with('reports', $reports)
				//																				->with('reports_delete', $reports_delete);
			} else {
				//$errors = new MessageBag(['errorlogin' => 'Email hoặc mật khẩu không đúng']);
				$json = json_encode("Email hoặc mật khẩu không đúng");

				//				return redirect()->back()->withInput()->withErrors($errors);
				return $json;
			}
			//				dd($email);
		}

	}

	public function success(Request $request) {
		$value = $request->session()->get('email', '0');
		echo $value;

		return view('admin-view.success');
	}

	public function Report2() {
		$new = new Report();
		$reports = $new->getReport_Nodelete();
		$reports_delete = $new->getReport_delete();

		return view('admin-view.report')->with('reports', $reports)
																		->with('reports_delete', $reports_delete);
	}

	public function Member2() {
		return view('admin-view.members');
	}

	public function logout(Request $request) {
		$request->session()->forget(['email', 'password']);

		$value = $request->session()->get('email', '0');

		return view('admin-view.admin-login');

	}

	public function admin_member() {
		$user1 = Auth::user();
		$id = $user1->id;
		$user1 = new User();
		$users = $user1->getAllPeople();
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

	public function update_report(Request $rq) {
		$new = new Report();
		$new->update_report($rq->report_id);
		$report = $new->getReport($rq->report_id);
		return json_encode($report);

	}

	public function profile_user($id) {
		$user1 = new User();
		$user = $user1->getInfoUser($id);

		return view('admin-profile-friend')->with('data', $user);
	}

	public function Block_Acount(Request $rq) {
		$user1 = new User();
		$user = $user1->getInfoUser($rq->user_id);
		if ($user[0]->block == 0) {
			$user1->BlockAcount($rq->user_id);

			return 1;
		} else {
			$user1->UnBlockAcount($rq->user_id);

			return 2;
		}
	}

	public function list_block() {
		$user1 = new User();
		$json = json_encode($user1->getListBlockAcount());

		return $json;
	}

	public function list_admins() {
		$user1 = new User();
		$json = json_encode($user1->getListAdmins());

		return $json;
	}

}
