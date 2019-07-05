$(document).ready(function () {
	$("div.row").on('click', '.like_btn', function (e) {
		e.preventDefault();
		var this_a=$(this);
		var user_id=$(this).attr('user_id');
		var post_id=$(this).attr('post_id');
		var url = '/' + post_id + '/addLike';
		
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
				id: post_id
			},
			success: function (res) {
				var likeclass = res.data.success ? 'text-primary' : 'text-muted';
				this_a.removeClass('text-primary');
				this_a.removeClass('text-muted');
				this_a.addClass(likeclass);
				this_a.find('like').html(res.data.likes);
			}
		});
		return false;
	})
});