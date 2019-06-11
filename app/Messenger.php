<?php
	
	namespace App;
	
	use App\Http\Controllers\ChatController;
	use Illuminate\Database\Eloquent\Model;
	use App\Comment;
	use App\Like;
	use App\Post;
	use App\User;
	use App\Friend;
	use App\masterdata;
	use App\Image;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Redirect;
	
	class Messenger extends Model {
		/**
		 * @var string
		 */
		
		protected $table = 'messengers';
		
		/**
		 * @param $sender_id
		 * @param $content
		 */
		public function sender_msg() {
			return $this->belongsTo('App\User', 'sender_id');
		}
		
		public function receiver_msg() {
			return $this->belongsTo('App\User', 'receiver_id');
		}
		
		public function getMessenger($user_id, $friend_id) {
			$id = Auth::id();
			$messengers = Messenger::where(function ($q) use ($user_id, $friend_id) {
				$q->where('sender_id', '=', $user_id)->where('receiver_id', '=', $friend_id);
			})
			                       ->orwhere(function ($q) use ($user_id, $friend_id) {
				                       $q->where('sender_id', '=', $friend_id)->where('receiver_id', '=', $user_id);
			                       })
			                       ->orderBy('id', 'ASC')
			                       ->with(['sender_msg', 'receiver_msg'])
			                       ->get();
			foreach ($messengers as $messenger) {
				$messenger['sender_info'] = $messenger->sender_msg;
				if ($messenger->sender_id == $id) {
					$messenger['from'] = 'me';
					
				} else if ($messenger->receiver_id == $id) {
					$messenger['from'] = 'friend';
				}
			}
			
			//dd($messengers);
			return $messengers;
		}
		
		public function addMsg($sender_id, $receiver_id, $content) {
			$new = new Messenger();
			$new->sender_id = $sender_id;
			$new->receiver_id = $receiver_id;
			$new->content = $content;
			$new->save();
			
		}
		
		public function getListMsg_NoRead() {//lấy thông tin và số lượng của tin nhắn chưa đọc
			$id = Auth::id();
			$messengers = Messenger::where('receiver_id', '=', Auth::id())
			                       ->where('status', '=', 0)
			                       ->orderBy('id', 'DESC')
			                       ->get();
			$lists = [];
			$user_infos = [];
			if (count($messengers) > 0) {
				foreach ($messengers as $messenger) {
					array_push($lists, $messenger->sender_id);
				}
				$lists = array_unique($lists);
				$lists_str = implode(",", $lists);
				
				$user_infos = User::whereIn('id', $lists)
				                  ->orderByRaw("FIELD(id, $lists_str)")->get();
				foreach ($user_infos as $user_info) {
					$user_id = $user_info->id;
					$user_info['count']= Messenger::where(function ($q) use ($user_id) {
						$q->where('receiver_id', '=', Auth::id())->where('sender_id', '=', $user_id);
					})
							->where('status','=',0)
					                 ->count();
					$last_msg = Messenger::where(function ($q) use ($user_id) {
						$q->where('receiver_id', '=', Auth::id())->where('sender_id', '=', $user_id);
					})
					                     ->with(['sender_msg', 'receiver_msg'])
					                     ->orderBy('created_at', 'DESC')
					                     ->limit(1)->get();
					$user_info->last_msg = $last_msg;
				}
			}
			//
			//dd($user_infos);
			return $user_infos;
		}
		
		public function getListMsg_Readed()// lấy thông tin của những người ddag ns chyện và ko có tin nhắn chưa đọc
		{
			$id = Auth::id();
			$messengers = Messenger::where(function ($q) {
				$q->where('sender_id', '=', Auth::id())->orwhere('receiver_id', '=', Auth::id());
			})
			                       ->where('status', '=', 1)
			                       ->orderBy('id', 'DESC')
			                       ->get();
			$lists = [];
			$user_infos = [];
			if (count($messengers) > 0) {
				foreach ($messengers as $messenger) {
					if ($messenger->sender_id == $id) {
						$messenger['from'] = 'me';
						array_push($lists, $messenger->receiver_id);
						
					} else if ($messenger->receiver_id == $id) {
						$messenger['from'] = 'friend';
						array_push($lists, $messenger->sender_id);
					}
				}
				
				$lists = array_unique($lists);
				$lists_str = implode(",", $lists);
				
				$user_infos = User::whereIn('id', $lists)
				                  ->orderByRaw("FIELD(id, $lists_str)")->get();
				foreach ($user_infos as $user_info) {
					$user_id = $user_info->id;
					$last_msg = Messenger::where(function ($q) use ($user_id) {
						$q->where('sender_id', '=', Auth::id())->where('receiver_id', '=', $user_id);
					})
					                     ->orwhere(function ($q) use ($user_id) {
						                     $q->where('receiver_id', '=', Auth::id())->where('sender_id', '=', $user_id);
					                     })
					                     ->with(['sender_msg', 'receiver_msg'])
					                     ->orderBy('created_at', 'DESC')
					                     ->limit(1)->get();
					$last_msg[0]->sender_msg->id == Auth::id() ? $last_msg['from'] = 'me' : $last_msg['from'] = 'friend';
					$user_info->last_msg = $last_msg;
				}
			}
			
			//dd($user_infos);
			return $user_infos;
		}
		
		public function getMsg_Noread_Jquery() {
			$new = new Messenger();
			$id = Auth::id();
			$messengers = Messenger::where('receiver_id', '=', Auth::id())
			                       ->where('status', '=', 0)
			                       ->orderBy('id', 'DESC')
			                       ->get();
			
			return $messengers;
			
		}
		
	}
