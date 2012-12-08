<!DOCTYPE html>
<html ng-app>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>Raspored</title>
	<script src="/assets/js/lib/head.js"></script>
	<script src="/assets/js/paths.js"></script>
	<script>
		// Ucitavanje podataka iz PHP kontrolera
		window.data = {
			dan : "<?= $dan ?>",
			smena: "<?= $smena ?>"
		}
	</script>
</head>
<body>
	<center>
		<div id="wrapper">
			<table ng-controller="RasporedCtrl">
				<thead>
					<th colspan="3"><h1>{{dan}} {{smena}}</h1></th>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
	</center>
</body>
</html>