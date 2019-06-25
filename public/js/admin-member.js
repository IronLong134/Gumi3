$(document).ready(function () {

	$('#admin-members').click(function (e) {
		e.preventDefault();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
			}
		});
		$('#admin_content').empty();
		var url = "admin/members";
		var table = "<div class=\"container\">\n" +
				"              <div class=\"row text-center member\">\n" +
				"              </div>\n" +
				"            </div>";
		$('#admin_content').append(table);
		$.ajax({
			url: url,
			method: "GET",
			dataType: "json",
			data: {
			
			},
			success: function (res) {
				
				console.log(res);
				var members="";
				$.each(res,function (key,member) {
					var avatar=member.avatar;
					if(!avatar)
					{
						if(member.gender==1)
						{
							avatar="avatar_male.jpg";
						}
						else if(member.gender==0)
						{
							avatar="avatar_female.jpg";
						}
					}
					members+="<div class=\"bg-light col-md-4 tag-profile \">\n" +
							"                  <div class=\"bg-info text-white tag-profile \">\n" +
							"                    <div class=\"text-center\"><img class=\"avatar\" src=\"http://localhost:8000/imgs/"+avatar+"\"></div>\n" +
							"                    <div> <a class=\"text-white name1\" href=\"admin/profile_friend/2\">"+member.name+"</a> </div>\n" +
							"                    <div><small>"+member.email+"</small></div>\n" +
							"                    <small>tham gia từ "+member.created_at+"</small>\n" +
							"                  </div>\n" +
							"                </div>";
				});
				$('.member').append(members);
				$('.member').toggle();
				$('.member').toggle('slow');
			}
		});
	});
	$('#myInput').on('keyup', function (event) {
		event.preventDefault();
		/* Act on the event */
		var tukhoa = $(this).val().toLowerCase();
		$('.member > div').filter(function () {
			$(this).toggle($(this).text().toLowerCase().indexOf(tukhoa) > -1);
		});
	});
});

