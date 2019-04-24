<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messenger extends Model
{
    /**
     * @var string
     */
    protected $table = 'messengers';
    /**
     * @param $sender_id
     * @param $content
     */
    public function addMsg($sender_id, $content)
    {
        $msg = new Messenger();
        $msg->sender_id = $sender_id;
        $msg->content = $content;
        $msg->save();

    }
    public function getMsg()
    {
        $data = Messenger::OderBy('id','ASC');
        return $data;
    }
    //
}