<?php
	
	namespace App\Http\Controllers;
	
	use App\Comment;
	use App\Like;
	use App\Post;
	use App\User;
	use App\Friend;
	use App\masterdata;
	use App\Image;
	use App\Messenger;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Redirect;
	
	class ChatController extends Controller {
		/**
		 * @param Request $rq
		 */
		
		public function chat($friend_id) {
			$user = Auth::user();
			$new = new Messenger();
			$new1 = new Friend();
			$new3 = new User();
			$friend = $new3->getInfoUser($friend_id);
			$messengers = $new->getMessenger(Auth::id(), $friend_id);
			
			return view('chat')
					->with('messengers', $messengers)
					->with('user', $user)
					->with('friend', $friend);
			
		}
		
		public function load(Request $rq) {
			$new = new Messenger();
			$messengers = $new->getMessenger(Auth::id(), $rq->friend_id);
			$messengers['count'] = count($messengers);
			$json = json_encode($messengers);
			
			return $json;
		}
		
		public function addMsg(Request $rq) {
			$new = new Messenger();
			if ($new->addMsg($rq->user_id, $rq->friend_id, $rq->content)) {
				return 1;
			} else {
				return 0;
			}
		}
		
		public function getListMsg() {
			$new = new Messenger();
			$messengers = $new->getListMsg();
			dd($messengers);
			//return $messengers;
			
		}
		
		public function testchat() {
			$new = new Messenger();
			dd($new->getListMsg_Full());
		}
		
		public function listChat() {
			$msg = new Messenger();
			$messengers=$msg->getListMsg_Full();
			return view('list-chat')
					->with('messengers',$messengers);
		}
		public function update_listChat(){
			$msg = new Messenger();
			$messengers=$msg->getListMsg_Full();
			$json = json_encode($messengers);
			return $json;
		}
		public function seen(Request $rq){
			$msg = new Messenger();
			if($msg->seen($rq->user_id,$rq->friend_id)){
				return 1;
			}
			else{
				return 0;
			}
		}
		//
	}