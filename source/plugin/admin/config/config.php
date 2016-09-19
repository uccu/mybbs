<?php
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}
$config=array(
	'BASE_URL'=>('http://'.$_SERVER['SERVER_NAME'].($_SERVER['SERVER_PORT']==80?'':':'.$_SERVER['SERVER_PORT']).'/' ).'admin/',
    'LOGIN_SALT'=>'ffewekFamdojga4owied7',
	
);
?>