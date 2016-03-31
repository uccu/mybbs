<?php
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}
class main_plugin extends main_base{
	public function getUsingTable(){
		return false;
	}
	public function getInheritPlugin(){
		return false;
	}
	public function getInheritFunction(){
		return false;
	}
	
	
}

?>