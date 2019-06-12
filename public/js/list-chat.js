setInterval(function () {
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
		}
	});
	var user_id = $('input[name="user_id"]').attr('content');
	var url = "/realtime2";
	$.ajax({
		url: "/update_listChat",
		method: "GET",
		dataType: "json",
		data: {},
		success: function (res) {
			// update div
			$('#myTable').empty();
			var messengers = "";
			$.each(res, function (key, messenger) {
				var avatar = messenger.avatar;
				if (!messenger.avatar) {
					if (messenger.gender == 0) {
						avatar = "avatar_male.jpg";
					} else if (messenger.gender == 1) {
						avatar = "avatar_female.jpg";
					}
				}
				if (messenger.seen == 'no') {
					messengers += "<div class=\"container text-center card messenger\">\n" +
							"                <div class=\"padding-2\">\n" +
							"                  <div class=\"inline\">\n" +
							"                    <div class=\"dropdown profileWrapper\">\n" +
							"                      <img class=\"avatar1\" src=\"http://localhost:8000/imgs/" + avatar + "\">\n" +
							"                      <span class=\"profileName text-left\"><a class=\"name inline\" href=\"\\chat_friend\\" + messenger.id + "\" style=\"font-size:x-large;\">" + messenger.name + "</a></span>\n" +
							"                      <button class=\"btn btn-success dropdown-toggle right\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\n" +
							"                        Tuỳ chọn\n" +
							"                      </button><div class=\"notification text-center badge badge-danger\">" + messenger.count_no_seen + "</div>\n" +
							"                      <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">\n" +
							"                        <a class=\"dropdown-item\" href=\"\\profile_friend\\" + messenger.id + "\">Xem trang cá nhân</a>\n" +
							"                        <a class=\"dropdown-item\" href=\"\\chat_friend\\" + messenger.id + "\">Trò chuyện</a>\n" +
							"                      </div>\n" +
							"                    </div>\n" +
							"                  </div>\n" +
							"                  <div class=\"description text-left margin-top-15\">" + messenger.name + ": " + messenger.last_msg[0].content + " </div>\n" +
							"                </div>\n" +
							"              </div>"
				} else {
					var name = "";
					messenger.last_msg['from'] == 'me' ? name = "Tôi" : name = messenger.name;
					
					messengers += "<div class=\"container text-center card messenger\">\n" +
							"                <div class=\"padding-2\">\n" +
							"                  <div class=\"inline\">\n" +
							"                    <div class=\"dropdown profileWrapper\">\n" +
							"                      <img class=\"avatar1\" src=\"http://localhost:8000/imgs/" + avatar + "\">\n" +
							"                      <span class=\"profileName text-left\"><a class=\"name inline\" href=\"\\chat_friend\\" + messenger.id + "\" style=\"font-size:x-large;\">" + messenger.name + "<msg class=\"abc\"></msg></a></span>\n" +
							"                      <button class=\"btn btn-success dropdown-toggle right\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\n" +
							"                        Tuỳ chọn\n" +
							"                      </button>\n" +
							"                      <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">\n" +
							"                        <a class=\"dropdown-item\" href=\"\\profile_friend\\" + messenger.id + "\">Xem trang cá nhân</a>\n" +
							"                        <a class=\"dropdown-item\" href=\"\\chat_friend\\" + messenger.id + "\">Trò chuyện</a>\n" +
							"                      </div>\n" +
							"                    </div>\n" +
							"                  </div>\n" +
							"                  <div class=\"description text-left margin-top-15\">" + name + ":\n" +
							"                      " + messenger.last_msg[0].content + " \n" +
							"                  </div>\n" +
							"                </div>\n" +
							"              </div>";
				}
			});
			$('#myTable').append(messengers);
		}
	});
	
}, 4000);