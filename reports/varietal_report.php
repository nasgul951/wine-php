<?php
    if ( strpos($_SERVER['HTTP_USER_AGENT'], "Mobile") > 0 )
	header('Location:varietal_report_mobile.php');
    include("../security/login_check.php");
    include("process/p_inc_varietal_report.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Vintage Keeper Layout</title>
<link rel="stylesheet" type="text/css" href="style/varietal_report.css">
<script src="script/varietal_report.js"></script>
<?php include("../include/analytics.html");?>
</head>

<body>
<div id="page_title">Varietal Report (Vintage Keeper)</div>
<div id="page_form">
<table border="0" cellpadding="0" cellspacing="0">
<tr><td nowrap="nowrap"><div id="hdr0" class="hdr">Verital</div></td>
	<td nowrap="nowrap"><div id="hdr1" class="hdr">Bottles</div></td>
</tr>
</table>

<div id="detail_scroll">
<table border="0" cellpadding="0" cellspacing="0">
	<?php 
	$row_ix = 0;
	$varietal_count = 0;
	$total_count = 0;
	$theVarietal = "";
	while( $row = get_row($rsVarietal) ) {
		$row_ix++;
		if ( $row_ix % 2 == 1 ) 
			$rowClass = "odd_row"; 
		else
			$rowClass = "even_row";
		
	?>
	<?php 
	if ( $row["varietal"] != $theVarietal ) { 
		$theVarietal = $row["varietal"];
		if ( $varietal_count > 0 ) {
	?>
	<tr><td nowrap="nowrap" colspan="2"><div class="col_var_total"><?php echo $varietal_count; ?></div></td>
	</tr>
	<?php 
		}// end if: print varietal footer
		$varietal_count = 0;
	?>
	<tr><td nowrap="nowrap" colspan="2"><div class="col_varietal"><?php echo $row["varietal"]; ?></div></td>
	</tr>
	<?php
	}// end if: varietal header
	$varietal_count+=$row["bottle_count"];
	$total_count+=$row["bottle_count"];
	?>
	<tr onclick="<?php echo "get_detail('".$row["varietal"]."', '".$row["vintage"]."')"; ?>">
		<td nowrap="nowrap"><div class="col0 col"><?php echo $row["vintage"]; ?></div></td>
		<td nowrap="nowrap"><div class="col1 col"><?php echo $row["bottle_count"]; ?></div></td>
	</tr>
	<?php }// end while 
	if ( $varietal_count > 0 ) {
	?>
	<tr><td nowrap="nowrap" colspan="2"><div class="col_var_total"><?php echo $varietal_count; ?></div></td>
	</tr>
	<?php } 
	if ( $total_count > 0 ) {
	?>	
	<tr><td nowrap="nowrap" colspan="2"><div class="col_var_total"><?php echo " Total: ".$total_count; ?></div></td>
	</tr>
	<?php } ?>	
</table>
</div>
</div><!-- page_form -->
</body>
</html>
