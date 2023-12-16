<?php
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/api/common.php";

    $response = json_encode($currentUser);
    header('Content-type: application/json');
    echo $response;
    exit;
?>