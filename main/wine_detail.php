<?php	include("../security/login_check.php");
		include("process/p_inc_wine_detail.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<meta name="viewport" content="width=device-width" />

<?php $rowWine = get_row($rsWine); ?>
<head>
<title>Wine Detail</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="style/other/wine_detail.css">
<script language="JavaScript" src="script/wine_detail.js"></script>
<?php include("../include/analytics.html");?>
</head>

<body>
<table border="0" style="width: 100%; height: 100%;">
<tr><td align="center" valign="middle">

<div id="body_main">
	<form action="wine_detail.php" method="post">
	<input type="hidden" name="wineid" value="<?php echo $rowWine["wineid"]; ?>">
	<table border="0" cellspacing="0" cellpadding="2" width="100%">
	<tr><td nowrap><b>Vineyard:</b></td>
		<td nowrap><input id="txt_vineyard" type="text" name="vineyard" value="<?php echo $rowWine["vineyard"]; ?>" maxlength="50" size="30"></td>
		<td nowrap align="right"><b>Label:</b></td>
		<td nowrap colspan="2"><input id="txt_label" type="text" name="label" value="<?php echo $rowWine["label"]; ?>" maxlength="50" size="30"></td></tr>
	<tr><td nowrap><b>Varietal:</b></td>
		<td nowrap><input id="txt_varietal" type="text" name="varietal" value="<?php echo $rowWine["varietal"]; ?>" maxlength="30"></td>
		<td nowrap align="right"><b>Vintage:</b></td>
		<td nowrap><input id="txt_vintage" type="text" name="vintage" value="<?php echo $rowWine["vintage"]; ?>" size="4"></td>
		<td>&nbsp;</td></tr>
	<tr><td nowrap="nowrap" valign="top"><b>Notes:</b></td>
		<td colspan="3"><textarea id="txt_notes" name="notes"><?php echo $rowWine["notes"]; ?></textarea>
		<td nowrap align="right" valign="bottom"><input type="submit" value="Update" name="upd_wine"></td></tr>
	</table>
	</form>

	<div id="body_detail">
		<table border="0" cellspacing="0" cellpadding="0">
			<tr><td nowrap><div id="header_storage">Storage Location</div></td>
				<td nowrap><div id="header_binX">Left</div></td>
				<td nowrap><div id="header_binY">Top</div></td>
				<td nowrap><div id="header_depth">Depth</div></td>
				<td nowrap><div id="header_date">Date</div></td>
				<td>&nbsp;</td>
			</tr>
		</table>
		<div id="detail_scroll">
			<table border="0" cellspacing="0" cellpadding="0">
			<?php $row_ix = 0; 
			while( $rowB = get_row($rsBottles) ) {
				if ( ++$row_ix % 2 == 1 )
					$rowClass = "odd_row";
				else
					$rowClass = "even_row";
			?>
				<form action="wine_detail.php" method="post">
				<input type="hidden" value="<?php echo $rowB["bottleid"]; ?>" name="bottleid">
				<tr class="<?php echo $rowClass; ?>">
					<td nowrap><div class="detail_storage"><select class="sel_storage" name="storageid" size="1">
						<?php while( $rowS = get_row($rsStorage) ) {
						if ( $rowS["storageid"] == $rowB["storageid"] )
							echo "<option selected value=\"".$rowS["storageid"]."\">".$rowS["storageDescription"]."</option>";
						else
							echo "<option value=\"".$rowS["storageid"]."\">".$rowS["storageDescription"]."</option>";
						}// end while
						goto_row($rsStorage, 0); ?>
					</select></div></td>
					<td nowrap><input class="txt_binX" type="text" value="<?php echo $rowB["binX"]; ?>" name="binX"></td>
					<td nowrap><input class="txt_binY" type="text" value="<?php echo $rowB["binY"]; ?>" name="binY"></td>
					<td nowrap><input class="txt_depth" type="text" value="<?php echo $rowB["depth"]; ?>" name="depth"></td>
					<td nowrap><div class="detail_date"><?php echo $rowB["created_date"]; ?></div></td>
					<td nowrap><input class="btn_update" type="submit" value="Update" name="update"></td>
					<td nowrap><input class="btn_consumed" type="submit" value="Consumed" name="consumed"></td>
				</tr>
				</form>
			<?php } // end while ?>
			<form action="wine_detail.php" method="post">
				<input type="hidden" name="wineid" value="<?php echo $wineid; ?>">
				<tr>
					<td nowrap>
						<select class="sel_storage" size="1" name="storage_id">
						<?php while( $rowS = get_row($rsStorage) ) { 
							echo "<option value=\"".$rowS["storageid"]."\">".$rowS["storageDescription"]."</option>";
						}// end while ?>
						</select></td>
					<td nowrap><input class="txt_binX" type="text" value="" name="bin_x"></td>
					<td nowrap><input class="txt_binY" type="text" value="" name="bin_y"></td>
					<td nowrap><input class="txt_depth" type="text" value="" name="depth"></td>
					<td nowrap><div class="detail_date">&nbsp;</div></td>
					<td nowrap><input class="btn_update" type="submit" value="Add" name="add_bottle"></td>
					<td nowrap>&nbsp;</td>
				</tr>
			</form>
			</table>
		</div><!--- detail_scroll --->
	</div><!--- body_detail --->
	<div id="body_buttons">
		<input type="button" value="Close" onClick="close_onClick()">
	</div>
</div><!--- body_main --->

</td></tr>
</table>
</body>

</html>
