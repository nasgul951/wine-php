<?php include("../include/data.php");
	if ( isset($_GET["wineid"]) )
		$wineid = $_GET["wineid"];
	else if ( isset($_POST["wineid"]) )
		$wineid = $_POST["wineid"];
	else
		$wineid = "NULL";
		
	if ( isset($_POST["add"]) ) {
		$sql = "
		INSERT INTO tblWineList (vineyard, label, varietal, vintage, created_date)
		VALUES ('".$_POST["vineyard"]."', '".$_POST["label"]."', '".$_POST["varietal"]."', ".$_POST["vintage"].", CURRENT_TIMESTAMP)";
		run_update($sql);
		
		$sql = "
			SELECT wineid
			FROM tblWineList
			ORDER BY ts_date DESC
			LIMIT 1";
		$rsLookup = run_query($sql);
		$rowLookup = get_row($rsLookup);
		$wineid = $rowLookup["wineid"];
	}// add
	
	if ( isset($_POST["add_bottle"]) ) {
		$sql = "
			INSERT INTO tblBottles(wineid, storageid, binX, binY, depth, created_date)
			VALUES (".$_POST["wineid"].", ".$_POST["storageid"].", ".$_POST["binX"].", ".$_POST["binY"].", ".$_POST["depth"].", CURRENT_TIMESTAMP)";
		run_update($sql);
	}// add_bottle
	
	if ( isset($_POST["update"]) ) {
		// Add Logic here later
	}			
	if ( isset($_POST["delete"]) ) {
		// Add Logic here later
	}
	
	if ( $wineid == "NULL" ) {
		$form["wineid"] = "";
		$form["vineyard"] = "";
		$form["label"] = "";
		$form["varietal"] = "";
		$form["vintage"] = "";
		$form["created_date"] = "";
	} else {
		$sql = "
			SELECT wineid, vineyard, label, varietal, vintage, ts_date
			FROM tblWineList
			WHERE wineid = ".$wineid;
		$rsForm = run_query($sql);
		$form = get_row($rsForm);
	}

	$sql = "
	SELECT bottleid, storageDescription, binX, binY, depth, tblBottles.created_date
	FROM tblBottles INNER JOIN tblStorage
	ON tblBottles.storageid = tblStorage.storageid
	WHERE wineid = ".$wineid;
	$rsBottles = run_query($sql);

	$sql = "
	SELECT storageid, storageDescription
	FROM tblStorage";
	$rsStorage = run_query($sql);
?>