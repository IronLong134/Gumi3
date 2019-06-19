$(document).ready(function () {
	'use strict';
	// / Define variable /
	// / Event /
	var $btnOpenModalEvent = $('#report');
	var $modalEvent = $('#modal-report');
	var eventName = $('#event_name');
	var pager = $('div#event_modal_pager');
	
	$btnOpenModalEvent.on('click', function () {
		$modalEvent
				.modal({
					closeExisting: false,
					escapeClose: false,
					clickClose: false
				})
				.css({
					'overflow': 'visible',
					'max-width': 'none',
					'min-width': 'none'
				});
		//callAjaxToGetEventList('', '');
		return false;
	});
	$('#submit-report').click(function (e) {
		e.preventDefault();
		var reason= $('select[id="reason"]').val();
		var content=$('textarea[id="content"]').val();
		var user_id=$(this).attr('user_id');
		var friend_id=$(this).attr('friend_id');
		var url="/addreport";
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url :url,
			method: "POST",
			dataType: "json",
			data:{
				friend_id:friend_id,
				user_id:user_id,
				reason: reason,
				content:content
			},
			success: function (res) {
				
				console.log(res);
				$('#modal-report').modal('toggle');
			}
		});
	})
});