<?php
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
	require "$root/config.php";
	require "$root/include/wine.php";
	   
   $method = $_SERVER['REQUEST_METHOD'];
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
