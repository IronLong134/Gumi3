<?php
    
    namespace App;
    
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Database\Eloquent\Model;
    
    class Friend extends Model {
        protected $table = 'friends';
        
        public function sender() {
            return $this->belongsTo('App\User', 'sender_id');
        }
        
        public function receive() {
            return $this->belongsTo('App\User', 'receive_id');
        }
        
        public function getFriend() {
            $id = Auth::user()->id;
            $friends = Friend::where(function ($q) {
                $q->where('sender_id', '=', Auth::user()->id)
                  ->orWhere('receive_id', '=', Auth::user()->id);
            })
                             ->orderBy('updated_at', 'DESC')
                             ->where('accept', '=', 1)
                             ->where('delete_at', '=', 0)
                             ->get();
            $receive_ids = $friends->where('sender_id', '=', Auth::user()->id)->pluck('receive_id');
            $sender_ids = $friends->where('receive_id', '=', Auth::user()->id)->pluck('sender_id');//lấy id bạn bè qua 2 trường hợp , bạn là người gửi hoặc bạn là người nahanj
            $list = array_merge($receive_ids->toArray(), $sender_ids->toArray());
            array_push($list, $id);
            
            return $list;
        }
        
        public function GetDayAcceptFriend($friend_id) {
            $relationship = $friends = Friend::where(function ($q) use ($friend_id) {
                $q->where('sender_id', '=', Auth::user()->id)
                  ->Where('receive_id', '=', $friend_id);
            })->orwhere(function ($q) use ($friend_id) {
                $q->where('sender_id', '=', $friend_id)
                  ->Where('receive_id', '=', Auth::user()->id);
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
                  ->orWhere('receive_id', '=', Auth::user()->id);
            })
                            ->orderBy('updated_at', 'DESC')
                            ->where('accept', '=', 0)
                            ->where('delete_at', '=', 0)
                            ->get();
            $receiveIds = $record->where('sender_id', '=', Auth::user()->id)->pluck('receive_id');// ta là ng gửi,lấy người nhận
            $senderIds = $record->where('receive_id', '=', Auth::user()->id)->pluck('sender_id');//ta là người nhận, lấy người gửi
            
            $check = 'no';
            foreach ($friends as $friend) {
                if ($friend_id == $friend) // 1 3 5 7
                {
                    $check = 'friend';
                }
            }
            foreach ($receiveIds as $receiveId) {
                if ($friend_id == $receiveId) // 1 3 5 7
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
    }
