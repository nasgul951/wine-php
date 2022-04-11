<?php
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
	require "$root/config.php";
	require "$root/include/wine.php";
   require "$root/api/common.php";
	   
   function handle_get($wine) {
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
   }

   function handle_put($wine) {
      try {
         $body = file_Get_contents("php://input");
         $o = json_decode($body, true);
         if (!is_array($o)) {
            throw new Exception('Failed to decode json body');
         }

         $result = $wine->addWine($o);
         respond(true, 'Added new wine', $result);
      } catch (Exception $ex) {
         respond(false, $ex->getMessage(), []);
      }
   }

   $wine = new Wine($db_server, $db_name, $db_user, $db_password);
   switch($_SERVER['REQUEST_METHOD']) {
      case "GET":
         handle_get($wine);
         break;
      case "PUT":
         handle_put($wine);
         break;
      default:
         header('HTTP/1.1 400', 'bad request');
         echo 'Unhandled method';
         break;
   }
?>
