<?php
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
   require "$root/api/common.php";
		

    function handle_get($wine) {
      if ( !isset($_GET["wineid"]) )
      {
         header('HTTP/1.1 400', 'bad request');
         echo 'Bad Request';
         return;
      }

      $wineid = $_GET["wineid"];

      try {
         $result = $wine->getBottles($wineid);
         respond(true, "OK", $result);
      } catch (Exception $ex) {
         respond(false, $ex->getMessage(), []);
      }		
    }

    function handle_put($wine) {
      try {
         $o = decodeBody();
         $result = $wine->addBottle($o);
         respond(true, 'Added new bottle', $result);
      } catch (Exception $ex) {
         respond(false, $ex->getMessage(), []);
      }
   }

   function handle_patch($wine) {
      try {
         $o = decodeBody();
         $result = $wine->updateBottle($o);
         respond(true, 'Updated bottle', $result);
      } catch (Exception $ex) {
         respond(false, $ex->getMessage(), []);
      }
   }

   switch($_SERVER['REQUEST_METHOD']) {
      case "GET":
         handle_get($wine);
         break;
      case "PUT":
         handle_put($wine);
         break;
      case "PATCH":
         handle_patch($wine);
         break;
      default:
         header('HTTP/1.1 400', 'bad request');
         echo 'Unhandled method';
         break;
   }

?>
