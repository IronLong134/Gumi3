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
			                       ->orderBy('id', 'DESC')
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
	}
