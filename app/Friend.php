<?php
    
    namespace App;
    
    use App\Like;
    use App\User;
    use Illuminate\Database\Eloquent\Model;
    
    class Friend extends Model {
        protected $table = 'friends';
        public function sender()
        {
            return $this->belongsTo('App\User', 'sender_id');
        }
        public function receive()
        {
            return $this->belongsTo('App\User', 'receive_id');
        }
        public function getInfoFriend()
        {
            $id = Auth::user()->id;
            $friends = Friend::where(function ($q) {
                $q->where('sender_id', '=', Auth::user()->id)
                  ->orWhere('receive_id', '=', Auth::user()->id);
            })
                             ->orderBy('updated_at', 'DESC')
                             ->where('accept', '=', 1)
                             ->where('delete_at', '=', 0)
                             ->get();
    
            $receive_ids=$friends->where('sender_id', '=', Auth::user()->id)->pluck('receive_id');
            $sender_ids=$friends->where('receive_id', '=', Auth::user()->id)->pluck('sender_id');
            $list=array_merge($receive_ids->toArray(), $sender_ids->toArray());
            array_push($list, $id);
            $info_friends= User::whereIn('id',$list)->get();
        }
    }
