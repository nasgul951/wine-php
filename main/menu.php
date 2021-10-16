<!DOCTYPE html>
<?php include("../security/login_check.php"); ?>

<html lang="en">
<meta name="viewport" content="width=320" />

<head>
<title>Wine Menu</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="style/other/menu.css">
<?php 
	include("../include/global-css.html");
	include("../include/analytics.html");
?>
</head>

<body>
<div>
	The Wine Database
	<ul class="nav nav-pills">
		<li><a href="winelist.php">Wine List</a></li>
		<li><a href="add_wine.php">Add Wine</a></li>
		<li><a href="../reports/vintage_keeper_graph.php">Vintage Keeper Layout</a></li>
		<li><a href="../reports/varietal_report.php">Varietal Report</a></li>
	</ul>
</div>

<div id="page_body">
</div>
</body>
<?php
	include("../include/global-js.html");
?>
</html>