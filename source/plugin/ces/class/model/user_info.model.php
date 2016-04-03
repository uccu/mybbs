<?php
namespace plugin\ces\model;
defined('IN_PLAY') || exit('Access Denied');
class user_info extends \model{
	protected $tableMap = array(
		'user_info'=>array(
            'uid',
            'uname',
            'pwd',
            'salt',
            'type',
            'face',
            'ip',
            'regtime',
            'lasttime',
            'email'
        ),
	);
	function _beginning(){
		
	}
	public function get_user($uid){
		return $this->find($uid);
	}
	public function insert_user($data){
		return $this->data($data)->add();
	}
    public function select_user_list($where,$order='',$limit='',$field=''){
		return $this->field($field)->where($where)->order($order)->limit($limit)->select();
	}
	public function update_user($data,$where){
		return $this-data($data)->where($where)->save(is_int($where)||is_string($where)?$where:false);
	}
	
	
}


?>