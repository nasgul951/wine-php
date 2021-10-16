<?php
	include("../security/login_check.php"); 
	include("process/p_inc_winelist.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>Wine Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="style/other/winelist.css">
<script language="JavaScript" src="script/winelist.js"></script>
<?php 
	include("../include/global-css.html");
	include("../include/analytics.html");
?>
</head>


<body nav-active="winelist">
<?php
	include("../include/navbar.php"); 
?>
<div class="container bg-solid">
	<div class="row">
		<div class="span4">
			<h6>Total Bottles: <?php echo $rowTotal["ttlBottles"]; ?></h6>
		</div>
		<div class="span4 text-center">
			<h5>Wine List</h5>
		</div>
		<div class="span4 text-right">
			<div class="pad-content">
				<select size="1" name="filter" onChange="filter(this.value)">
					<option></option>
					<?php
					while( $rowStore = $rsStore->fetch_assoc() ){
						if ( $_POST["filter"] == $rowStore["storageid"] ) {
							echo 
                                                        "<option selected value=\"".$rowStore["storageid"]."\">".$rowStore["storageDescription"]."</option>";
                                                } else {
							echo 
                                                        "<option value=\"".$rowStore["storageid"]."\">".$rowStore["storageDescription"]."</option>";
                                                }
					}
					?>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<hr/>
		</div>
	</div>
	<table class="table table-striped">
		<thead>
		<tr><th><div class="clickable" onClick="sort('vineyard')">Vineyard<?php echo showSortArrow('vineyard'); ?></div></td>
			<th><div class="clickable" onClick="sort('label')">Label<?php echo showSortArrow('label'); ?></div></td>
			<th><div class="clickable" onClick="sort('varietal')">Varietal<?php echo showSortArrow('varietal'); ?></div></td>
			<th><div class="clickable" onClick="sort('vintage')">Vintage<?php echo showSortArrow('vintage'); ?></div></td>
			<th><div>Count</div></td>
			<th><div>Date Added</div></td>
		</tr>
		</thead>
		<tbody>
			<?php 
			$row_ix = 0;
			while( $rowItem = $rsList->fetch_assoc() ) {
				$row_ix++;
				if ( $row_ix % 2 == 1 ) 
					$rowClass = "odd_row"; 
				else
					$rowClass = "even_row";
			?>
			<tr onClick="open_detail(<?php echo $rowItem["wineid"]; ?>)">
				<td nowrap><div><?php echo $rowItem["vineyard"]; ?></div></td>
				<td nowrap><div><?php echo $rowItem["label"]; ?></div></td>
				<td nowrap><div><?php echo $rowItem["varietal"]; ?></div></td>
				<td nowrap><div><?php echo $rowItem["vintage"]; ?></div></td>
				<td nowrap><div><?php echo $rowItem["mCount"]; ?></div></td>
				<td nowrap><div><?php echo $rowItem["created_date"]; ?></div></td>
			</tr>
			<?php }// end while ?>
		</tbody>
		<div id="body_footer">
			<input type="button" value="Close" onClick="close_onClick()">
		</div>
</div>

</body>
<form name="frmMain" action="winelist.php" method="post">
	<input type="hidden" name="sort_by" value="<?php echo $sort_by; ?>">
	<input type="hidden" name="filter" value="<?php echo $filter; ?>">
</form>
<?php
	include("../include/global-js.html");
?>
</html>
