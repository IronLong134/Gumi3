$(document).ready(function () {
	$('#admin-login').on('submit', function (e) {
		e.preventDefault();
		var email = $('input[name="email"]').val();
		var password = $('input[name="password"]').val();
		var url = "/admin/postLogin";
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
				email: email,
				password: password
			},
			success: function (res) {
				
				console.log(res);
				
				if (res == 1) {
					var url = "/admin2/report";
					window.location.href = url;
				} else {
					var messege_error = "<div class=\"alert alert-danger\">\n" +
							"          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>\n" +
							"          " + res + "\n" +
							"        </div>";
					$('#error_wrapper').empty();
					$('#error_wrapper').append(messege_error);
					$('#error_wrapper').hide();
					$('#error_wrapper').show('slow');
				}
			}
		});
	})
});