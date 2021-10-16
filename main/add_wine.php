<?php	include("../security/login_check.php");
		include("process/p_inc_add_wine.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>Wine Database</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="style/other/add_wine.css">
<script language="JavaScript" src="script/add_wine.js"></script>
<?php 
	include("../include/global-css.html");
	include("../include/analytics.html");
?>
</head>

<body nav-active="addwine">
<?php
	include("../include/navbar.php"); 
?>
<div class="container bg-solid">
	<div class="row">
		<div class="span12">
			<h4>Add Wine</h4>
			<hr/>
		</div>
	</div>
	<form class="form-inline" action="add_wine.php" method="post">
		<div class="row">
			<div class="span1 text-right">
				<label>Vineyard:</label>
			</div>
			<div class="span5">
				<input id="txt_vineyard" type="text" name="vineyard" value="<?php echo $form["vineyard"]; ?>" maxlength="50" size="30">
			</div>	
			<div class="span1 text-right">
				<label>Label:</label>
			</div>	
			<div class="span5">
				<input id="txt_label" type="text" name="label" value="<?php echo $form["label"]; ?>" maxlength="50" size="30">
			</div>
		</div>
		<div class="row">
			<div class="span1 text-right">
				<label>Varietal:</label>
			</div>
			<div class="span5">
				<input id="txt_varietal" type="text" name="varietal" value="<?php echo $form["varietal"]; ?>" maxlength="30">
			</div>
			<div class="span1 text-right">
				<label>Vintage:</label>
			</div>
			<div class="span5">
				<input id="txt_vintage" type="text" name="vintage" value="<?php echo $form["vintage"]; ?>" size="4">
			</div>
		</div>
		<div class="row">
			<div class="span12">
				<label>Notes:</label><br/>
                                <fieldset>
				<textarea id="txt_notes" name="notes"><?php echo $form["notes"]; ?></textarea>
				<?php if($wineid == "NULL"){ ?><button type="submit" class="btn" name="add">Add</button><?php } ?>
                                </fieldset>
			</div>
		</div>
		</form>
	
		<table class="table table-condensed">
			<thead>
				<tr><th nowrap><div>Storage Location</div></td>
					<th nowrap><div>Left</div></td>
					<th nowrap><div>Top</div></td>
					<th nowrap><div>Depth</div></td>
					<th nowrap><div>Date</div></td>
					<th>&nbsp;</td>
				</tr>
			</thead>
			<tbody>
			<?php
			$i = 0; 
			while( $rowB = get_row($rsBottles) ) {
				if ( ++$i % 2 == 1 ) $rowClass = "odd_row"; else $rowClass = "even_row";				
			?>	
				<form action="add_wine.cfm" method="post">
				<input type="hidden" value="<?php echo $rowB["bottleid"]; ?>" name="bottleid">
				<tr class="<?php echo $rowClass; ?>">
					<td nowrap><div><?php echo $rowB["storageDescription"]; ?></div></td>
					<td nowrap><input class="txt_binX" type="text" value="<?php echo $rowB["binX"]; ?>" name="binX"></td>
					<td nowrap><input class="txt_binY" type="text" value="<?php echo $rowB["binY"]; ?>" name="binY"></td>
					<td nowrap><input class="txt_depth" type="text" value="<?php echo $rowB["depth"]; ?>" name="depth"></td>
					<td nowrap><div><?php echo $rowB["created_date"]; ?></div></td>
					<td nowrap><button class="btn" type="submit" name="update">Update</button></td>
					<td nowrap><button class="btn" type="submit" name="delete">Delete</button></td>
				</tr>
				</form>
			<?php }// end while ?>
			
	
			<!--- New Data --->
			</tbody>
			<tfoot>
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
					<td nowrap><div>&nbsp;</div></td>
					<td nowrap><button class="btn" type="submit" name="add_bottle">Add</button></td>
					<td nowrap>&nbsp;</td>
				</tr>
				</form>
			</tfoot>
		</table>
		<div id="body_buttons">
			<input type="button" value="Close" onClick="close_onClick()">
		</div>
</div>
</body>
<?php
	include("../include/global-js.html");
?>
</html>
