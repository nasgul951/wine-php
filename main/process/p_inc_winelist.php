<?php include("../include/data.php");
	
	// Determin sort parameters
	$order_by = "vineyard, varietal, vintage";	// default
	if ( isset($_POST["sort_by"]) ){
		switch ( $_POST["sort_by"] ){
			case "vineyard":
				$order_by = "vineyard, varietal, vintage";
				break;
			case "label":
				$order_by = "label, varietal, vintage";
				break;
			case "varietal":
				$order_by = "varietal, vineyard, vintage";
				break;
			case "vintage":
				$order_by = "vintage, vineyard, varietal";
				break;
		}// end switch
	}// end if
	
	// set filter parameter
	$filter = "";
	if ( isset($_POST["filter"]) )
		$filter = $_POST["filter"];
	
	$sql = "
	SELECT storageid, storageDescription
	FROM tblStorage";
	$rsStore = $mysqli->query($sql);
	
	$sql = " 	
	SELECT tblWineList.wineid, vineyard, label, varietal, vintage, count(bottleid) AS mCount, tblWineList.created_date
	FROM tblWineList INNER JOIN tblBottles
	ON tblWineList.wineid = tblBottles.wineid
	WHERE consumed = 0";
	
	if ( $filter != "" )
		$sql = $sql . " AND storageid = " . $filter;
	$sql = $sql . " 
	GROUP BY wineid
	ORDER BY " . $order_by;
	
	$rsList = $mysqli->query($sql);
	if ( !$rsList ) {
		echo $mysqli->error . "<br>" . $sql;
		exit;
	}
	
	$sql = "SELECT count(1) AS ttlBottles FROM tblBottles WHERE consumed = 0";
	if ( $filter != "" )
		$sql .= " AND storageid = ".$filter;
	$rsTotal = run_query($sql);
	$rowTotal = get_row($rsTotal);
	
	// output html for sort icon, to display next to column header
	function showSortArrow($thisColumn)
	{
		$retval = "";
		if ( isset($_POST["sort_by"]) )
		{
			if ($_POST["sort_by"] == $thisColumn)
				$retval = "<span class='icon-arrow-down pull-right'></span>";
		}
		return $retval;
	}
?>
