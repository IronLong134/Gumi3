<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable {
	use Notifiable;
	/**
	 * @var string
	 */
	protected $table = 'users';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'name', 'email', 'password', 'style', 'birthday', 'gender', 'mobile', 'personal_id'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
			'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
			'email_verified_at' => 'datetime',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function post() {
		return $this->hasMany('App\Post');
	}

	public function image() {
		return $this->hasOne('App\Image');
	}

	/**
	 * @return mixed
	 */
	public function comment() {
		return $this->hasMany('App\Comment', 'user_id');
	}

	public function sender() {
		return $this->hasMany('App\Friend', 'sender_id');
	}

	public function receiver() {
		return $this->hasMany('App\Friend', 'receiver_id');
	}

	public function sender_msg() {
		return $this->hasMany('App\Messenger', 'sender_id');
	}

	public function receiver_msg() {
		return $this->hasMany('App\Messenger', 'receiver_id');
	}

	public function sender_report() {
		return $this->hasMany('App\Report', 'sender_id');
	}

	public function receiver_report() {
		return $this->hasMany('App\Report', 'receiver_id');
	}

	/**
	 * @return mixed
	 */

	/**
	 * @return mixed
	 */
	public function getAll() {
		$id = Auth::id();
		$new = new Friend();
		$list = $new->getIdBlock();
		$users = User::where('id', '!=', $id)
								 ->whereNotIn('id', $list)
								 ->where('block', '=', 0)
								 ->with('sender', 'comment')
								 ->orderBy('id', 'DESC')
								 ->get();
		$friend1 = new Friend();
		$friends = $friend1->getFriend();//Lấy danh sách bạn bè
		$record = Friend::where(function ($q) {  // lấy tất cả những record chưa xóa trong bảng friends có id của mình .
			$q->where('sender_id', '=', Auth::user()->id)
				->orWhere('receiver_id', '=', Auth::user()->id);
		})
										->orderBy('updated_at', 'DESC')
										->where('accept', '=', 0)
										->where('delete_at', '=', 0)
										->get();

		$receiverIds = $record->where('sender_id', '=', Auth::user()->id)->pluck('receiver_id');// ta là ng gửi,lấy người nhận
		$senderIds = $record->where('receiver_id', '=', Auth::user()->id)->pluck('sender_id');//ta là người nhận, lấy người gửi
		foreach ($users as $user) {
			$user['check'] = 'no';
			foreach ($friends as $friend) {
				if ($user->id == $friend) // 1 3 5 7
				{
					$user['check'] = 'friend';
				}
			}
			foreach ($receiverIds as $receiverId) {
				if ($user->id == $receiverId) // 1 3 5 7
				{
					$user['check'] = 'sended';
				}
			}
			foreach ($senderIds as $senderId) {
				if ($user->id == $senderId) {
					$user['check'] = 'request';
				}
			}
		}

		return $users;

		//return $users;
	}

	public function getInfoUser($id) {
		$info = User::where('id', '=', $id)->get();

		return $info;
	}

	public function getAllPeople() {
		$data = User::orderBy('created_at', 'DESC')->get();

		return $data;
	}

	public function BlockAcount($id) {
		User::where('id', '=', $id)->update(['block' => 1]);
	}

	public function UnBlockAcount($id) {
		User::where('id', '=', $id)->update(['block' => 0]);
	}

	public function getListBlockAcount() {
		$block = User::where('block', '=', 1)->get();

		//
		return $block;
	}
	public function getListAdmins() {
		$admin = User::where('style','=','admin')->where('block', '=', 0)->get();

		//
		return $admin;
	}
}
