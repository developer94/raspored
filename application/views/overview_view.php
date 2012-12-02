<html>
<head>
	<title>
	Raspored
	</title>
	<meta charset="UTF-8" />
	<link rel="icon" type="image/png" href="<?= $this->config->item('img_path'); ?>/cal.png" />
	<link rel="stylesheet" type="text/css" href="<?= $this->config->item('css_path'); ?>/fonts.css" />
	<link rel="stylesheet" type="text/css" href="<?= $this->config->item('css_path'); ?>/raspored.css" />
	<link rel="stylesheet" type="text/css" href="<?= $this->config->item('css_path'); ?>/default.css" />
	<script type="text/javascript" src="<?= $this->config->item('js_path'); ?>/lib/jquery-1.8.2.min.js"></script>
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

		var edit_path = "<?= $this->config->item('edit_controller'); ?>";
		var smena = "<?= $smena?>";
		var grupa = "<?= $grupa?>";
		var odeljenje = "<?= $odeljenje?>";
	</script>
	<style type="text/css">
		body 
		{
			background: cornflowerBlue;
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
			border-right: 2.5px solid royalblue;
		}
		
		.cfblue-highlight
		{
			background: CornflowerBlue;
			min-width: 10em;
			border-left: 2.5px solid royalblue;
			border-right: 2.5px solid royalblue;
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
</head>
<body>
	<center>
		<?php
			  $dani = array();
			  $dani[0] = $overview['ponedeljak']->result();
			  $dani[1] = $overview['utorak']->result();
			  $dani[2] = $overview['sreda']->result();
			  $dani[3] = $overview['cetvrtak']->result();
			  $dani[4] = $overview['petak']->result();?>	<!-- adds a class counter -->
			  
		<div id="wrapper">
		<table id="raspored" cellpadding="0px">
			<thead>
				<th></th>
				<th>Ponedeljak</th>
				<th>Utorak</th>
				<th>Sreda</th>
				<th>Cetvrtak</th>
				<th>Petak</th>
			</thead>
		<?php for($cas = 0; $cas < 14; $cas++): ?>
			<?php
				if($cas < 7)
				{
					$pravi_cas = $cas+1;
					$mix = "pre";
				}
				else
				{
					$pravi_cas = $cas - 6;
					$mix = "posle";
				}
			?>
			<tr>
				<td class="orange-highlight" valign="middle"><b><?php echo $pravi_cas; ?></b></td>
				<?php for($dan = 0; $dan < 5; $dan++): ?>
				<td class="cfblue-highlight"> 									<!-- adds class number as the ID -->
					<span>
						<?php
						foreach($dani[$dan] as $row_info)
						{
							if($row_info->cas == $pravi_cas && $row_info->mix == $mix)
							{
								echo $row_info->predmet;
								break;
							}
						}
						?>
					</span>
				</td>
				<?php endfor; ?>
			</tr>
		<?php endfor; ?>
		</table>
		</div>
	</tbody>
	<div id="choices">
	<form action="javascript:void%200">
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
	</div>
	<h2 id="time"><span id="time-till-end"></span><span id="time-till-end-message"></span></h2>
		<a style="display: none;" title="Real Time Analytics" href="http://getclicky.com/100550047"><img alt="Real Time Analytics" src="//static.getclicky.com/media/links/badge.gif" border="0" /></a>
		<script src="//static.getclicky.com/js" type="text/javascript"></script>
		<script type="text/javascript">try{ clicky.init(100550047); }catch(e){}</script>
		<noscript><p><img alt="Clicky" width="1" height="1" src="//in.getclicky.com/100550047ns.gif" /></p></noscript>
	</center>
	<script type="text/javascript" src="<?= $this->config->item('js_path'); ?>/views/overview.js"></script>
</body>
</html>