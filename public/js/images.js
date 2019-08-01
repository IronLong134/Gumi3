
$(document).ready(function () {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
		}
	});
	$('div .row').on('click', '.btn-primary', function (e) {
		e.preventDefault();
		$(this).parent().parent().remove();
		
		var listImg = $('.list-img');
		var newListImg = '';
		
		listImg.each(function (idx, val) {
			newListImg += $(val).attr('data') + ' ';
		});
		
		newListImg.substr(newListImg.length - 1, newListImg.length);
		
		var url = '/deleteImage';
		$.ajax
		({
			url: url,
			method: "POST",
			dataType: "json",
			data: {
				images: newListImg
			},
			success: function (res) {
				console.log(res);
			}
		});
		return false;
		
	})
	$('div .row').on('click', '.btn-avatar', function (e) {
		e.preventDefault();
		// $(this).parent().parent().remove();
		
		var listImg = $(this).parent().parent().find('img');
		var image = listImg.attr('data');
		$('#avatar').attr('src', "http://localhost:8000/imgs/" + image);
		// var newListImg = '';
		//
		// listImg.each(function (idx, val) {
		//     newListImg += $(val).attr('data') + ' ';
		// });
		
		//newListImg.substr(newListImg.length - 1, newListImg.length);
		
		var url = '/updateAvatar';
		$.ajax
		({
			url: url,
			method: "POST",
			dataType: "json",
			data: {
				image: image
			},
			success: function () {
			
			}
		});
		return false;
	})
});
