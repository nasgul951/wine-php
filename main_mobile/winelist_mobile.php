<?php 
	include("../security/login_check.php"); 
	include("process/p_inc_winelist.php");
?>

<html>

<head>
<title>Wine List</title>
<link rel="stylesheet" type="text/css" href="style/other/winelist.css">
<script language="JavaScript" src="script/winelist.js"></script>
</head>


<body style="width: 200px;">

<table border="0" cellspacing="0" cellpadding="2" style="width: 200px;">
<?php 
$row_ix = 0;
while( $rowItem = $rsList->fetch_assoc() ) {
	$row_ix++;
	if ( $row_ix % 2 == 1 ) 
		$rowClass = "odd_row"; 
	else
		$rowClass = "even_row";
?>
<tr class="<?php echo $rowClass; ?>" onClick="open_detail(<?php echo $rowItem["wineid"]; ?>)">
	<td nowrap><div class="col1"><?php echo $rowItem["vineyard"]; ?></div></td>
	<td nowrap><div class="col2"><?php echo $rowItem["label"]; ?></div></td>
	<td nowrap><div class="col3"><?php echo $rowItem["varietal"]; ?></div></td>
	<td nowrap><div class="col4"><?php echo $rowItem["vintage"]; ?></div></td>
	<td nowrap><div class="col5"><?php echo $rowItem["mCount"]; ?></div></td>
</tr>
<?php }// end while ?>
</table>


</body>

</html>