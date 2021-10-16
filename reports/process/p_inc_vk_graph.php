<?php include("../include/data.php");
$sql = "
	SELECT binY, binX, count(*) AS binCount
	FROM tblWineList INNER JOIN tblBottles
	ON tblWineList.wineid = tblBottles.wineid
	WHERE consumed = 0
	AND storageid = 1
	GROUP BY binY, binX
	ORDER BY binY, binX";
$rsWine = run_query($sql);
?>