setInterval(function(){
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
		}
	});
  var user_id=$('input[name="user_id"]').attr('content');
  var url ="/realtime2";
	$.ajax({
		url: "/realtime",
		method: "GET",
		dataType: "json",
		data: {
		},
		success: function( res ) {
			// update div
			$('.fri').html(res.countfri);
			$('.rq').html(res.countrq);
		}
	});
	$.ajax({
		url: url,
		method: "GET",
		dataType: "json",
		data: {
		},
		success: function( response ) {
			// update div
			$('#request_wrapper').empty();
			var request="";
			$.each(response,function (key,value) {
				var avatar=value.sender.avatar;
				if(!value.sender.avatar)
				{
					if(value.sender.gender==0)
					{
						avatar="avatar_male.jpg";
					}
					else if(value.sender.gender==1)
					{
						avatar="avatar_female.jpg";
					}
				}
				request +="<div class=\"card request\">\n" +
						"                        <div class=\"row user-block\">\n" +
						"                            <div class=\"col-md-3\" style=\"text-align:right; \">\n" +
						"                                <img class=\" avatar1\" src=\"http://localhost:8000/imgs/"+avatar+"\" alt=\"\">\n" +
						"                            </div>\n" +
						"                            <div class=\"col-md-5\">\n" +
						"                                <div class=\"row\">\n" +
						"                                    <a class=\"name1 text-primary\" href=\"\\profile_friend\\"+value.sender.id+"\">"+value.sender.name+"</a>\n" +
						"                                    <div style=\"margin-left:10px\">đã gửi lời mởi kết bạn</div>\n" +
						"                                </div>\n" +
						"                            </div>\n" +
						"                            <div class=\"col-md-2\">\n" +
						"                                <a class=\"btn btn-primary\" href=\"\\accept\\"+value.sender.id+"\\"+user_id+"\">Chấp\n" +
						"                                    nhận</a>\n" +
						"                            </div>\n" +
						"                            <div class=\"col-md-1\">\n" +
						"                                <a href=\"\\refuse\\"+value.sender.id+"\\"+user_id+"\" class=\"btn btn-primary\">Xóa</a>\n" +
						"                            </div>\n" +
						"                        </div>\n" +
						"                    </div>";
			});
			$('#request_wrapper').append(request);
		
		}
	});

},3000);

