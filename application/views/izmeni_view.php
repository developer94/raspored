<html>
<head>
	<title>
	Raspored
	</title>
	<link rel="icon" type="image/png" href="<?= $this->config->item('img_path'); ?>/cal.png" />
	<link rel="stylesheet" type="text/css" href="<?= $this->config->item('css_path'); ?>/fonts.css" />
	<link rel="stylesheet" type="text/css" href="<?= $this->config->item('css_path'); ?>/admin.css" />
	<link rel="stylesheet" type="text/css" href="<?= $this->config->item('css_path'); ?>/raspored.css" />
	<script type="text/javascript" src="<?= $this->config->item('js_path'); ?>/lib/jquery-1.8.2.min.js"></script>
	<style type="text/css">
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
					<th colspan="5"><h4><?php echo $dan. " " .$smena; ?></h4></th>
				</tr>
				<tr>
					<th><h4>Cas</h4></th>
					<th><h4>Mix</h4></th>
					<th><h4>Predmet</h4></th>
					<th><h4>Uc.</h4></th>
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
	<script type="text/javascript" src="<?= $this->config->item('js_path'); ?>/views/izmeni.js"></script>
</body>
</html>
