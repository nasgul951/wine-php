<?php
	include("../security/login_check.php"); 
	include("process/p_inc_winelist.php");
?>

<html>
<meta name="viewport" content="width=device-width" />

<head>
<title>Wine Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="style/mobile/winelist.css">
<script language="JavaScript" src="script/winelist.js"></script>
<?php include("../include/analytics.html");?>
</head>


<body>
<!--
<table border="0" style="width: 100%; height: 95%">
<tr><td align="center">
-->
<div id="page_body">
<div id="body_titlebar">
    <div id="titlebar_right"><a href="menu.php">[Main Menu]</a></div>
</div>
<div id="body_header">
Wine List
<div id="body_totals">Total Bottles: <?php echo $rowTotal["ttlBottles"]; ?></div>
	<div id="title_filter">
		<select size="1" name="filter" onChange="filter(this.value)">
			<option></option>
			<?php
			while( $rowStore = $rsStore->fetch_assoc() ){
				if ( $_POST["filter"] == $rowStore["storageid"] )
					echo "<option selected value=\"".$rowStore["storageid"]."\">".$rowStore["storageDescription"]."</option>";
				else
					echo "<option value=\"".$rowStore["storageid"]."\">".$rowStore["storageDescription"]."</option>";
			}
			?>
		</select>
	</div>
</div>
	<table border="0" cellspacing="0" cellpadding="2">
	<tr><td nowrap><div id="col1_title" onClick="sort('vineyard')">Vineyard</div></td>
		<td nowrap><div id="col2_title" onClick="sort('label')">Label</div></td>
		<td nowrap><div id="col3_title" onClick="sort('varietal')">Varietal</div></td>
		<td nowrap><div id="col4_title" onClick="sort('vintage')">Vintage</div></td>
		<td nowrap><div id="col5_title">Count</div></td>
		<td nowrap><div id="col6_title">Date Added</div></td>
	</tr>
	</table>
	<div id="body_scroll">
		<table border="0" cellspacing="0" cellpadding="2">
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
			<td nowrap><div class="col1_data"><?php echo $rowItem["vineyard"]; ?></div></td>
			<td nowrap><div class="col2_data"><?php echo $rowItem["label"]; ?></div></td>
			<td nowrap><div class="col3_data"><?php echo $rowItem["varietal"]; ?></div></td>
			<td nowrap><div class="col4_data"><?php echo $rowItem["vintage"]; ?></div></td>
			<td nowrap><div class="col5_data"><?php echo $rowItem["mCount"]; ?></div></td>
			<td nowrap><div class="col6_data"><?php echo $rowItem["created_date"]; ?></div></td>
		</tr>
		<?php }// end while ?>
		</table>
	</div>
<div id="body_footerbar">
    <div id="footerbar_right"><a href="menu.php">[Main Menu]</a></div>
</div>
</div>
<!--
</td></tr>
</table>
-->
</body>
<form name="frmMain" action="winelist_mobile.php" method="post">
	<input type="hidden" name="sort_by" value="<?php echo $_POST["sort_by"]; ?>">
	<input type="hidden" name="filter" value="<?php echo $_POST["filter"]; ?>">
</form>
</html>

