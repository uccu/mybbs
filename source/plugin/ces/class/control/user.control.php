<?php
namespace plugin\ces\control;
defined('IN_PLAY') || exit('Access Denied');
class user extends \control{
	

	function getUser($uid=0){
		$info = model('user_info','api')->getUserByUid($uid);
		var_dump($info);
	}
	
	
	
}


?>