<?php
 if(extension_loaded('zlib')){
    ob_start('ob_gzhandler');
  }
  header ("content-type: text/html; charset=utf-8");
  ob_start("compress");
  
function compress($buffer) {
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	return $buffer;
}
if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']){
    $fe = preg_replace('#(http://.+?)(/.*|$)#','$1',$_SERVER['HTTP_REFERER']);
    header("Access-Control-Allow-Credentials: true");
    header('Access-Control-Allow-Origin: '.$fe);
}
define('SHOW_ERROR',1);
define('TIMESTAT',1);
require('source/Library/class/core.php');


   
   
   
   
 
  if(extension_loaded('zlib')){
    ob_end_flush();
  }
?>






