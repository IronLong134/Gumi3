$(document).ready(function () {
	$('.block-dropdown').on('click','#block_user',function (e) {
			e.preventDefault();
			var user_id= $(this).attr('user_id');
			var url="/admin/block_acount";
			$('#wraper_block1').empty();
			var msg="<div id=\"block-msg-wrapper\"> \n" +
					"\t<div class=\"bg-danger text-center text-white block-msg\">Tài khoản này đã bị khoá</div>\n" +
					"\t</div>";
			var dropdown="\t<div class=\"dropdown profilePeople\">\n" +
					"\t\t\t\t<button class=\"btn btn-danger\n" +
					"\t\t\n" +
					"\t\tdropdown-toggle profilePeople\" type=\"button\"\n" +
					"\t\tid=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\"\n" +
					"\t\taria-expanded=\"false\">\n" +
					"\t\tTuỳ chọn\n" +
					"\t</button>\n" +
					"\t\t\n" +
					"\t\t<div class=\"dropdown-menu block-dropdown\" aria-labelledby=\"dropdownMenuButton\">\n" +
					"\t<a id=\"unblock_user\" class=\"dropdown-item\" href=\"#\">Mở khoá tài khoản\n" +
					"\t\tnày </a>\n" +
					"\t</div>\n" +
					"\t\t</div>";
			$('#wraper_block1').append(msg);
			$('#wraper_block1').append(dropdown);
			$('#wraper_block1').toggle();
			$('#wraper_block1').toggle('slow');
			// var url="/block_acount";
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
			}
		});
		$.ajax
		({
			url: url,
			method: "POST",
			dataType: "json",
			data: {
				user_id: user_id,
			},
			success: function (res) {
				console.log(res);
				
			}
		});
		return false;
	});
	$('.block-dropdown').on('click','#unblock_user',function (e) {
		e.preventDefault();
		var user_id= $('input[id="data"]').attr('user_id');
		var url="/admin/block_acount";
		$('#wraper_block1').empty();
		var dropdown="\t<div class=\"dropdown profilePeople\">\n" +
				"\t\t\t\t<button class=\"btn btn-danger\n" +
				"\t\t\n" +
				"\t\tdropdown-toggle profilePeople\" type=\"button\"\n" +
				"\t\tid=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\"\n" +
				"\t\taria-expanded=\"false\">\n" +
				"\t\tTuỳ chọn\n" +
				"\t</button>\n" +
				"\t\t\n" +
				"\t\t<div class=\"dropdown-menu block-dropdown\" aria-labelledby=\"dropdownMenuButton\">\n" +
				"\t<a id=\"block_user\" class=\"dropdown-item\" href=\"#\">Khoá tài khoản\n" +
				"\t\tnày </a>\n" +
				"\t</div>\n" +
				"\t\t</div>";
		$('#wraper_block1').append(dropdown);
		$('#wraper_block1').toggle();
		$('#wraper_block1').toggle('slow');
		// var url="/block_acount";
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
			}
		});
		$.ajax
		({
			url: url,
			method: "POST",
			dataType: "json",
			data: {
				user_id: user_id,
			},
			success: function (res) {
				console.log(res);
				
			}
		});
		return false;
	})
});