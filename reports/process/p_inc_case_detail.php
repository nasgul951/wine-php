<?php include("../include/data.php");
// bottle list record source, by case_no (depth)
	if ( !isset($_POST["case_no"]) )
		$case_no = -1; else $case_no = $_POST["case_no"];
		
	$sql = "
	SELECT tblWineList.wineid, vineyard, label, varietal, vintage, depth, count(bottleid) AS mCount
	FROM tblWineList INNER JOIN tblBottles
	ON tblWineList.wineid = tblBottles.wineid
	WHERE consumed = 0
	AND storageid = 3
	AND depth = ".$case_no."
	GROUP BY vineyard, label, varietal, vintage, depth
	ORDER BY depth, vineyard, varietal, vintage";
	$rsList = run_query($sql);
?>