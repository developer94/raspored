<html>
<head>
	<title>
	Raspored
	</title>
	<link rel="icon" type="image/png" href="<?= $this->config->item('img_path'); ?>/cal.png" />
	<link rel="stylesheet" type="text/css" href="<?= $this->config->item('css_path'); ?>/fonts.css" />
	<link rel="stylesheet" type="text/css" href="<?= $this->config->item('css_path'); ?>/raspored.css" />
	<script type="text/javascript" src="<?= $this->config->item('js_path'); ?>/jquery-1.8.2.min.js"></script>
	<style type="text/css">
		body 
		{
			background: cornflowerBlue;
		}
		
		#raspored
		{
			border: 1px none white;
			border-spacing: 0 0.2em;
		}
		
		#raspored th
		{
			font-weight: 100;
			font-family: 'Segoe UI';
			font-size: 24pt;
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
		
		#wrapper
		{
			display: inline-block;
			background: royalBlue;
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
			width: 20px;
		}
		
		.cfblue-highlight
		{
			background: CornflowerBlue;
			min-width: 20em;
		}
		
		.classroom
		{
			float: right;
		}
		
		#time-till-end
		{
			color: white;
			font-weight: bold;
			font-family: 'Segoe UI', sans-serif;
			font-size: 48pt;
		}
		
		#time
		{
			margin-top: 30px;
		}
	</style>
	<script type="text/javascript">
		var vremena = [];
		var minuti = [];
		var sati = [];
		var casovi = [];
	
		var current = 0; 		//static for counting inital time array creation
		var current_sat;
		var current_minut;
		var current_index = 0; 	//index for marking last class. speeds up current class time calculation.
		var currently_marked = 0;
		
		var g_hasAlreadyPassed; //function publishing
		var g_timeTillEnd;
		var g_calculate_time;		
		
		$(document).ready(function ()
		{
			$("#selDan").val("<?= $dan?>");			//fill values of choices div under the timetable
			$("#selSmena").val("<?= $smena?>");		//----
			$("#selGrupa").val("<?= $grupa?>");		//----
			
			$("#selDan").change(update);			//make change of these trigger the update
			$("#selSmena").change(update);			//----
			$("#selGrupa").change(update);			//----
			
			var dan = $("#selDan").val();			//as we've already defined values read from php
			var smena = $("#selSmena").val();		//use them as local variables
			var grupa = $("#selGrupa").val();		//
			
			$("#izmeniLink").attr("href", '<?= $this->config->item('edit_controller'); ?>/izmeni/' + grupa + '/409/' + dan + '/' + smena);
			
			//==============================================================================
			//=== CLASS TIME FUNCTIONS
			//==============================================================================
			//Fix time values, slice 
			for(index in vremena)
			{
				var value = vremena[index];
				minuti[index] = value.slice(-2);
				if(minuti[index][0] == "0")
				{
					minuti[index] = minuti[index].slice(1);
				}
					
				sati[index] = value.substr(0,2);					
				if(sati[index][0] == "0")
					sati[index] = sati[index].slice(1);
			}

			var now = new Date();
			var start_time = new Date();
			start_time.setMinutes(minuti[current_index]);
			start_time.setHours(sati[current_index]);
			if(now.getTime() >= start_time.getTime())
				classes_started = true;
			
			function calculate_time()
			{
				current_index = 0;										//Check the whole list (if it's a new day)
				while(current_index < vremena.length)
				{
					if(hasAlreadyPassed(sati[current_index], minuti[current_index]) == false)
						break;
					current_index++;
				}
				if(current_index > 0)
					current_index--;
			}

			function unmark_class(class_index)
			{
				var this_class = $('#cas-'+class_index);				//Find current class row
				this_class.removeClass('current_class');				//Remove existant class markings
				this_class.addClass('cfblue-highlight');				//Add normal theme colors !!!!! CHECK IF CHANGING COLORS OF THE THEME!
			}

			function mark_class(class_index)
			{
				unmark_class(currently_marked);
				var this_class = $('#cas-'+class_index);				//Find current class row
				this_class.addClass('current_class');					//Remove existant class markings
				this_class.removeClass('cfblue-highlight');				//Add normal theme colors !!!!! CHECK IF CHANGING COLORS OF THE THEME!
				currently_marked = class_index;
			}
			
			g_calculate_time = calculate_time;
			calculate_time();

			function hasAlreadyPassed(hours, minutes)					//checks if the time has passed compared to the current moment
			{
				var time = new Date();
				//time.setHours(10);									//DEBUG: Test time
				//time.setMinutes(52);									//DEBUG: Test time
				
				var last_time = new Date();
				last_time.setHours(hours);
				last_time.setMinutes(minutes);
				
				if(last_time.getTime() < time.getTime())
					return true;
				else
					return false;
			}
			
			g_hasAlreadyPassed = hasAlreadyPassed;						//DEBUG: global func
			
			var timeTillEnd = function ()
			{
				var now = new Date();
				//now.setHours(10);										//DEBUG: Test time
				//now.setMinutes(52);									//DEBUG: Test time
				
				var current_class = new Date();
				var end_of_class = new Date();
				var next = new Date();
				var message;
				current_class.setHours(sati[current_index]);
				current_class.setMinutes(minuti[current_index]);
				end_of_class = new Date(current_class);
				end_of_class.setTime(current_class.getTime() + 45*60*1000);

				if(current_index < vremena.length - 1)													//if there is a next class
				{
					next.setHours(sati[current_index + 1]);
					next.setMinutes(minuti[current_index + 1]);
				}
				
				if(current_class.getTime() >= now.getTime() && current_index == 0)						//if it's time before school
				{
					var formatted_time = new Date(current_class - now);
					
					if(formatted_time.getHours() > 0)
					{
						var diff = Math.floor((formatted_time.getTime() - formatted_time.getMinutes() * 60 * 1000) / 60 / 60 / 1000) + "h " + formatted_time.getMinutes() + "m "; //Convert into Hh Mm format for display
					}
					else
						var diff = formatted_time.getMinutes();
					
					if(diff == 0)
					{
						diff = "";
						message = "Skola upravo pocinje!";
					}
					else
						message = "min. do pocetka casova";

					unmark_class(currently_marked);
				}
				else if(end_of_class.getTime() > now.getTime()) 										//if there's a class going on
				{
					var diff = Math.floor((end_of_class.getTime() - now.getTime()) / 1000 / 60);
					
					if(current_index < vremena.length - 1)
						message = "min. do kraja casa";
					else
						message = "min. do kraja <b>poslednjeg</b> casa!";

					mark_class(current_index);
				}
				else if(now.getTime() >= end_of_class.getTime() && next.getTime() >= now.getTime()  && current_index < vremena.length - 1)	//if it's reccess - and it's not the last class
				{
					classes_started = true;
					message = "min. do kraja odmora";
					var diff = Math.floor((next.getTime() - now.getTime()) / 1000 / 60);
					if(diff == 0)
					{
						diff = "";
						message = "Cas upravo pocinje!";
						unmark_class(current_index);
						mark_class(current_index+1);
					}
				}
				else if(now.getTime() > end_of_class.getTime() && current_index == vremena.length - 1)
				{
					diff = "";
					message = "Nastava se zavrsila.";
					unmark_class(currently_marked);
				}

				calculate_time();
				
				$("#time-till-end").html(diff);								//Fill #time-till-end with the time left
				$("#time-till-end-message").html(message);					//Fill the message with appropriate time left text
				
				setTimeout(timeTillEnd, 1000);
			};
			
			timeTillEnd();
			g_timeTillEnd = timeTillEnd;								//DEBUG: global func
			//==============================================================================
			//=== END OF CLASS TIMER
			//==============================================================================
			
			function update()
			{
				var dan = $("#selDan").val();
				var smena = $("#selSmena").val();
				var grupa = $("#selGrupa").val();
				window.location.href = '/raspored/index/' + grupa + '/409/' + dan + '/' + smena;
			}
		});
	</script>
</head>
<body>
	<center><div id="wrapper">
		<table id="raspored" cellpadding="0px">
			<thead>
				<tr>
					<th colspan="3"><h1><?php echo $dan. " " .$smena; ?></h1></th>
				</tr>
			</thead>
			<tbody>
				<?php $current = 0; ?>																				<!-- adds a class counter -->
				<?php foreach($raspored->result() as $predmet): ?>
					<tr>
						<td class="orange-highlight" valign="middle"><b><?php echo $predmet->cas; ?></b></td>
						<td class="cfblue-highlight" id="cas-<?= $current; ?>"> 									<!-- adds class number as the ID -->
							<span><?php echo $predmet->predmet; ?></span>
							<?php if(!is_null($predmet->ucionica)): ?>
							<span class="classroom">uc. <?php echo $predmet->ucionica; ?></span>
							<?php endif; ?>
						</td>
						<td><?php echo $predmet->vreme; ?></td>
					</tr>
					<script type="text/javascript">
						vremena[current] = "<?= $predmet->vreme; ?>";
						casovi[current] = <?= $predmet->cas; ?>;
						current++;
					</script>
					<?php $current++; ?>
				<?php endforeach; ?>
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
	<a id="izmeniLink" href="#">izmeni raspored</a>
	</div>
	<h2 id="time"><span id="time-till-end"></span><span id="time-till-end-message"></span></h2>
		<a title="Real Time Analytics" href="http://getclicky.com/100550047"><img alt="Real Time Analytics" src="//static.getclicky.com/media/links/badge.gif" border="0" /></a>
		<script src="//static.getclicky.com/js" type="text/javascript"></script>
		<script type="text/javascript">try{ clicky.init(100550047); }catch(e){}</script>
		<noscript><p><img alt="Clicky" width="1" height="1" src="//in.getclicky.com/100550047ns.gif" /></p></noscript>
	</center>
</body>
</html>