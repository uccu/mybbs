<?php
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}
$config=array(
	'GETTER_SEPARATOR'=>'/',
	'BASE_URL'=>'http://'.$_SERVER['SERVER_NAME'].($_SERVER['SERVER_PORT']==80?'':':'.$_SERVER['SERVER_PORT']).'/', 
    'HOST'=>$_SERVER['SERVER_NAME'], 
    'LOGIN_SALT'=>'gtisdsds',
	'LIMIT_SORT_LEN'=>2,
	'CHECK_IP'=>1,
	'TIMEZONE'=>'PRC',
	'CHECK_AJAX'=>0,
	'AJAX_JSON_HEADER'=>1,
	'DEBUG'=>1,
	'MODEL_DEBUG'=>0
);
?>