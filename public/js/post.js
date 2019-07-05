$(document).ready(function () {
	$("#like_btn").click(function (e) {
		e.preventDefault();
		var id = $(this).attr("post_id"); //lay id video\
		var url = '/' + id + '/addLike';
		
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
				id: id
			},
			success: function (res) {
				var this_a = $("#like_btn");
				var likeclass = res.data.success ? 'btn-danger' : 'btn-primary';
				this_a.removeClass('btn-danger');
				this_a.removeClass('btn-primary');
				this_a.addClass(likeclass);
				$('b').html(res.data.likes);
			}
		});
		return false;
	});
	$("button[type='submit']").click(function (e) {
		e.preventDefault();
		var content = $("input[name='content']").val();
		var post_id = $("input[name='post_id']").val();
		var user_id = $("input[name='user_id_cmt']").val();
		var name = $("input[name='name']").val();
		var avatar = $("input[name='avatar']").val();
		
		var data = $('form#form_input').serialize();
		var url = '/post/add_comment/' + post_id + '/' + user_id;
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
				content: content,
				post_id: post_id,
				user_id: user_id
			},
			success: function (res) {
				console.log(res);
				$('c').html(res.count);
				var comment = "<div class=\"form-inline post\">\n" +
						"                <div class=\"inline\"><img class=\" avatar1\" src=\"http://localhost:8000/imgs/" + avatar + "\" alt=\"\"><a href=\"/profile_post/1\">" + name + "</a>\n" +
						"                  <span style=\"margin-left:11px;\">" + content + "</span>\n" +
						"\n" +
						"                </div>\n" +
						"                                  <div class=\"text-primary delete\">\n" +
						"                    <i class=\"fas fa-trash-alt\"></i><span><a class=\"delete_cmt\" cmt_id=\"" + res.cmt_id + "\" href=\"javascript:void(0)\">xóa</a></span>\n" +
						"                  </div>\n" +
						"                              </div>";
				
				$('.div-wraper').append(comment);
				
			}
		});
		return false;
		
	});
	$("div.row").on('click', '.delete_cmt', function (e) {
		e.preventDefault();
		$(this).parent().parent().parent().remove();
		var cmt_id = $(this).attr("cmt_id");
		var post_id = $("input[name='post_id']").val();
		var url = '/delete_cmt';
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
				post_id: post_id,
				cmt_id: cmt_id
			},
			success: function (res) {
				console.log(res);
				$('c').html(res);
			}
		});
		return false;
	});
	
});

