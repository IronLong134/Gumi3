<?php

namespace App\Http\Controllers;

use App\Messenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * @param Request $rq
     */
    public function sendmsg(Request $rq)
    {
        $user = Auth::user();
        $body_msg = $rq->body_msg;
        // Xử lý chuỗi $body_msg
        $body_msg = htmlentities($body_msg);
        $body_msg = trim($body_msg);
        $sender_id = $user->id;
        $msg = new Messenger();
        $msg->addMsg($sender_id, $body_msg);
    }
    public function loadmsg()
    {
        $msg = new Messenger();
        $data = $msg->getMsg();
        return view('chat')->with('data', $data);
    }
    //
}