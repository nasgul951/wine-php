<?php	include("../security/login_check.php");
		include("process/p_inc_add_wine.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
<title>Wine Database</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="style/other/add_wine.css">
<script language="JavaScript" src="script/add_wine.js"></script>
</head>

<body>
<table border="0" style="width: 100%; height: 100%;">
<tr><td align="center" valign="middle">

<div id="page_title">Add Wine</div>
<div id="page_body">
	<form action="add_wine.php" method="post">
	<table border="0" cellspacing="0" cellpadding="2" width="100%">
	<tr><td nowrap><b>Vineyard:</b></td>
		<td nowrap><input id="txt_vineyard" type="text" name="vineyard" value="<?php echo $form["vineyard"]; ?>" maxlength="50" size="30"></td>
		<td nowrap align="right"><b>Label:</b></td>
		<td nowrap colspan="2"><input id="txt_vineyard" type="text" name="label" value="<?php echo $form["label"]; ?>" maxlength="50" size="30"></td></tr>
	<tr><td nowrap><b>Varietal:</b></td>
		<td nowrap><input id="txt_vineyard" type="text" name="varietal" value="<?php echo $form["varietal"]; ?>" maxlength="30"></td>
		<td nowrap align="right"><b>Vintage:</b></td>
		<td nowrap><input id="txt_vineyard" type="text" name="vintage" value="<?php echo $form["vintage"]; ?>" size="4"></td>
		<td nowrap align="right"><?php if($wineid == "NULL"){ ?><input type="submit" value="Add" name="add"><?php } else echo "&nbsp;"; ?></td></tr>
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
			<!--- Existing Data --->
			<table border="0" cellspacing="0" cellpadding="0">
			<?php
			$i = 0; 
			while( $rowB = get_row($rsBottles) ) {
				if ( ++$i % 2 == 1 ) $rowClass = "odd_row"; else $rowClass = "even_row";				
			?>	
				<form action="add_wine.cfm" method="post">
				<input type="hidden" value="<?php echo $rowB["bottleid"]; ?>" name="bottleid">
				<tr class="<?php echo $rowClass; ?>">
					<td nowrap><div class="detail_storage"><?php echo $rowB["storageDescription"]; ?></div></td>
					<td nowrap><input class="txt_binX" type="text" value="<?php echo $rowB["binX"]; ?>" name="binX"></td>
					<td nowrap><input class="txt_binY" type="text" value="<?php echo $rowB["binY"]; ?>" name="binY"></td>
					<td nowrap><input class="txt_depth" type="text" value="<?php echo $rowB["depth"]; ?>" name="depth"></td>
					<td nowrap><div class="detail_date"><?php echo $rowB["created_date"]; ?></div></td>
					<td nowrap><input class="btn_update" type="submit" value="Update" name="update"></td>
					<td nowrap><input class="btn_delete" type="submit" value="Delete" name="delete"></td>
				</tr>
				</form>
			<?php }// end while ?>
			</table>

			<!--- New Data --->
			<table border="0" cellspacing="0" cellpadding="0">
				<form action="add_wine.php" method="post">
				<input type="hidden" name="wineid" value="<?php echo $form["wineid"]; ?>">
				<tr>
					<td nowrap>
						<select class="sel_storage" size="1" name="storageid">
						<?php while( $rowS = get_row($rsStorage) ) {
							echo "<option value=\"".$rowS["storageid"]."\">".$rowS["storageDescription"]."</option>";
						} ?>
						</select></td>
					<td nowrap><input class="txt_binX" type="text" value="" name="binX"></td>
					<td nowrap><input class="txt_binY" type="text" value="" name="binY"></td>
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
	
</div>
</body>

</html>
