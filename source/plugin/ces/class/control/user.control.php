<?php
namespace plugin\ces\control;
defined('IN_PLAY') || exit('Access Denied');
class user extends \control\ajax{
	

	function getUser($uid=0){
		$info = model('user_info','api')->getUserByUid($uid);
		var_dump($info);
	}
	function insertUser($uid=0){
		$info = model('user_info','api')->insertUser();
		var_dump($info);
	}
	
	
}


?>