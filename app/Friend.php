<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model {
	protected $table = 'friends';

	public function sender() {
		return $this->belongsTo('App\User', 'sender_id');
	}

	public function receiver() {
		return $this->belongsTo('App\User', 'receiver_id');
	}

	public function getFriend() {
		$id = Auth::user()->id;
		$friends = Friend::where(function ($q) {
			$q->where('sender_id', '=', Auth::user()->id)
				->orWhere('receiver_id', '=', Auth::user()->id);
		})
										 ->orderBy('updated_at', 'DESC')
										 ->where('accept', '=', 1)
										 ->with(['sender' => function ($q) {
											 $q->where('block', '=', 0);
										 }])
										 ->with(['receiver' => function ($q) {
											 $q->where('block', '=', 0);
										 }])
										 ->where('delete_at', '=', 0)
										 ->get();
		$receiver_ids = $friends->where('sender_id', '=', Auth::user()->id)->pluck('receiver_id');
		$sender_ids = $friends->where('receiver_id', '=', Auth::user()->id)->pluck('sender_id');//lấy id bạn bè qua 2 trường hợp , bạn là người gửi hoặc bạn là người nahanj
		$list = array_merge($receiver_ids->toArray(), $sender_ids->toArray());
		array_push($list, $id);

		return $list;
	}

	public function GetDayAcceptFriend($friend_id) {
		$relationship = $friends = Friend::where(function ($q) use ($friend_id) {
			$q->where('sender_id', '=', Auth::user()->id)
				->Where('receiver_id', '=', $friend_id);
		})->orwhere(function ($q) use ($friend_id) {
			$q->where('sender_id', '=', $friend_id)
				->Where('receiver_id', '=', Auth::user()->id);
		})
																		 ->where('accept', '=', 1)
																		 ->where('delete_at', '=', 0)
																		 ->first();

		return $relationship;
	}

	public function getRelationship($friend_id) {
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

		$check = 'no';
		foreach ($friends as $friend) {
			if ($friend_id == $friend) // 1 3 5 7
			{
				$check = 'friend';
			}
		}
		foreach ($receiverIds as $receiverId) {
			if ($friend_id == $receiverId) // 1 3 5 7
			{
				$check = 'sended';
			}
		}
		foreach ($senderIds as $senderId) {
			if ($friend_id == $senderId) {
				$check = 'request';
			}
		}

		return $check;
	}

	public function getFriendPost($id) {
		$post = User::where('id', '=', $id)->with(['post' => function ($q) {
			$q->where('delete_at', '=', 0)->with('user');
		}])->get();

		return $post;
	}

	public function addBlock($user_id, $friend_id) {
		$record = Friend::where('sender_id', '=', Auth::user()->id)
										->where('receiver_id', '=', $friend_id)
										->first();
		//dd($record);
		$block_me = Friend::where('sender_id', '=', $friend_id)
											->where('receiver_id', '=', Auth::user()->id)
											->where('accept', '=', 3)
											->where('delete_at', '=', 0)
											->first();
		if ($record) {
			Friend::where('sender_id', '=', Auth::user()->id)
						->where('receiver_id', '=', $friend_id)
						->update(['accept' => 3, 'delete_at' => 0]);

			Friend::where('sender_id', '=', $friend_id)
						->where('receiver_id', '=', Auth::user()->id)
						->update(['accept' => 0, 'delete_at' => 1]);

		} else {
			$new = new Friend();
			$new->sender_id = Auth::id();
			$new->receiver_id = $friend_id;
			$new->accept = 3;
			$new->save();

			Friend::where('sender_id', '=', $friend_id)
						->where('receiver_id', '=', Auth::user()->id)
						->update(['accept' => 0, 'delete_at' => 1]);

		}
		// echo 123;
	}

	public function deleteBlock($user_id, $friend_id) {
		Friend::where('sender_id', '=', Auth::user()->id)
					->where('receiver_id', '=', $friend_id)
					->update(['accept' => 0, 'delete_at' => 1]);
	}

	public function getListBlock() {
		$blocks = Friend::where('sender_id', '=', Auth::id())
										->where('accept', '=', 3)
										->where('delete_at', '=', 0)
										->with('receiver')
										->get();

		return $blocks;
	}

	public function getIdBlock() {
		$blocks = Friend::where(function ($q) {  // lấy tất cả những record chưa xóa trong bảng friends có id của mình .
			$q->where('sender_id', '=', Auth::user()->id)
				->orWhere('receiver_id', '=', Auth::user()->id);
		})
										->orderBy('updated_at', 'DESC')
										->where('accept', '=', 3)
										->where('delete_at', '=', 0)
										->get();
		$receiverIds = $blocks->where('sender_id', '=', Auth::user()->id)->pluck('receiver_id');// ta là ng gửi,lấy người nhận
		$senderIds = $blocks->where('receiver_id', '=', Auth::user()->id)->pluck('sender_id');
		$list = array_merge($receiverIds->toArray(), $senderIds->toArray());

		//array_push($list, $id);

		return $list;
	}

	public function getCountFriend() {
		$count_friends = Friend::where(function ($q) {
			$q->where('sender_id', '=', Auth::user()->id)->orWhere('receiver_id', '=', Auth::user()->id);
		})
													 ->where('accept', '=', 1)
													 ->with(['sender', 'receiver'])
													 ->where('delete_at', '=', 0)
													 ->get();
		foreach ($count_friends as $key=>$count_friend){
			$count_friend['friend']= Auth::id()==$count_friend->sender_id ? $count_friend->receiver : $count_friend->sender;
			if($count_friend->friend->block==1){
				unset($count_friends[$key]);
			}
		}
		return $count_friends;
	}

	public function getCountRq() {
		$requests = Friend::where('receiver_id', '=', Auth::user()->id)
										 ->where('accept', '=', 0)
										 ->where('delete_at', '=', 0)
										 ->get();
		foreach ($requests as $key=>$request){
			$request['friend']= Auth::id()==$request->sender_id ? $request->receiver : $request->sender;
			if($request->friend->block==1){
				unset($requests[$key]);
			}
		}
		return $requests;
	}

	public function refuse($sender_id, $receiver_id) {
		$relation = Friend::where('sender_id', '=', $sender_id)->where('receiver_id', '=', $receiver_id)->where('delete_at', '=', 0)->get();
		if (count($relation) > 0) {
			Friend::where('sender_id', '=', $sender_id)->where('receiver_id', '=', $receiver_id)->where('delete_at', '=', 0)->update(['delete_at' => 1]);
		} else {
			Friend::where('sender_id', '=', $receiver_id)->where('receiver_id', '=', $sender_id)->where('delete_at', '=', 0)->update(['delete_at' => 1]);
		}
	}

	public function addFriend($friend_id) {
		$id = Auth::id();
		$friend = Friend::where('sender_id', '=', $id)->where('receiver_id', '=', $friend_id)->get();
		//$friend2= Friend::where('sender_id', '=', $friend_id)->where('receiver_id','=',$id)->get();
		if (count($friend) == 0) {
			$rq_friend = new Friend();
			$rq_friend->sender_id = $id;
			$rq_friend->receiver_id = $friend_id;
			//dd($friend_id);
			$rq_friend->save();
		} else {
			Friend::where('sender_id', '=', $id)->where('receiver_id', '=', $friend_id)->update(['delete_at' => 0, 'accept' => 0]);
		}
	}

	public function accept($user_id, $friend_id) {
		Friend::where('sender_id', '=', $user_id)->where('receiver_id', '=', $friend_id)->update(['accept' => 1]);
	}
}
