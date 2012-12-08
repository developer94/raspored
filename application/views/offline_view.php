<!DOCTYPE html>
<html ng-app>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>Raspored</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/normalize.css" />
	<link rel="stylesheet/less" type="text/css" href="/assets/css/views/raspored.less" />
	<script src="/assets/js/lib/head.js"></script>
	<script src="/assets/js/paths.js"></script>
	<script>
		// Ucitavanje podataka iz PHP kontrolera
		window.data = {
			dan : "<?= $dan ?>",
			smena: "<?= $smena ?>",
			raspored: <?= $raspored ?>
		}
	</script>
</head>
<body>
	<center>
		<div id="raspored">
			<table ng-controller="RasporedCtrl">
				<thead>
					<th colspan="3"><h1>{{dan}} {{smena}}</h1></th>
				</thead>
				<tbody>
					<tr ng-repeat="cas in raspored">
						<td>{{cas.cas}}</td>
						<td>{{cas.predmet}}</td>
						<td>{{cas.ucionica}}</td>
						<td>{{cas.vreme}}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</center>
</body>
</html>