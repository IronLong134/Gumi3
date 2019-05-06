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
    }
