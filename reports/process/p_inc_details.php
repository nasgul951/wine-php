<?php include("../include/data.php");
$varietal = $_GET["varietal"];
$vintage = $_GET["vintage"];
$sql = "
	SELECT tblWineList.wineid, vineyard, label, varietal, vintage, COUNT(1) AS bottle_count
	FROM tblWineList INNER JOIN tblBottles
	ON tblWineList.wineid = tblBottles.wineid
	WHERE consumed = 0
	AND storageid = 1
	AND varietal = '".$varietal."'
	AND vintage = '".$vintage."'
	GROUP BY tblWineList.wineid, vineyard, label, varietal, vintage
	ORDER BY vineyard, label";
$rsDetail = run_query($sql);
?>