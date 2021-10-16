<?php include("../include/data.php");
$sql = "
	SELECT depth, count(*) AS binCount
	FROM tblWineList INNER JOIN tblBottles
	ON tblWineList.wineid = tblBottles.wineid
	WHERE consumed = 0
	AND storageid = 3
	GROUP BY depth
	ORDER BY depth";
$rsWine = run_query($sql);
?>