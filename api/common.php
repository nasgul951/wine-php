<?php
	// CORS: Allow from any origin
	if (isset($_SERVER['HTTP_ORIGIN'])) {
		header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
		header('Access-Control-Allow-Credentials: true');
		header('Access-Control-Max-Age: 86400');    // cache for 1 day
	}

	// Access-Control headers are received during OPTIONS requests
	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
		
		if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
			// may also be using PUT, PATCH, HEAD etc
			header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
		
		if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
			header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

		exit(0);
	}

	$headers = apache_request_headers();
	if ( !isset($headers["x-api-key"]) )
	{
		header('HTTP/1.1 400', 'bad request');
		echo 'Missing Authorization';
		exit;
	}
	
	$key = $headers["x-api-key"];
	if ($key != $api_key) {
		header('HTTP/1.1 403', 'forbidden');
		echo 'Not Authorized';
		exit;
	}

	function respond ($success, $msg, $data) {
		$json = json_encode([
			"success" => $success,
			"message" => $msg,
			"data" => $data
		]);
	
		header('Content-type: application/json');
		echo $json;	
	}
?>