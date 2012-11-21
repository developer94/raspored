<html>
<head>
	<title>
	Raspored
	</title>
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
		var dan = "<?= $dan?>";
		var smena = "<?= $smena?>";
		var grupa = "<?= $grupa?>";
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
		<input type="checkbox" id="skraceni">Skraceni</input>
	</form></br>
	<a id="izmeniLink" href="#">izmeni raspored</a>
	</div>
	<h2 id="time"><span id="time-till-end"></span><span id="time-till-end-message"></span></h2>
		<a title="Real Time Analytics" href="http://getclicky.com/100550047"><img alt="Real Time Analytics" src="//static.getclicky.com/media/links/badge.gif" border="0" /></a>
		<script src="//static.getclicky.com/js" type="text/javascript"></script>
		<script type="text/javascript">try{ clicky.init(100550047); }catch(e){}</script>
		<noscript><p><img alt="Clicky" width="1" height="1" src="//in.getclicky.com/100550047ns.gif" /></p></noscript>
	</center>
	<script type="text/javascript" src="<?= $this->config->item('js_path'); ?>/views/raspored.js"></script>
	<script type="text/javascript" src="<?= $this->config->item('js_path'); ?>/class-time.js"></script>
</body>
</html>