<?php
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}
$config=array(
	'GETTER_SEPARATOR'=>'/',
	'BASE_URL'=>'http://www.example.com/',
    'HOST'=>'www.example.coma',
    'LOGIN_SALT'=>'SALT',
	'LIMIT_SORT_LEN'=>2,
	'CHECK_IP'=>0,
	'TIMEZONE'=>'PRC',
	'CHECK_AJAX'=>0,
	'AJAX_JSON_HEADER'=>1
);
?>