<?php	include("../security/login_check.php");
		include("process/p_inc_wine_vault_cases.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Vintage Keeper Layout</title>
<link rel="stylesheet" type="text/css" href="style/wine_vault_cases.css">
<script src="script/wine_vault_cases.js"></script>
<?php include("../include/analytics.html");?>
</head>

<body>
<a href="../main/menu.php">&lt; Main Menu</a>

<div id="vault_border">

<table>
<?php 
$row = get_row($rsWine);
while( $row ) {
	echo "<tr>";
	for ($x=1; $x<=2; $x++) {
		if ( $row )
		{
			$bin_stat = $row["depth"]."<br />".$row["binCount"];
			$case_no = $row["depth"];
			$style = "background-color:#669933";
		}
		else
		{
			$bin_stat = "nbsp;";
			$case_no = "null";
			$style = "background-color:white";
		}				
?>
		<td class="case" align="center" valign="middle" style="<?php echo $style; ?>">
			<a onClick="case_detail(<?php echo $case_no; ?>)"><?php echo $bin_stat; ?></a>
		</td>
<?php
		// get next row
		$row = get_row($rsWine);
	}// next x
	echo "</tr>";
}// end while
?>
</table>

</div>

<iframe id="case_detail" src="sub_case_detail.php"></iframe>
</body>
</html>
