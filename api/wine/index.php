<?php
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
	require "$root/config.php";
	require "$root/include/wine.php";
    require "$root/api/common.php";
	
	$wine = new Wine($db_server, $db_name, $db_user, $db_password);
	try {
		if ( isset($_GET["varietal"]) )
		{
			$varietal = $_GET["varietal"];
			$result = $wine->allWineByVarietal($varietal);
		}
		else if ( isset($_GET["vineyard"]) ){
			$vineyard = $_GET["vineyard"];
			$result = $wine->allWineByVineyard($vineyard);
		}
		else{
			$result = $wine->allWine();
		}
		respond(true, "OK", $result);
	} catch (Exception $ex) {
		respond(false, $ex->getMessage(), []);
	}
?>
