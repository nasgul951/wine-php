<?php	include("../security/login_check.php");
		include("process/p_inc_vk_graph.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Vintage Keeper Layout</title>
<link rel="stylesheet" type="text/css" href="style/vk_graph.css">
<script src="script/vk_graph.js"></script>
<?php include("../include/analytics.html");?>
</head>

<body>
<a href="../main/menu.php">&lt; Main Menu</a>

<div id="vk_border">

<table>
<?php 
	$i = 1; 
	$row = get_row($rsWine); 
?>

<!--- Draw the top row --->
<tr>
	<?php
		$y = 0;
		for( $x=1; $x<=6; $x++) {
	?> 
		<td align="center" valign="middle" class="top_row">
			<?php if ( ($y == $row["binY"]) && ($x == $row["binX"]) ) {
				echo "<div class=\"bottle\"><a onClick=\"bin_detail(".$x.", ".$y.")\">".$row["binCount"]."</a></div>";
				$i++;				
				$row = get_row($rsWine); 
			}else
				echo "&nbsp;";
			?>
		</td>
	<?php }// next x ?>
</tr>

<!--- Draw the rest of the grid --->
<?php 
for ($y=1; $y<=14; $y++) {
?>
	<tr>
<?php
	for ($x=1; $x<=4; $x++) {
		// Calc col span
		if ( $x > 3 ) {
			$cspan = 3;
			$rspan = 2;
			$cls = "large_bin";
		}else {
			$cspan = 1;
			$rspan = 1;
			$cls = "norm_bin";
		}
		if ( !( ($x > 3) && ($y % 2 == 0) ) ) {
			if ( ($y == $row["binY"]) && ($x == $row["binX"]) ) {
				$bin_stat = $row["binCount"];
				$i++; $row = get_row($rsWine);
				$style = "background-color:#669933";				
			}else {
				$bin_stat = "&nbsp;";
				$style = "";
			}
		?>
		<td class="<?php echo $cls; ?>" colspan="<?php echo $cspan; ?>" rowspan="<?php echo $rspan; ?>" align="center" valign="middle" style="<?php echo $style; ?>">
			<a onClick="bin_detail(<?php echo $x; ?>, <?php echo $y; ?>)"><?php echo $bin_stat; ?></a>
		</td>
		<?php }// endif 
	}// next x
?>
	</tr>
<?php
}// next y
?>
</table>

</div>

<iframe id="bin_detail" src="sub_bin_detail.php"></iframe>
</body>
</html>
