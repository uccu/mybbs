<?php
namespace plugin\test\model;
defined('IN_PLAY') || exit('Access Denied');
class test extends \model{
	protected $tablemap = array(
		'test'=>array('id','name')
	
	);
	function beginning(){
		echo $this->thistable;
	}
	
	
	
	
}


?>