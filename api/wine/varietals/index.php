<?php
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/api/common.php";
	
	try {
		$result = $wine->varietals();
		//$rows = toResultArray($result, "row");
		respond(true, "OK", $result);
	} catch (Exception $ex) {
		respond(false, $ex->getMessage(), []);
	}
?>
