<?php
namespace plugin\ces\model;
defined('IN_PLAY') || exit('Access Denied');
class user_info extends \model{
	public $tablemap = array(
		'user_info'=>array('uid','uname','pwd','rand','type','face','ip','regtime','lasttime','email')
	);
	function beginning(){
		//echo $this->thistable;
	}
	public function getUserByUid($uid){
		return $this->find($uid);
	}
	
	
	
	
}


?>