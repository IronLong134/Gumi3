setInterval(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
		}
	});
	var user_id = $('#data').attr('user_id');
	var friend_id=$('#data').attr('friend_id');
	var url = "/load_chat";
	$.ajax({
		url: url,
		method: "POST",
		dataType: "json",
		data:{
			friend_id:friend_id,
			user_id:user_id
		},
		success: function (res) {
			// update div
			console.log(res);
			
		}
	})
},3000);
$(document).ready(function () {
	$('#form-chat input[type="text"]').keypress(function () {
	});
});