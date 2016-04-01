<?php
namespace model;
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}
class base{
	function __call($name,$args) {
		if(!method_exists($this,$name))
			throw new \Exception('The method "'.get_class($this).'::'.$name.'()" is not defined');	
	}
}
?>