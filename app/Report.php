<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model {
	//
	protected $table = 'reports';

	public function sender_report() {
		return $this->belongsTo('App\User', 'sender_id');
	}

	public function receiver_report() {
		return $this->belongsTo('App\User', 'receiver_id');
	}

	public function getReports() {
		$data = Masterdata::Where('kind', '=', 1)->where('status','=',0)
				
											->orderBy('order')
											->get();

		return $data;
	}

	public function addReport($sender_id, $receiver_id, $reason, $content) {
		$new = new Report();
		$new->sender_id=$sender_id;
		$new->receiver_id=$receiver_id;
		$new->reason=$reason;
		$new->content=$content;
		$new->save();
	}
}
