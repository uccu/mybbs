<?php
namespace plugin\ces\model;
defined('IN_PLAY') || exit('Access Denied');
class user_info extends \model{
	protected $tableMap = array(
		'user_info'=>array('uid','uname','pwd','rand','type','face','ip','regtime','lasttime','email'),
	);
	function beginning(){
		
	}
	public function getUserByUid($uid){
		return $this->find($uid);
	}
	public function insertUser($data=array()){
		return $this->data($data)->sql()->add();
		
	}
	
	
	
}


?>