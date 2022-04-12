<?php
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
	require "$root/config.php";
	require "$root/include/wine.php";
	   
	if (isset($_SERVER['HTTP_ORIGIN'])) {
		header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
		header('Access-Control-Allow-Credentials: true');
		header('Access-Control-Max-Age: 86400');    // cache for 1 day
	}

   $method = $_SERVER['REQUEST_METHOD'];
	if (strtoupper($method) == 'OPTIONS') {
		
		if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
			header("Access-Control-Allow-Methods: POST, OPTIONS");
		
		if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
			header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

		exit(0);
	}

   if (strtoupper($method) == 'POST') {
      $body = file_get_contents('php://input');
      $auth = json_decode($body, true);

      if ($auth['password'] != $user_pass) {
         header('HTTP/1.1 403', 'forbidden');
         echo 'Not Authorized';
         exit;
      }

      $response = json_encode(['token' => $api_key]);
		header('Content-type: application/json');
		echo $response;
      exit;
   }

   header('HTTP/1.1 400', 'bad request');
   echo 'Bad Request '.$method;
   exit;
?>
