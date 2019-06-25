$(document).ready(function () {
	$('.form-cmt').toggle();
	$(".row").on('click', '#like_btn', function () {
		var this_a = $(this);
		var id = this_a.attr("post_id"); //lay id video\
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
				var likeclass = res.data.success ? 'btn-danger' : 'btn-primary';
				this_a.removeClass('btn-danger');
				this_a.removeClass('btn-primary');
				this_a.addClass(likeclass);
				this_a.find('b').html(res.data.likes);
			}
		});
		return false;
	});
	$("button[type='submit']").click(function (e) {
		e.preventDefault();
		var this_a = $(this);
		var content = this_a.parent().parent().find('input[name=\'content\']').val();
		var post_id = this_a.attr("post_id");
		var user_id = this_a.attr("user_id");
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
				//console.log(res);
				this_a.parent().parent().find('input').val("");
				this_a.parent().parent().parent().parent().toggle('slow');
			
				$('c').html(res.count);
			}
		});
		return false;
		
	});
	//tìm kiếm
	$('.comment-btn').click(function (e) {
		e.preventDefault();
		$(this).parent().parent().parent().find('.form-cmt').toggle('slow');
	});
	$('#myInput').on('keyup', function (event) {
		event.preventDefault();
		/* Act on the event */
		var tukhoa = $(this).val().toLowerCase();
		$('#myTable > div').filter(function () {
			$(this).toggle($(this).text().toLowerCase().indexOf(tukhoa) > -1);
		});
	});
});

