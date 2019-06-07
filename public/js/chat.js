$(document).ready(function (e) {
	$('#input-chat').click(function (e) {
		e.preventDefault();
		//$('#list-msg').get(0).scrollHeight;
		$('#list-msg').scrollTop($('#list-msg').get(0).scrollHeight);
	});
	$('.sticker').click(function (e) {
		e.preventDefault();
		//var icon="<i class=\"far fa-sad-tear\"></i>";
		var icon="<i class=\""+$(this).attr('icon')+"\"></i>";
		var old =$('#input-chat').val();
		var newinput = old+icon;
		$('#input-chat').val(newinput);
		
	});
	$('.form-chat').submit(function(e){
		e.preventDefault();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
			}
		});
		var avatar=$('#data').attr('avatar');
		if(!avatar)
		{
			if($('#data').attr('gender')==0)
			{
				avatar="avatar_male.jpg";
			}
			else if($('#data').attr('gender')==1)
			{
				avatar="avatar_female.jpg";
			}
		}
		var user_id=$('#data').attr('user_id');
		var friend_id=$('#data').attr('friend_id');
		var content=$('#input-chat').val();
		var url="/add_msg_ajax";
		var new_msg="<div class=\"chat-wrapper\">\n" +
				"                    <div class=\"img-chat2\"><img class=\" avatar1\" src=\"http://localhost:8000/imgs/"+avatar+"\" alt=\"\"></div>\n" +
				"                    <div class=\"bg-primary text-white card friend-chat\">"+content+"</div>\n" +
				"\n" +
				"                  </div>";
		$.ajax({
			url :url,
			method: "POST",
			dataType: "json",
			data:{
				friend_id:friend_id,
				user_id:user_id,
				content:content
			},
			success: function (res) {
		
				$('#list-msg').append(new_msg);
				$('#input-chat').val("");
				$('#list-msg').scrollTop($('#list-msg').get(0).scrollHeight);
				//console.log(res);
				

			}
		});
	});
});


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
			var div_messeger="";
			$.each(res,function (key,messenger) {
				var avatar=messenger.sender_info.avatar;
				if(!avatar)
				{
					if(messenger.sender_info.gender==0)
					{
						avatar="avatar_male.jpg";
					}
					else if(messenger.sender_info.gender==1)
					{
						avatar="avatar_female.jpg";
					}
				}
				var from=messenger.from;
				
				if(from=='me')
				{
					div_messeger+="<div class=\"chat-wrapper\">\n" +
							"                    <div class=\"img-chat2\"><img class=\" avatar1\" src=\"http://localhost:8000/imgs/"+avatar+"\" alt=\"\"></div>\n" +
							"                    <div class=\"bg-primary text-white card friend-chat\">"+messenger.content+"</div>\n" +
							"\n" +
							"                  </div>";
				}
				else{
					div_messeger+="<div class=\"chat-wrapper\">\n" +
							"                    <div class=\"img-chat\"><img class=\" avatar1\" src=\"http://localhost:8000/imgs/"+avatar+"\" alt=\"\"></div><div class=\"card border-primary me-chat\">"+messenger.content+"</div>\n" +
							"                  </div>";
				}
				$('#list-msg').empty();
				$('#list-msg').append(div_messeger);
				$('#list-msg').scrollTop($('#list-msg').get(0).scrollHeight);
			});
			// update div
			//console.log(res);
		}
	});

},4000);


