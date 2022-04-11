<?php
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
	require "$root/config.php";

   if ( $_POST["login"] != NULL ){
		if ( $_POST["pwd"] == $user_pass ){
			session_start();
			$_SESSION["login"] = 1;
			header( 'Location: ../../main/winelist.php' );
			echo $_SESSION["login"]."<br>";
			//echo "<a href=\"../../main/Winelist.php\">menu</a>";
		}else{
			echo "<h2>Login Failure!</h2>";
			exit;
		}// end if auth
	}// end if
?>
