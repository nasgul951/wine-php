<?php	include("../security/login_check.php");
		include("process/p_inc_details.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Vintage Keeper Layout</title>
<link rel="stylesheet" type="text/css" href="style/details.css">
<script src="script/varietal_report.js"></script>
<?php include("../include/analytics.html");?>
</head>

<body>
<div id="page_title"><?php echo $vintage." ".$varietal; ?></div>
<div id="page_form">
<table cellpadding="0" cellspacing="0">
<tr><td nowrap><div id="hdr0" class="hdr">Vineyard</div></td>
	<td nowrap><div id="hdr1" class="hdr">Label</div></td>
	<td nowrap><div id="hdr2" class="hdr">Bottles</div></td></tr>
</table>

<div id="detail_scroll">
<table cellpadding="0" cellspacing="0">
<?php 
$i = 0;
while( $row = get_row($rsDetail) ) {
	if (++$i % 2 == 1) $row_class = "row_odd"; else $row_class = "row_even";
?>
<tr class="<?php echo $row_class; ?>" onClick="load_wine(<?php echo $row["wineid"]; ?>)">
	<td nowrap><div class="col0 col"><?php echo $row["vineyard"]; ?></div></td>
	<td nowrap><div class="col1 col"><?php echo $row["label"]; ?></div></td>
	<td nowrap><div class="col2 col"><?php echo $row["bottle_count"]; ?></div></td></tr>
<?php }// end while ?>
</table>
</div>
</div>
</body>

</html>