$(document).ready(function () {
	
	$('div .table_report').on('click', '.btn-report', function (e) {
		e.preventDefault();
		var sender_id = $(this).attr('sender_id');
		var receiver_id=$(this).attr('receiver_id');
		var sender_name = $(this).attr('sender_name');
		var receiver_name=$(this).attr('receiver_name');
		var report_id=$(this).attr('report_id');
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
				"                      <button report_id='"+report_id+"' sender_id='"+sender_id+"' receiver_id='"+receiver_id+"' sender_name='"+sender_name+"' receiver_name='"+receiver_name+"' id=\"to_handle\" class=\"btn btn-primary handle\">Đánh dấu là đã giải quyết</button>\n" +
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
					clickClose: true
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
	$('div .table-wrapper').on('hidden.bs.modal', '#modal-edit-report', function (e){
		e.preventDefault();
		$('#form-modal').empty();
	});
	
  var crfs_token=$('input[name="csrf-token"]').attr('content');
	$('body').on('click','.handle',function (e) { // SĐÁNH DẤU ĐÃ GIẢI QUYẾT REPORT
		e.preventDefault();
		var report_id=$(this).attr('report_id');
		var sender_id = $(this).attr('sender_id');
		var receiver_id=$(this).attr('receiver_id');
		var sender_name = $(this).attr('sender_name');
		var receiver_name=$(this).attr('receiver_name');
		var url="/admin2/update_report";
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': crfs_token
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
        window.location.href= "/admin2/report";
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