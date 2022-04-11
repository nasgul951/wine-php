<?php
function getProto() {
   return strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://';
}
$proto = getProto();
$host = $_SERVER['HTTP_HOST'];
header( 'Location: '.$proto.$host.'/security/login.php' );
?>
