<?php
	header("Access-Control-Allow-Orgin: *");
	header("Access-Control-Allow-Methods: *");

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