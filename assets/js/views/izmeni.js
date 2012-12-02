var g_test;

$(document).ready(function ()
{
	var originalstate = [];
	originalstate["cas"] = [];
	originalstate["predmet"] = [];
	originalstate["smena"] = [];
	originalstate["mix"] = [];
	originalstate["ucionica"] = [];
	var toadd = [];
	var toremove = [];
	var toupdate = [];
	
	$("#selDan").val("<?= $dan?>");
	$("#selSmena").val("<?= $smena?>");
	$("#selGrupa").val("<?= $grupa?>");
	
	$("#selDan").change(update);
	$("#selSmena").change(update);
	$("#selGrupa").change(update);
	
	var dan = $("#selDan").val();
	var smena = $("#selSmena").val();
	var grupa = $("#selGrupa").val();

	var odeljenje = "<?= $odeljenje?>";
	
	$("#rasporedLink").attr("href", '/raspored/index/' + grupa + '/' + odeljenje + '/' + dan + '/' + smena);
	
	console.log(originalstate);
	
	function update()
	{
		var dan = $("#selDan").val();
		var smena = $("#selSmena").val();
		var grupa = $("#selGrupa").val();
		
		window.location.href = '/raspored/izmeni/'+ grupa + '/' + odeljenje + '/' + dan + '/' + smena;
	}
	
	g_test = function()						//global test unload func
	{
		var toSend = {};
		toSend["original_data"] = originalstate;
		toSend["data"] = [];
		toSend["data"]["cas"] = [];
		toSend["data"]["predmet"] = [];
		toSend["data"]["mix"] = [];
		toSend["data"]["ucionica"] = [];
		
		$("[id^=cas-]").each(function ()
		{
			toSend["data"]["cas"].push($(this).val());
		});
		
		$("[id^=predmet-]").each(function ()
		{
			toSend["data"]["predmet"].push($(this).val());
		});
		
		$("[id^=mix-]").each(function ()
		{
			toSend["data"]["mix"].push($(this).val());
		});
		
		$("[id^=ucionica-]").each(function ()
		{
			toSend["data"]["ucionica"].push($(this).val());
		});
		
		console.log(toSend["data"]);
	}
	
	/*g_test = function ()
	{
		var data = {};
		data['array'] = [];							//wrapper associative array
		data['array'].push( {"key1" : "value1", 	//enables us to call $_POST['array'] to retrieve an array of json data
					"key2" : "value2",
					"key3" : "value3"} );
		console.log("works!");
		$.ajax({type: "POST",
				url: '/tests/json', 
				data: data,
				success: function(data)
				{
					console.log(data);
				}
		});
	}*/
	
	//$(window).unload(test);
});