$(document).ready(function ()
{
	$("#login").click(function ()
	{
		var _data = {};
		
		_data['user'] = $("#user").val();
		_data['pass'] = $("#pass").val();
		
		$.post('/index.php/login/check_user', _data, function(data, textStatus, jqXHR)
		{
			$("#message").show();
			$("#message").html(data);
			setTimeout(function(){$("#message").fadeOut('slow');}, 3000);
		});
	});
});