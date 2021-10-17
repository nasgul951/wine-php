<?php
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
	include "$root/config.php";
	
	// Setup database connection.
	$mysqli = new mysqli($db_server, $db_user, $db_password, $db_name);
	/* check connection */
	if ($mysqli->connect_errno) {
		echo "DB Connection Error " . $mysqli->connect_error;
		exit;
	}

	function run_update( $sql ){
		global $mysqli;
		$result = $mysqli->query($sql);
		if ( !$result ){
			echo $mysqli->error . "<br>" . $sql;
			exit;
		}
	}
	function run_query( $sql ){
		global $mysqli;
		$result = $mysqli->query($sql);
		if ( !$result ){
			echo $mysqli->error . "<br>" . $sql;
			exit;
		}
		return $result;
	}
	function get_row( $rs ){
		return $rs->fetch_assoc();
	}
	function goto_row( $rs, $row_ix ){
		return $rs->data_seek($row_ix);
	}
?>

