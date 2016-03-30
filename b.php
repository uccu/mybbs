<?php
 if(extension_loaded('zlib')){//检查服务器是否开启了zlib拓展
    ob_start('ob_gzhandler');
  }
  header ("content-type: text/html; charset=utf-8");//注意修改到你的编码
  header ("token: BAKA401");
  // header("HTTP/1.1 500 Internal server error"); 
  // die('修复数据表中。。预计几分钟到十几分钟');
  //header ("cache-control: must-revalidate");
  //$offset = 60;//css文件的距离现在的过期时间，这里设置为一天
  //$expire = "expires: " . gmdate ("D, d M Y H:i:s", time() + 60) . " GMT";
  //header ($expire);
  ob_start("compress");
  
function compress($buffer) {//去除文件中的注释
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	return $buffer;
}

define('SHOW_ERROR',1);
define('TIMESTAT',1);
require('source/main/class/class_core.php');
// table($_G['plugin'].'_'.$_G['mod']);
// include template($_G['plugin'].'/'.$_G['mod']);
model('static_baka');
   
   
   
   
 
  if(extension_loaded('zlib')){
    ob_end_flush();//输出buffer中的内容，即压缩后的css文件
  }
?>






