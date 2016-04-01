<?php
namespace plugin\ces\model\api;
defined('IN_PLAY') || exit('Access Denied');
class user_info{
	public function getUserByUid($uid){
		return model('user_info')->getUserByUid($uid);
	}
	
	
	
	
}


?>