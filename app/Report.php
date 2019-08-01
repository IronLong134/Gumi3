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

	public function getReasonReports() {
		$data = Masterdata::Where('kind', '=', 1)
											->orderBy('order')
											->get();

		return $data;
	}

	public function getReport_Nodelete() {
		$datas = Report::where('status', '=', 0)
									 ->with(['sender_report', 'receiver_report'])
									 ->orderBy('created_at', 'DESC')
									 ->get();
		foreach ($datas as $data) {
			$reason_report = Masterdata::where('kind', '=', 1)
																 ->where('value', '=', $data->reason)
																 ->pluck('name');
			$data['reason_report'] = $reason_report[0];
		}

		return $datas;
	}

	public function getReport_delete() {
		$datas = Report::where('status', '=', 1)
									 ->with(['sender_report', 'receiver_report'])
									 ->orderBy('created_at', 'DESC')
									 ->get();
		foreach ($datas as $data) {
			$reason_report = Masterdata::where('kind', '=', 1)
																 ->where('value', '=', $data->reason)
																 ->pluck('name');
			$data['reason_report'] = $reason_report[0];
		}

		return $datas;
	}

	public function addReport($sender_id, $receiver_id, $reason, $content) {
		$new = new Report();
		$new->sender_id = $sender_id;
		$new->receiver_id = $receiver_id;
		$new->reason = $reason;
		$new->content = $content;
		$new->save();
	}

	public function update_report($id) {
		Report::where('id','=',$id)->update(['status'=>1]);
	}
	public function getReport($report_id){
		$data = Report::where('id','=',$report_id)->with(['sender_report','receiver_report'])->first();
		$reason_report = Masterdata::where('kind', '=', 1)
															 ->where('value', '=', $data->reason)
															 ->pluck('name');
		$data['reason_report']=$reason_report;
		return $data;
	}
}
