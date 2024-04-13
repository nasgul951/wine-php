<?php
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/api/common.php";

    $wine->logout($x_api_key);
    echo 'OK';
    exit;
?>