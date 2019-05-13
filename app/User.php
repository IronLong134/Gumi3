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
            'name', 'email', 'password', 'style',
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
        
        /**
         * @return mixed
         */
        public function comment() {
            return $this->hasMany('App\Comment', 'user_id');
        }
        
        public function sender() {
            return $this->hasMany('App\Friend', 'sender_id');
        }
        
        public function receive() {
            return $this->hasMany('App\Friend', 'receive_id');
        }
        
        /**
         * @return mixed
         */
        public function messengers() {
            return $this->hasMany('App\Messengers');
        }
        
        /**
         * @return mixed
         */
        public function getAll() {
            $id = Auth::id();
            $users = User::where('id', '!=', $id)->with('sender', 'comment')->orderBy('id', 'DESC')->get();
            $friend1 = new Friend();
            $friends = $friend1->getFriend();//Lấy danh sách bạn bè
            $record= Friend::where(function ($q) {  // lấy tất cả những record chưa xóa trong bảng friends có id của mình .
                $q->where('sender_id', '=', Auth::user()->id)
                  ->orWhere('receive_id', '=', Auth::user()->id);
            })
                           ->orderBy('updated_at', 'DESC')
                           ->where('accept', '=', 0)
                           ->where('delete_at', '=', 0)
                           ->get();
            $receiveIds= $record->where('sender_id', '=', Auth::user()->id)->pluck('receive_id');// ta là ng gửi,lấy người nhận
            $senderIds= $record->where('receive_id', '=', Auth::user()->id)->pluck('sender_id');//ta là người nhận, lấy người gửi
            foreach ($users as $user) {
                $user['check']='no';
                foreach ($friends as $friend)
                {
                    if($user->id==$friend) // 1 3 5 7
                    {
                        $user['check']='friend';
                    }
                }
                foreach ($receiveIds as $receiveId)
                {
                    if($user->id==$receiveId) // 1 3 5 7
                    {
                        $user['check']='sended';
                    }
                }
                foreach ($senderIds as $senderId)
                {
                    if($user->id==$senderId)
                    {
                        $user['check']='request';
                    }
                }
            }

           return $users;
            
            //return $users;
        }
        public function getInfoUser($id)
        {
            $info = User::where('id','=',$id)->with()->get();
            return $info;
        }
    }
