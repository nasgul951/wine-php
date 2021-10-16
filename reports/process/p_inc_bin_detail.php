<?php include("../include/data.php");
	if ( !isset($_POST["bin_x"]) )
		$bin_x = -1; else $bin_x = $_POST["bin_x"];
	if ( !isset($_POST["bin_y"]) )
		$bin_y = -1; else $bin_y = $_POST["bin_y"];
		
	$sql = "
	SELECT tblWineList.wineid, vineyard, label, varietal, vintage, depth, count(bottleid) AS mCount
	FROM tblWineList INNER JOIN tblBottles
	ON tblWineList.wineid = tblBottles.wineid
	WHERE consumed = 0
	AND storageid = 1
	AND binX = ".$bin_x."
	AND binY = ".$bin_y."
	GROUP BY tblWineList.wineid, vineyard, label, varietal, vintage, depth
	ORDER BY depth, vineyard, varietal, vintage";
	$rsList = run_query($sql);
?>