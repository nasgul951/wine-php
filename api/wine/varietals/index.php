<?php
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
	require "$root/config.php";
	require "$root/include/wine.php";
    require "$root/api/common.php";
	
	$wine = new Wine($db_server, $db_name, $db_user, $db_password);
	try {
		$result = $wine->varietals();
		//$rows = toResultArray($result, "row");
		respond(true, "OK", $result);
	} catch (Exception $ex) {
		respond(false, $ex->getMessage(), []);
	}
?>
