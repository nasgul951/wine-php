<?php
	session_start();
	if ( !isset($_SESSION["login"]) ){
		echo "<h2>Session not set</h2>";
		exit;
	}else {
		if ( $_SESSION["login"] != 1 ) {
			echo "<h2>Session has expired.</h2>" . $_SESSION["login"];
			exit;
		}
	}
?>
