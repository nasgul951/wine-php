<?php include("../include/data.php");
	// Setup database connection.
	$db_server = "nova.hornetsnest.us";
	$con = mysql_connect($db_server, "CF", "cfServer1923");
	if ( !con ) {
		echo $mysqli->error;
		exit;
	}
	if ( !mysql_select_db("wine") ) {
		echo $mysqli->error;
		exit;
	}
	
	// Determin sort parameters
	$sort_by = "vineyard, varietal, vintage";	// default
	if ( isset($_POST["sort_by"]) ){
		switch ( $_POST["sort_by"] ){
			case "vineyard":
				$sort_by = "vineyard, varietal, vintage";
				break;
			case "label":
				$sort_by = "label, varietal, vintage";
				break;
			case "varietal":
				$sort_by = "varietal, vineyard, vintage";
				break;
			case "vintage":
				$sort_by = "vintage, vineyard, varietal";
				break;
		}// end switch
	}// end if
	
	$sql = " 	
	SELECT tblWineList.wineid, vineyard, label, varietal, vintage, count(bottleid) AS mCount, tblWineList.created_date
	FROM tblWineList INNER JOIN tblBottles
	ON tblWineList.wineid = tblBottles.wineid
	WHERE consumed = 0
	GROUP BY wineid
	ORDER BY " . $sort_by;
	$rsList = mysql_query($sql);
	if ( !$rsList ) {
		echo $mysqli->error . "<br>" . $sql;
		exit;
	}
	
	$sql = "SELECT count(1) AS ttlBottles FROM tblBottles WHERE consumed = 0";
	$rsTotal = run_query($sql);
	$rowTotal = get_row($rsTotal);
?>
