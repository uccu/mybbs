<?php
namespace plugin\ces\model\api;
defined('IN_PLAY') || exit('Access Denied');
class user_info{
	public function getUserByUid($uid){
		// model('user_info')->add_table(array(
		
			// 'email'=>array('eid'=>'id','_on'=>'email')
			
		// ));
		return model('user_info')->getUserByUid($uid);
	}
	public function insertUser(){
		 model('user_info')->auto(array('uid'=>false));
		//return model('user_info')->getUserByUid(1);
		$data['uid']=3;
		$data['uname']='baka';
		return model('ces:user_info')->insertUser($data);
	}
	
	
	
}


?>