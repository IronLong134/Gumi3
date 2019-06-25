$(document).ready(function () {
	$('div .row').on('click', '.no_friend', function (e) {
		e.preventDefault();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
			}
		});
		var this_a = $(this);
		var friend_id = this_a.attr('friend_id');
		var user_id = this_a.attr('user_id');
		var this_a_wrapper = this_a.parent();
		var url = '/send_rq_test/' + friend_id;
		this_a.remove();
		var change = "<div class=\"dropdown profilePeople\">\n" +
				"                      <button class=\"\n" +
				"                                                                          btn btn btn-danger\n" +
				"                          dropdown-toggle profilePeople\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\n" +
				"                                                  <i class=\"fas fa-arrow-left\"></i>Bạn đã gửi lời mời kết bạn\n" +
				"                                              </button>\n" +
				"                      <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">\n" +
				"                                                  <a class=\"dropdown-item refuse\" user_id=\"" + user_id + "\" friend_id=\"" + friend_id + "\" href=\"javascript:void(0)\">Xóa</a>\n" +
				"\t\t\t\t\t\t\t\t\t\t\t\t\t\n" +
				"                        \n" +
				"                      </div>\n" +
				"\t\t\t\t\t\t\t\t\t\t</div>";
		$.ajax
		({
			url: url,
			method: "POST",
			dataType: "json",
			data: {
				user_id: user_id,
				friend_id: friend_id
			},
			success: function (res) {
				console.log(res);
				this_a_wrapper.append(change);
				
				this_a_wrapper.toggle();
				this_a_wrapper.toggle('slow');
			}
		});
		return false;
	});
	$('div .row').on('click', '.refuse', function (e) {
		e.preventDefault();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
			}
		});
		var this_a = $(this);
		var friend_id = this_a.attr('friend_id');
		var user_id = this_a.attr('user_id');
		var this_a_wrapper = this_a.parent().parent();
		var url = '/refuse_test/';
		var this_a_wrapper2 = this_a_wrapper.parent();
		var change = "<button user_id=\"" + user_id + "\" friend_id=\"" + friend_id + "\" class=\"btn btn-primary btn-block no_friend\">Gửi\n" +
				"                        lời\n" +
				"                        mời\n" +
				"                        kết bạn</button>";
		this_a_wrapper.remove();
		$.ajax
		({
			url: url,
			method: "POST",
			dataType: "json",
			data: {
				user_id: user_id,
				friend_id: friend_id
			},
			success: function (res) {
				console.log(res);
				this_a_wrapper2.append(change);
				this_a_wrapper2.toggle();
				this_a_wrapper2.toggle('slow');
			}
		});
		return false;
	});
	$('div .row').on('click', '.accept', function (e) {
		e.preventDefault();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
			}
		});
		var this_a = $(this);
		var friend_id = this_a.attr('friend_id');
		var user_id = this_a.attr('user_id');
		var this_a_wrapper = this_a.parent().parent();
		var url = '/accept_ajax/';
		var this_a_wrapper2 = this_a_wrapper.parent();
		
		var change = "<div class=\"dropdown profilePeople\">\n" +
				"                      <button class=\"\n" +
				"                                                                          btn btn-success\n" +
				"                          dropdown-toggle profilePeople\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\n" +
				"                                                  <i class=\"fas fa-user-friends\"></i>Bạn bè\n" +
				"                                              </button>\n" +
				"                      <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">\n" +
				"                                                  <a class=\"dropdown-item\" href=\"\\profile_friend\\" + friend_id + "\">Xem trang cá nhân</a>\n" +
				"                          <a class=\"dropdown-item refuse\" user_id=\"" + user_id + "\" friend_id=\"" + friend_id + "\" href=\"javascript:void(0)\">Hủy kết bạn</a>\n" +
				"                        \n" +
				"                      </div>\n" +
				"\t\t\t\t\t\t\t\t\t\t</div>";
		this_a_wrapper.remove();
		$.ajax
		({
			url: url,
			method: "POST",
			dataType: "json",
			data: {
				user_id: user_id,
				friend_id: friend_id
			},
			success: function (res) {
				console.log(res);
				this_a_wrapper2.append(change);
				
				this_a_wrapper2.toggle();
				this_a_wrapper2.toggle('slow');
			}
		});
		return false;
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
