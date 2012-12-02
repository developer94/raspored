$(document).ready(function ()
{
									//fill values of choices div under the timetable
	$("#selSmena").val(smena);		//----
	$("#selGrupa").val(grupa);		//----
	
											//make change of these trigger the update
	$("#selSmena").change(update);			//----
	$("#selGrupa").change(update);			//----
	
	$("#rasporedLink").attr("href", edit_path + '/index/' + grupa + '/' + odeljenje);

	function update()
	{
		var smena = $("#selSmena").val();
		var grupa = $("#selGrupa").val();
		window.location.href = edit_path + '/overview/' + grupa + '/' + odeljenje + '/' + smena;
	}
});