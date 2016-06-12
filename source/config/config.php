<?php
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}
$config=array(
	'GETTER_SEPARATOR'=>'/',
	'BASE_URL'=>'http://'.$_SERVER['HTTP_HOST'].'/', 
    'HOST'=>$_SERVER['HTTP_HOST'], 
    'LOGIN_SALT'=>'gtisdsds',
	'LIMIT_SORT_LEN'=>2,
	'CHECK_IP'=>1,
	'TIMEZONE'=>'PRC',
	'CHECK_AJAX'=>0,
	'AJAX_JSON_HEADER'=>1,
	'DEBUG'=>1,
);
?>