$(document).ready(function ()
{
	$("#selDan").val(dan);			//fill values of choices div under the timetable
	$("#selSmena").val(smena);		//----
	$("#selGrupa").val(grupa);		//----
	$("#skraceni").attr('checked', skraceni=="_skraceno");

	
	$("#selDan").change(update);			//make change of these trigger the update
	$("#selSmena").change(update);			//----
	$("#selGrupa").change(update);			//----
	$("#skraceni").change(update);
	
	$("#izmeniLink").attr("href", edit_path + '/izmeni/' + grupa + '/' + odeljenje + '/' + dan + '/' + smena);
	$("#overview").attr("href", edit_path + '/overview/' + grupa + '/' + odeljenje + '/' + smena);

	function update()
	{
		var dan = $("#selDan").val();
		var smena = $("#selSmena").val();
		var grupa = $("#selGrupa").val();
		var skraceni = $("#skraceni").attr('checked')?"Skraceno":"";
		window.location.href = edit_path + '/index/' + grupa + '/'+ odeljenje + '/' + dan + '/' + smena + '/' + skraceni;
	}
});