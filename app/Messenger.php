<?php
	
	namespace App;
	
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
		
		public function getListMsg() {
			$id = Auth::id();
			$messengers = Messenger::where('sender_id', '=', Auth::id())
			                       ->orwhere('receiver_id', '=', Auth::id())
			                       ->orderBy('id', 'ASC')
			                       ->with(['sender_msg', 'receiver_msg'])
			                       ->get();
			$sender_to_me= Messenger::where('receiver_id', '=', Auth::id())
			                        ->orderBy('id', 'ASC')
			                        ->with(['sender_msg', 'receiver_msg'])
			                        ->get();
			$messengers_not_reads = Messenger::where('receiver_id', '=', Auth::id())
			                                 ->where('status', '=', 0)
			                                 ->orderBy('id', 'ASC')
			                                 ->get();
			$info_no_reads = Messenger::where('receiver_id', '=', Auth::id())
			                                  ->where('status', '=', 0)
			                                  ->orderBy('id', 'ASC')
			                                  ->pluck('sender_id');
			
			foreach ($messengers as $messenger) {
				foreach ($messengers_not_reads as $messengers_not_read) {
					$messenger['count_no_read'] = 0;
					$messenger['read_status'] = '';
					if ($messenger->sender_id == $messengers_not_read->sender_id) {
						$messenger['read_status'] = 'no_read';// ta là người nhận + chưa đọc
					}
				}
			}
			
//			foreach ($messengers as $messenger) {
//				$list = '';
//				if ($messenger['read_status'] == 'no_read') {
//					foreach ($messengers_not_reads as $messengers_not_read) {
//
//					}
//				}
//			}
			
			return $info_no_reads;
			
		}
	}
