<?php
    
    namespace App\Http\Controllers;
    
    use App\Friend;
    use App\User;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Request;
    
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
                $q->where('sender_id', '=', Auth::user()->id->orWhere('receive_id', '=', Auth::user()->id);
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
            $id = Auth::id();
            $friend = Friend::where('sender_id', '=', $id)->where('receive_id', '=', $friend_id)->get();
            //$friend2= Friend::where('sender_id', '=', $friend_id)->where('receive_id','=',$id)->get();
            if (count($friend) == 0) {
                $rq_friend = new Friend();
                $rq_friend->sender_id = $id;
                $rq_friend->receive_id = $friend_id;
                //dd($friend_id);
                $rq_friend->save();
            } else {
                Friend::where('sender_id', '=', $id)->where('receive_id', '=', $friend_id)->update(['delete_at' => 0, 'accept' => 0]);
            }
            
            return redirect()->back();
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
            
            //dd($friends);
            return view('list_friend')->with('friends', $friends)->with('user', $user)->with('count_friends', $count_friends)->with('request', $request);
        }
        
        public function refuse($sender_id, $receive_id) {
            $relation = Friend::where('sender_id', '=', $sender_id)->where('receive_id', '=', $receive_id)->where('delete_at', '=', 0)->get();
            if (count($relation) > 0) {
                Friend::where('sender_id', '=', $sender_id)->where('receive_id', '=', $receive_id)->where('delete_at', '=', 0)->update(['delete_at' => 1]);
            } else {
                Friend::where('sender_id', '=', $receive_id)->where('receive_id', '=', $sender_id)->where('delete_at', '=', 0)->update(['delete_at' => 1]);
            }
            
            return Redirect()->back();
        }
    }
