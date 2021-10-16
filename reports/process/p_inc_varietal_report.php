<?php include("../include/data.php");
$sql = "
	SELECT varietal, vintage, COUNT(1) AS bottle_count
	FROM tblWineList INNER JOIN tblBottles
	ON tblWineList.wineid = tblBottles.wineid
	WHERE consumed = 0
	AND storageid = 1
	GROUP BY varietal, vintage
	ORDER BY varietal, vintage";
	
$rsVarietal = run_query($sql);
?>