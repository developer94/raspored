<html>
<head>
	<title>
	Raspored
	</title>
	<link rel="icon" type="image/png" href="<?= $this->config->item('img_path'); ?>/cal.png" />
	<script type="text/javascript" src="<?= $this->config->item('js_path'); ?>/lib/jquery-1.8.2.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function ()
		{
			$(".num").keydown(function(e) {
				if((e.which > 57 || e.which < 48) && e.which != 13 && e.which != 9 && e.which != 8)
					return false;
			});
			
			$("#add").click(function ()
			{
				_data = {};
				
				_data['dan']		= $("#selDan").val();
				_data['odeljenje'] 	= $("#txtOdeljenje").val();
				_data['grupa'] 		= $("#selGrupa").val();
				_data['cas'] 		= $("#txtCas").val();
				_data['mix']		= $("#selMix").val();
				_data['predmet'] 	= $("#txtPredmet").val();
				_data['smena'] 		= $("#selSmena").val();
				
				$("#message").html("Predmet se dodaje...").css("color", "red");
				
				console.log(_data);
				
				function success(data, status, jqXHR) 
				{
					$("#message").html(status).css("color", "lime");
					if(status != "error")
						$("#message").html(data).css("color", "lime");
					else if(status == "error")
						$("#message").html("Error! 500").css("color", "red");
				}
				
				$.post('/raspored/add', _data, success);
			});
		});
	</script>
	<style type="text/css">
		body 
		{
			background: cornflowerblue;
			font-family: 'Segoe UI', sans-serif;
			color: #fff;
			background-image: url('/assets/images/ios-linen.jpg');
		}
		
		#content
		{
			background: rgba(65, 105, 225, 0.4);
			border-radius: 5px 5px 5px 5px;
			width: 380px;
		}
		
		.orange-highlight
		{
			background: orange;
			color: black;
			width: 20px;
		}
		
		.cfblue-highlight
		{
			background: cornflowerblue;
			min-width: 20em;
		}
		
		input
		{
			border: 1px solid gray;
			width: 100%;
		}
		
		button
		{
			width: 100%;
			height: 100%;
		}
		
		#addWrapper
		{
			height: 35px;
		}
		
		form
		{
			margin-bottom: 0em;
			padding: 10px;
		}
	</style>
</head>
<body>
	<center>
	<div id="content">
	<form action="javascript:void(0)";>
		<table border="0px">
			<tr>
				<td>Dan:</td>
				<td>
					<select id="selDan">
						<option value="Ponedeljak">Ponedeljak</option>
						<option value="Utorak">Utorak</option>
						<option value="Sreda">Sreda</option>
						<option value="Cetvrtak">Cetvrtak</option>
						<option value="Petak">Petak</option>
					</select>
				</td>
			<tr>
				<td>Odeljenje:</td>
				<td colspan="2"><input id="txtOdeljenje" class="num" placeholder="Format: 409 je IV-9"></input></td>
			</tr>
			<tr>
				<td>Grupa:</td>
				<td colspan="2">
					<select id="selGrupa">
						<option value="0">Obe</option>
						<option value="1">Prva</option>
						<option value="2">Druga</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Cas:</td>
				<td><input id="txtCas" class="num" type="text"></input></td>
				<td>
					<select id="selMix">
						<option value="pre">Prepodne</option>
						<option value="posle">Poslepodne</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Predmet:</td>
				<td colspan="2"><input type="text" id="txtPredmet"></input></td>
			</tr>
			<tr>
				<td>Smena:</td>
				<td colspan="2">
					<select id="selSmena">
						<option value="Prepodne">Prepodne</option>
						<option value="Poslepodne">Poslepodne</option>
					</select>
				</td>
			<tr>
				<td colspan="3" id="addWrapper"><button id="add">Dodaj</button></td>
			</tr>
			<tr>
				<td colspan="3"><span id="message"></span></td>
			</tr>
		</table>
	</form>
	</div>
	</center>
</body>
</html>