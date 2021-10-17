<?php
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
	require "$root/config.php";
    require "$root/include/wine.php";
    require "$root/api/common.php";
		
	if ( !isset($_GET["wineid"]) )
	{
		header('HTTP/1.1 400', 'bad request');
		echo 'Bad Request';
		return;
	}

    $wine = new Wine($db_server, $db_name, $db_user, $db_password);
    
    $wineid = $_GET["wineid"];
    try {
        $result = $wine->getById($wineid);
        respond(true, "OK", $result);
    } catch (Exception $ex) {
        respond(false, $ex->getMessage(), []);

    }		
?>
