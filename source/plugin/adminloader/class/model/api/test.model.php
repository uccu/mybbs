<?php
namespace plugin\test\model\api;
defined('IN_PLAY') || exit('Access Denied');
class test{
	
	function start(){
		var_dump(model('test')->find(1));
	}
	
	
	
	
}


?>