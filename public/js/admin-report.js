$(document).ready(function () {
	'use strict';
	// / Define variable /
	// / Event /
	// $('div .row').on('click', '.no_friend', function (e) {
	$('div #admin_content').on('click', '.btn-report', function (e) {
		e.preventDefault();
		var sender_id = $(this).attr('sender_id');
		var receiver_id=$(this).attr('receiver_id');
		var sender_name = $(this).attr('sender_name');
		var receiver_name=$(this).attr('receiver_name');
		var report_id=$(this).attr('report_id');
		//debugger;
		var form_modal = "<div id=\"modal-edit-report\" class=\"modal container text-center fix-modal1\">\n" +
				"                  <div class=\"modal-scrollable text-center bg-white form-report1\">\n" +
				"\n" +
				"                    Kiểm tra và khoá tài khoản\n" +
				"                    <div>Người gủi báo cáo : <a\n" +
				"                          href=\"admin/profile_friend/" + sender_id + "\">" + sender_name + "</a>\n" +
				"                    </div>\n" +
				"                    <div>Người bị báo cáo : <a\n" +
				"                          href=\"admin/profile_friend/" + receiver_id + "\">" + receiver_name + "</a>\n" +
				"                    </div>\n" +
				"                    <div>\n" +
				"                      <button report_id='"+report_id+"' id=\"to_handle\" class=\"btn btn-primary handle\">Đánh dấu là đã giải quyết</button>\n" +
				"                    </div>\n" +
				"                    <button id=\"exit\" class=\"btn btn-danger exit-btn\">Thoát</button>\n" +
				"                  </div>\n" +
				"                </div>";
	$('#form-modal').append(form_modal);
	var $modalEvent = $('#modal-edit-report');
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
	$('body').on('click', '#exit', function (e) {
		e.preventDefault();
		$('#modal-edit-report').modal('toggle');
		$('#form-modal').empty();
	});
	$('#to_handle').click(function (e) {
		e.preventDefault();
		var reason = $('select[id="reason"]').val();
		var content = $('textarea[id="content"]').val();
		var user_id = $(this).attr('user_id');
		var friend_id = $(this).attr('friend_id');
		var url = "/addreport";
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: url,
			method: "POST",
			dataType: "json",
			data: {
				friend_id: friend_id,
				user_id: user_id,
				reason: reason,
				content: content
			},
			success: function (res) {
				
				console.log(res);
				$('#modal-report').modal('toggle');
			}
		});
	});
	$('.tag-admin').click(function (e) {
		e.preventDefault();
		$('.tag-admin').parent().removeClass('text-white');
		$('.tag-admin').parent().removeClass('bg-primary');
		$('.tag-admin').parent().addClass('bg-white');
		$('.tag-admin').parent().addClass('text-primary');
		$('.tag-admin').removeClass('text-white');
		$('.tag-admin').addClass('text-primary');
		//thay đổi
		$(this).parent().removeClass('text-primary');
		$(this).parent().removeClass('bg-white');
		$(this).parent().addClass('bg-primary');
		$(this).parent().addClass('text-white');
		$(this).removeClass('text-primary');
		$(this).addClass('text-white');
	});
	
	function report_load(){
		$('#admin-reports').click();
		
	}
	
	$('#form-modal').on('click','.handle',function (e) { // SĐÁNH DẤU ĐÃ GIẢI QUYẾT REPORT
		e.preventDefault();
		var report_id=$(this).attr('report_id');
		var url="admin/update_report";
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: url,
			method: "POST",
			dataType: "json",
			data: {
				report_id:report_id
			},
			success: function (res) {
				console.log(res);
				$('#modal-edit-report').modal('toggle');
				report_load();
			}
		});
	});
	$('#admin-reports').click(function (e) {
		e.preventDefault();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
			}
		});
		$('#admin_content').empty();
		var url = "admin/report_nodelete";
		var url1 = "admin/report_delete";//là link report
		var table = "<table class=\"table table-hover table_report\">\n" +
				"            <thead>\n" +
				"            <tr>\n" +
				"              <th>Người báo cáo</th>\n" +
				"              <th>Người bị báo cáo</th>\n" +
				"              <th>Lí do chính</th>\n" +
				"              <th>Các lí do khác</th>\n" +
				"              <th>Thời gian </th>\n" +
				"              <th>Giải quyết</th>\n" +
				"            </tr>\n" +
				"            </thead>\n" +
				"            <tbody>\n" +
				"            </tbody>\n" +
				"          </table>";
		$('#admin_content').toggle();
		$('#admin_content').toggle('slow');
		$('#admin_content').append(table);
		$.ajax({
			url: url,
			method: "GET",
			dataType: "json",
			data: {},
			success: function (res) {
				
				console.log(res);
				var reports = "";
				$.each(res, function (key, report) {
					reports += "<tr>\n" +
							"                <td><a href=\"admin/profile_friend/" + report.sender_report.id + "\">" + report.sender_report.name + "</a></td>\n" +
							"                <td><a href=\"admin/profile_friend/" + report.receiver_report.id + "\">" + report.receiver_report.name + "</a></td>\n" +
							"                <td>" + report.reason_report + "</td>\n" +
							"                <td>" + report.content + "</td>\n" +
							"                <td>" + report.updated_at + "</td>\n" +
							"                <td><button report_id='"+report.id+"' sender_id='"+report.sender_report.id+"' sender_name='"+report.sender_report.name+"' receiver_name='"+report.receiver_report.name+"' receiver_id=\""+report.receiver_report.id+"\" id=\"\" class=\"btn btn-primary btn-report\">Chưa giải quyết</button></td>\n" +
							"              </tr>";
	
				});
				$('tbody').append(reports);
				$('tbody').toggle();
				$('tbody').toggle('slow');
			}
		});
		$.ajax({
			url: url1,
			method: "GET",
			dataType: "json",
			data: {},
			success: function (res) {
				
				console.log(res);
				var reports = "";
				$.each(res, function (key, report) {
					reports += "<tr>\n" +
							"                <td><a href=\"admin/profile_friend/" + report.sender_report.id + "\">" + report.sender_report.name + "</a></td>\n" +
							"                <td><a href=\"admin/profile_friend/" + report.receiver_report.id + "\">" + report.receiver_report.name + "</a></td>\n" +
							"                <td>" + report.reason_report + "</td>\n" +
							"                <td>" + report.content + "</td>\n" +
							"                <td>" + report.updated_at + "</td>\n" +
							"                <td><button report_id='"+report.id+"' sender_id='"+report.sender_report.id+"' sender_name='"+report.sender_report.name+"' receiver_name='"+report.receiver_report.name+"' receiver_id='"+report.receiver_report.id+"' id=\"\" class=\"btn btn-danger \">Đã giải quyết</button></td>\n" +
							"              </tr>";
				});
				var form_modal ="<div id=\"form-modal\">\n" +
						"\n" +
						"            </div>";
				$('#admin_content').append(form_modal);
				$('tbody').append(reports);
			}
		});
	});
	$('#myInput').on('keyup', function (event) {
		event.preventDefault();
		/* Act on the event */
		var tukhoa = $(this).val().toLowerCase();
		$('.table_report tr').filter(function () {
			$(this).toggle($(this).text().toLowerCase().indexOf(tukhoa) > -1); //toLowerCase: chyển chữ hoa thành chữ thường
		});
	});
});

