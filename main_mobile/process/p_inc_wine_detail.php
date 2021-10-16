<?php include("../include/data.php");
if ( isset($_GET["wineid"]) )
	$wineid = $_GET["wineid"];

if ( isset($_POST["wineid"]) ) {
	$wineid = $_POST["wineid"];
	if ( isset($_POST["upd_wine"]) ) {
	// Update Wine
		$sql = "
			UPDATE tblWineList
			SET	vineyard = '".$_POST["vineyard"]."', 
				label = '".$_POST["label"]."', 
				varietal = '".$_POST["varietal"]."', 
				vintage = ".$_POST["vintage"]." 
			WHERE wineid = ".$wineid;
		run_update($sql);
	}
}

if ( isset($_POST["bottleid"]) ) {
	if ( isset($_POST["update"]) ) {
	// Update Bottle
		$sql = "
			UPDATE tblBottles
			SET binX = " . $_POST["binX"] . ",
				binY = " . $_POST["binY"] . ",
				depth = " . $_POST["depth"] . ",
				storageid = ". $_POST["storageid"] . "
			WHERE bottleid = " . $_POST["bottleid"];
		run_update($sql);
	}
	if ( isset($_POST["consumed"]) ) {
	// Set consumed	
		$sql = "
			UPDATE tblBottles
			SET consumed = 1,
				consumed_date = CURRENT_TIMESTAMP
			WHERE bottleid = " . $_POST["bottleid"];
		run_update($sql);
	}	
	$sql = "
		SELECT wineid FROM tblBottles
		WHERE bottleid = " . $_POST["bottleid"];
	$rsLookup = run_query($sql);
	$rowLookup = get_row($rsLookup);
	$wineid = $rowLookup["wineid"];
}// end if bottleid

if ( isset($_POST["add_bottle"]) ){
// Insert new bottle	
	$sql = "
		INSERT INTO tblBottles(wineid, storageid, binX, binY, depth)
		VALUES (".$_POST["wine_id"].", ".$_POST["storage_id"].", ".$_POST["bin_x"].", ".$_POST["bin_y"].", ".$_POST["depth"].")";
	run_update($sql);
	$wineid = $_POST["wineid"];
}// endif add_bottle	

if ( !isset($wineid) ){
	echo "<h2>Parameter Error!</h2>";
	exit;
}

// Header Query
$sql = "
	SELECT wineid, vineyard, label, varietal, vintage
	FROM tblWineList
	WHERE wineid = ".$wineid;
$rsWine = run_query($sql);

// Detail Query
$sql = "
	SELECT bottleid, tblBottles.storageid, storageDescription, binX, binY, depth, 
		tblBottles.created_date
	FROM tblBottles INNER JOIN tblStorage
	ON tblBottles.storageid = tblStorage.storageid
	WHERE tblBottles.wineid = ".$wineid."
	AND consumed = 0";
$rsBottles = run_query($sql);

// Storage Lookup
$sql = "
	SELECT storageid, storageDescription
	FROM tblStorage";
$rsStorage = run_query($sql);
?>


