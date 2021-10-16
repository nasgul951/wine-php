<?php 
// list bottles
// included in sub_bin_detail.php, sub_case_detail.php
?>
<table cellpadding="0" cellspacing="0">
<tr><td nowrap><div id="hdr0">Depth</div></td>
	<td nowrap><div id="hdr1">Bottles</div></td>
	<td nowrap><div id="hdr2">Vineyard</div></td>
	<td nowrap><div id="hdr3">Label</div></td>
	<td nowrap><div id="hdr4">Varaitel</div></td>
	<td nowrap><div id="hdr5">Vintage</div></td></tr>
</table>
<table cellpadding="0" cellspacing="0">
<?php 
$i = 0;
while( $row = get_row($rsList) ) {
	if (++$i % 2 == 1) $row_class = "row_odd"; else $row_class = "row_even";
?>
<tr class="<?php echo $row_class; ?>" onClick="load_wine(<?php echo $row["wineid"]; ?>)">
	<td nowrap><div class="col0"><?php echo $row["depth"]; ?></div></td>
	<td nowrap><div class="col1"><?php echo $row["mCount"]; ?></div></td>
	<td nowrap><div class="col2"><?php echo $row["vineyard"]; ?></div></td>
	<td nowrap><div class="col3"><?php echo $row["label"]; ?></div></td>
	<td nowrap><div class="col4"><?php echo $row["varietal"]; ?></div></td>
	<td nowrap><div class="col5"><?php echo $row["vintage"]; ?></div></td></tr>
<?php }// end while ?>
</table>
