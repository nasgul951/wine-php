<?php
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
   require "$root/api/common.php";
	   
   function handle_get($wine) {
      try {
         $storeId = 1; //default
         if ( isset($_GET["id"]) )
         {
            $storeId = $_GET["id"];
         }

         if ( isset($_GET["binid"]) ){
            $binId = (int)$_GET["binid"];
            $result = $wine->getBottlesByBin($binId);
         } else {
            $result = $wine->getByStore($storeId);
         }
         respond(true, "OK", $result);
      } catch (Exception $ex) {
         respond(false, $ex->getMessage(), []);
      }
   }

   switch($_SERVER['REQUEST_METHOD']) {
      case "GET":
         handle_get($wine);
         break;
      default:
         header('HTTP/1.1 400', 'bad request');
         echo 'Unhandled method';
         break;
   }
?>
