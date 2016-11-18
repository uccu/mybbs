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
define('SHOW_ERROR',1);
define('TIMESTAT',1);

$_GET['plugin']='app';
$_GET['control']='inquiry';


require('source/Library/class/core.php');

control('inquiry')->_auto();
   
   
   
 
  if(extension_loaded('zlib')){
    ob_end_flush();
  }
?>






