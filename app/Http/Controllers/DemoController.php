<?php
	
	namespace App\Http\Controllers;
	
	use App\Friend;
	use App\Image;
	use App\Masterdata;
	use App\Post;
	use App\User;
	
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\DB;
	
	
	class DemoController extends Controller {
		//
		public function testconnect() {
			try {
				DB::connection()->getPdo();
				if (DB::connection()->getDatabaseName()) {
					echo 'Yes! Successfully connected to the DB: ' . DB::connection()->getDatabaseName();
				} else {
					die('Could not find the database. Please check your configuration.');
				}
			} catch (\Exception $e) {
				die('Could not open connection to database server.  Please check your configuration.');
			}
		}
		
		/**
		 * @param Request $request
		 */
		public function admin(Request $request) {
			$user1 = Auth::user();
			$id = $user1->id;
			$user = User::all();
			$count_friends = Friend::where(function ($q) {
				$q->where('sender_id', '=', Auth::user()->id)->orWhere('receive_id', '=', Auth::user()->id);
			})
			                       ->where('accept', '=', 1)
			                       ->where('delete_at', '=', 0)
			                       ->get();
			$request = Friend::where('receive_id', '=', $id)->where('accept', '=', 0)->where('delete_at', '=', 0)->get();
			
			return view('admin')->with('user', $user)->with('user1', $user1)->with('count_friends', $count_friends)->with('request', $request);
		}
		
		public function load() {
			$user = Auth::user();
			dd($user);
		}
		
		public function allPeople() {
			$id = Auth::id();
			$user1 = User::where('id', '=', $id)->with('sender')->get();
			$user = new User();
			$data = $user->getAll();
			//dd($user1);
			$count_friends = Friend::where(function ($q) {
				$q->where('sender_id', '=', Auth::user()->id)->orWhere('receive_id', '=', Auth::user()->id);
			})
			                       ->where('accept', '=', 1)
			                       ->where('delete_at', '=', 0)
			                       ->get();
			$request = Friend::where('receive_id', '=', $id)->where('accept', '=', 0)->where('delete_at', '=', 0)->get();
			
			return view('all_people')->with('users', $data)->with('user1', $user1)->with('count_friends', $count_friends)->with('request', $request);
		}
		
		public function addFriend($friend_id) {
			$new= new Friend();
			$new->addFriend($friend_id);
			return redirect()->back();
		}
		public function addFriend1(Request $rq)
		{
			$new= new Friend();
			$new->addFriend($rq->friend_id);
			return 1;
		}
		public function getRqfriend($id) {
			$user = Auth::user();
			
			$data = Friend::where('receive_id', '=', $id)
			              ->where('accept', '=', 0)
			              ->with('sender')
			              ->where('delete_at', '=', 0)
			              ->orderBy('id', 'desc')
			              ->get();
			//($data);
			// dd($data);
			$count_friends = Friend::where(function ($q) {
				$q->where('sender_id', '=', Auth::user()->id)->orWhere('receive_id', '=', Auth::user()->id);
			})
			                       ->where('accept', '=', 1)
			                       ->where('delete_at', '=', 0)
			                       ->get();
			$request = Friend::where('receive_id', '=', $id)
			                 ->where('accept', '=', 0)
			                 ->where('delete_at', '=', 0)
			                 ->get();
			
			// dd($count_friends);
			
			return view('rq_friends')
					->with('friends', $data)
					->with('user', $user)
					->with('count_friends', $count_friends)
					->with('request', $request);
		}
		
		public function accept($user_id, $friend_id) {
			//        echo "Đây là user_id".$user_id."<br>";
			//        echo "đây là friend_id ".$friend_id."<br>";
			//        $id=Auth::id();
			Friend::where('sender_id', '=', $user_id)->where('receive_id', '=', $friend_id)->update(['accept' => 1]);
			
			return redirect()->back();
		}
		public function accept_ajax(Request $rq)
		{
			$new = new Friend();
			$new ->accept($rq->friend_id,$rq->user_id);
			return response()->json([
					                        'user_id' => $rq->user_id,
					                        'friend_id'=>$rq->friend_id
			
			                        ]);
		}
		
		public function listFriend($id) {
			$user = Auth::user();
			$friends = Friend::where(function ($q) {
				$q->where('sender_id', '=', Auth::user()->id)->orWhere('receive_id', '=', Auth::user()->id);
			})
			                 ->where('accept', '=', 1)
			                 ->where('delete_at', '=', 0)
			                 ->orderBy('updated_at', 'DESC')
			                 ->get();
			$count_friends = $friends;
			$request = Friend::where('receive_id', '=', $id)->where('accept', '=', 0)->where('delete_at', '=', 0)->get();
			foreach ($friends as $friend) {
				$friend['friend'] = $friend->receive->id == $user->id ? $friend->sender : $friend->receive;
			}
			
			return view('list_friend')->with('friends', $friends)->with('user', $user)->with('count_friends', $count_friends)->with('request', $request);
		}
		public function refuse_test(Request $rq)
		{
			$sender_id=$rq->friend_id;
			$receive_id=$rq->user_id;
			$new = new Friend();
			$new->refuse($sender_id,$receive_id);
			return 1;
		}
		public function refuse($sender_id,$receive_id) {
			$relation = Friend::where('sender_id', '=', $sender_id)->where('receive_id', '=', $receive_id)->where('delete_at', '=', 0)->get();
			if (count($relation) > 0) {
				Friend::where('sender_id', '=', $sender_id)->where('receive_id', '=', $receive_id)->where('delete_at', '=', 0)->update(['delete_at' => 1]);
			} else {
				Friend::where('sender_id', '=', $receive_id)->where('receive_id', '=', $sender_id)->where('delete_at', '=', 0)->update(['delete_at' => 1]);
			}
			
			return Redirect()->back();
		}
		
		public function profile_friend($friend_id) {
			//echo abc;
			$friend1 = new Friend();
			$user = Auth::user();
			$post = $friend1->getFriendPost($friend_id);
			$post[0]['relationship'] = $friend1->getRelationship($friend_id);
			
			$count_friends = Friend::where(function ($q) {
				$q->where('sender_id', '=', Auth::user()->id)->orWhere('receive_id', '=', Auth::user()->id);
			})
			                       ->where('accept', '=', 1)
			                       ->where('delete_at', '=', 0)
			                       ->get();
			$request = Friend::where('receive_id', '=', Auth::user()->id)
			                 ->where('accept', '=', 0)
			                 ->where('delete_at', '=', 0)
			                 ->get();
			
			//dd($post);;
			return view('profile_friend')
					->with('user', $user)
					->with('data', $post)
					->with('count_friends', $count_friends)
					->with('request', $request);
		}
		
		public function edit_profile() {
			// $user=new User();
			$user = Auth::user();
			$blood1 = new Masterdata();
			$user['blood_name'] = $blood1->getBloodName($user->blood_type);
			$bloods = $blood1->getAllBlood();
			$count_friends = Friend::where(function ($q) {
				$q->where('sender_id', '=', Auth::user()->id)->orWhere('receive_id', '=', Auth::user()->id);
			})
			                       ->where('accept', '=', 1)
			                       ->where('delete_at', '=', 0)
			                       ->get();
			$request = Friend::where('receive_id', '=', Auth::user()->id)
			                 ->where('accept', '=', 0)
			                 ->where('delete_at', '=', 0)
			                 ->get();
			
			//dd($user->blood_name);
			return view('edit_profile')
					->with('user', $user)
					->with('bloods', $bloods)
					->with('count_friends', $count_friends)
					->with('request', $request);
		}
		
		public function update_info(Request $rq) {
			$user = User::where('id', '=', Auth::id())
			            ->where('delete_at', '=', 0)
			            ->update(['intro'         => $rq->intro,
			                      'nick_name'     => $rq->nick_name,
			                      'mobile'        => $rq->mobile,
			                      'birthday'      => $rq->birthday,
			                      'job'           => $rq->job,
			                      'adress'        => $rq->adress,
			                      'favorite_1'    => $rq->favorite_1,
			                      'favorite_2'    => $rq->favorite_2,
			                      'favorite_3'    => $rq->favorite_3,
			                      'personal_id'   => $rq->personal_id,
			                      'graduate_year' => $rq->graduate_year,
			                      'university'    => $rq->university,
			                      'high_school'   => $rq->high_school,
			                      'mobile'        => $rq->mobile,
			                      'gender'        => $rq->gender,
			                      'blood_type'    => $rq->blood_type != "" ? $rq->blood_type : NULL]);
			
			// dd($rq->blood_type);
			return redirect()->route('profilePost', ['id' => Auth::id()]);
		}
		
		public function image() {
			$user = Auth::user();
			$count_friends = Friend::where(function ($q) {
				$q->where('sender_id', '=', Auth::user()->id)->orWhere('receive_id', '=', Auth::user()->id);
			})
			                       ->where('accept', '=', 1)
			                       ->where('delete_at', '=', 0)
			                       ->get();
			$request = Friend::where('receive_id', '=', Auth::user()->id)
			                 ->where('accept', '=', 0)
			                 ->where('delete_at', '=', 0)
			                 ->get();
			$image = Image::where('user_id', '=', $user->id)->pluck('images');
			$image = trim($image[0]);
			//dd($image);
			$images = $image == '' ? NULL : explode(" ", $image);
			
			//dd($images);
			return view('images')
					->with('user', $user)
					->with('images', $images)
					->with('count_friends', $count_friends)
					->with('request', $request);
		}
		
		public function deleteImage(Request $rq) {
			$img = new Image();
			$rq->images == "" ? $rq->images = NULL : $rq->images;
			$img->DeleteImage($rq->images);
			
			return 1;
		}
		
		public function updateAvatar(Request $rq) {
			
			User::where('id', '=', Auth::id())->update(['avatar' => $rq->image]);
			
			return 1;
		}
		
		public function addBlock($user_id, $friend_id) {
			$new = new Friend();
			$new->addBlock($user_id, $friend_id);
			
			return redirect()->route('list_Block',['id' => Auth::id()]);
		}
		
		public function deleteBlock($user_id, $friend_id) {
			$new = new Friend();
			$new->deleteBlock($user_id, $friend_id);
			
			return redirect()->back();
		}
		
		public function list_block($user_id) {
			$user = Auth::user();
			
			$new = new Friend();
			$count_friends = $new->getCountFriend();
			$request = $new->getCountRq();
			$blocks = $new->getListBlock();
			
			//dd($blocks);
			return view('list_block')
					->with('count_friends', $count_friends)
					->with('request', $request)
					->with('user', $user)
					->with('blocks', $blocks);
		}
		public function error()
		{
			$msg="Không tìm thấy trang này";
			$new=new Friend();
			$count_friends = $new->getCountFriend();
			$request = $new->getCountRq();
			return view('error')
					->with('msg',$msg)
					->with('count_friends', $count_friends)
					->with('request', $request);
		}
		public function realtime()
		{
			$new=new Friend();
			$countfri=count($new->getCountFriend());
			$countrq=count($new->getCountRq());
		//	$friends=$new->get
			//echo $countrq;
			//echo $countfri;
			return response()->json([
					                        'countfri' => $countfri,
					                        'countrq'=>$countrq

			                        ]);
			
			
		}
		public function realtime2()
		{
			$id=Auth::id();
			$data = Friend::where('receive_id', '=', $id)
			              ->where('accept', '=', 0)
			              ->with('sender')
			              ->where('delete_at', '=', 0)
			              ->orderBy('id', 'desc')
			              ->get();
			$json= json_encode($data);
			//echo $json;
			return $json;
		}
	}
