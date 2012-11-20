<html>
<head>
	<title>
	Raspored
	</title>
	<link rel="icon" type="image/png" href="<?= $this->config->item('img_path'); ?>/cal.png" />
	<link rel="stylesheet" type="text/css" href="<?= $this->config->item('css_path'); ?>/fonts.css" />
	<script type="text/javascript" src="<?= $this->config->item('js_path'); ?>/jquery-1.8.2.min.js"></script>
	<script type="text/javascript">
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
			
			$("#rasporedLink").attr("href", '/raspored/index/' + grupa + '/409/' + dan + '/' + smena);
			
			console.log(originalstate);
			
			function update()
			{
				var dan = $("#selDan").val();
				var smena = $("#selSmena").val();
				var grupa = $("#selGrupa").val();
				
				window.location.href = '/raspored/izmeni/'+ grupa + '/409/' + dan + '/' + smena;
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
	</script>
	<style type="text/css">
		body 
		{
			background: url(<?= $this->config->item('img_path') ?>/ios-linen.jpg);
			font: 13px/20px normal;
			font-family: 'Segoe UI', sans-serif;
			color: #fff;
		}
		
		#raspored
		{
			border: 1px none white;
			border-spacing: 0 0.2em;
		}
		
		#raspored tr
		{
			padding: 1px;
		}
		
		#raspored td
		{
			border: 1px none white;
			padding: 0;
			padding-left: 0.5em;
			padding-right: 0.5em;
			height: 2em;
		}
		
		#raspored td.mid
		{
			padding-left: 0;
		}
		
		#wrapper
		{
			display: inline-block;
			background: rgba(65, 105, 225, 0.3);
			padding: 10px 10px 10px 10px;
			border-radius: 5px;
		}
		
		#choices
		{
			margin: 10px 0px 0px 0px;
		}
		
		.orange-highlight
		{
			background: orange;
			color: black;
			padding: 0;
		}
		
		.cfblue-highlight
		{
			background: cornflowerblue;
		}
		
		.cas
		{
			width: 1.9em;
			margin: 0;
		}
		
		.predmet
		{
			width: 25em;
		}
		
		.ucionica
		{
			width: 2em;
		}
		
		.buttonlink
		{
			display:block;	
			height: 16px;
			width: 16px;
			text-indent: -9000px;
		}
		
		.add
		{
			background: url(<?= $this->config->item('img_path'); ?>/add.png);
			background-size: 16px 16px;
		}
		
		.add:hover
		{
			background: url(<?= $this->config->item('img_path'); ?>/addglow.png);
			background-size: 16px 16px;
		}
		
		.remove
		{
			background: url(<?= $this->config->item('img_path'); ?>/remove.png);
			background-size: 16px 16px;
		}
		
		.remove:hover
		{
			background: url(<?= $this->config->item('img_path'); ?>/removeglow.png);
			background-size: 16px 16px;
		}
	</style>
</head>
<body>
	<center><div id="wrapper">
		<table id="raspored" cellpadding="0px">
			<thead>
				<tr>
					<th colspan="5"><h1><?php echo $dan. " " .$smena; ?></h1></th>
				</tr>
				<tr>
					<th>Cas</th>
					<th>Mix</th>
					<th>Predmet</th>
					<th>Uc.</th>
					<th></th>
			</thead>
			<tbody>
				<?php foreach($raspored->result() as $predmet): ?>
					<tr>
						<td class="orange-highlight" valign="middle"><input id="cas-<?= $predmet->cas; ?>" class="cas" type="text" value="<?php echo $predmet->cas; ?>"></input></td>
						<td class="orange-highlight mid">
						<select id="mix-<?= $predmet->cas ?>">
								<option value="pre">pre</option>
								<option value="posle">posle</option>
							</select>
						</td>
						<td class="cfblue-highlight"><input id="predmet-<?= $predmet->cas; ?>" class="predmet" type="text" value="<?php echo $predmet->predmet; ?>"></input></td>
						<td class="cfblue-highlight mid"><input id="ucionica-<?= $predmet->cas; ?>" class="ucionica" type="text" value="<?= $predmet->ucionica; ?>"></input></td>
						<td><a id="remove-<?= $predmet->cas; ?>" class="remove buttonlink" href="#">remove</a></td>
					</tr>
				<?php endforeach; ?>
				<tr>
					<td colspan="4"></td>
					<td><a id="add" class="add buttonlink" href="#">add</a></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div id="choices">
	<form action="javascript:void%200">
		Dan: 
		<select id="selDan">
			<option value="Ponedeljak">Ponedeljak</option>
			<option value="Utorak">Utorak</option>
			<option value="Sreda">Sreda</option>
			<option value="Cetvrtak">Cetvrtak</option>
			<option value="Petak">Petak</option>
		</select>
		Smena: 
		<select id="selSmena">
			<option value="Prepodne">Prepodne</option>
			<option value="Poslepodne">Poslepodne</option>
		</select>		
		Grupa:
		<select id="selGrupa">
			<option value="1">Prva</option>
			<option value="2">Druga</option>
		</select>
	</form></br>
	<a id="rasporedLink" href="#">nazad na raspored</a>
	</div></center>
</body>
</html>
