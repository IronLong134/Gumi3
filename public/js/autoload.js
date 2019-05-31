$(document).ready(function(){
	setInterval(function(){
		$.ajax({
			url: "/realtime",
			success: function( res ) {
				// update div
				$('#countfri').html(res.countfri);
				$('#countrq').html(res.countrq);
			}
		});
	},1000);
});