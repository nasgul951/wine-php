<?php
	include("../include/data.php");

	if ( !isset($_GET["key"]) )
	{
		header('HTTP/1.1 500', 'internal error');
		echo 'Invalid Request!';
		return;
	}
	
	$key = $_GET["key"];
	if ($key != 'PTW2szQgtylnQaG') {
		header('HTTP/1.1 403', 'forbidden');
		echo 'Invalid Key!';
		return;
	}
	
	if ( isset($_GET["varietal"]) )
	{
		$varietal = $_GET["varietal"];
		
		$sql = "
		SELECT tblWineList.wineid, vineyard, label, vintage, count(1) as count
		FROM tblWineList INNER JOIN tblBottles
		ON tblWineList.wineid = tblBottles.wineid
		WHERE consumed = 0
		AND varietal = '".$varietal."'
		GROUP BY vineyard, label, vintage";
		
		$rs = run_query($sql);
		$rows = toResultArray($rs, "row");
		$json = json_encode(array('result'=>$rows));
	}
	else if ( isset($_GET["wineid"]) )
	{
		$wineid = $_GET["wineid"];
		
		// Get Wine data
		$sql = "
		SELECT varietal, vineyard, label, vintage, notes
		FROM tblWineList 
		WHERE wineid = ".$wineid;
		
		$rs = run_query($sql);
		$rows = toResultArray($rs, "row");
		
		$sql = "
		SELECT storageDescription, binX, binY, depth
		FROM tblBottles b INNER JOIN tblStorage s
		ON b.storageid = s.storageid
		WHERE consumed = 0
		AND wineid = ".$wineid;
		
		$rs = run_query($sql);
		$bottles = toResultArray($rs, "bottle");

		$json = json_encode(array('rows'=>$rows, 'bottles'=>$bottles));
		
	}
	else
	{
		// DEFAULT: Retun Varietal list
		$sql = "
		SELECT varietal, count(1)
		FROM tblWineList INNER JOIN tblBottles
		ON tblWineList.wineid = tblBottles.wineid
		WHERE consumed = 0
		GROUP BY varietal";
		
		$rs = run_query($sql);
		$rows = toResultArray($rs, "row");
		$json = json_encode(array('result'=>$rows));
	}

	function toResultArray($resultSet, $index) {
		$result = array();
		while( $row = $resultSet->fetch_assoc() ){
			$result[] = array($index=>$row);
		}
		return $result;
	}

	header('Content-type: application/json');
	echo $json;	
?>
