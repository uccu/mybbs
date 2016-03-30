<?php
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}
class plugin_global extends main_plugin{
	public function getUsingTable(){
		return array();
	}
	public function getInheritPlugin(){
		return false;
	}
	public function getInheritFunction(){
		return false;
	}
	public function getModList(){
		return array('index');
	}
	
	
}

?>