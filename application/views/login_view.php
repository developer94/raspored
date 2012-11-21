<html>
<head>
<title>Login</title>
<link rel="icon" type="image/png" href="/assets/images/cal.png" />
<link rel="stylesheet" type="text/css" href="<?= $this->config->item('css_path'); ?>/default.css" />
<link rel="stylesheet" type="text/css" href="<?= $this->config->item('css_path'); ?>/admin.css" />
<script type="text/javascript" src="<?= $this->config->item('js_path');?>/lib/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="<?= $this->config->item('js_path');?>/views/login.js"></script>
<style type="text/css">
	h1
	{
		font-family: 'Minion Pro';
		font-size: 350px;
		color: #fff;
		text-shadow: 0px 2px 3px #666666;
	}
	
	td
	{
		color: lightgray;
		text-shadow: 0px 1px 1px midnightblue;
		font-family: 'Segoe UI', sans-serif;
		padding: 5px;
	}
	
	input
	{
		background: lightgray;
		border: 1px solid black;
	}
	
	#message
	{
		color: red;
		font-weight: bold;
	}
</style>
</head>
<body>
	<center>
	<form action="javascript:void%200">
	<table class="glass">
		<tr>
			<td class="smallemboss">Username: </td>
			<td><input id="user" type="text"></input></td>
		</tr>
		<tr>
			<td class="smallemboss">Password: </td>
			<td><input id="pass" type="password"></input></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><button id="login" class="orangebutton smallengrave">Login</button></td>
		</tr>
	</table>
	<div id="message"></div>
	</form>
	</center>
<body>
</html>