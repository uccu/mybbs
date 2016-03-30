<?php
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}
abstract class abstract_args{
	function __call($name,$args) {
		$getter = $this->args_prefix().$name;
		if(method_exists($this,$getter))
			//return call_user_func_array(array($this,$getter),$args);
			return $this->$getter($args);
		else throw new Exception('The method "'.get_class($this).'->'.$name.'" is not defined');	
	}
	abstract protected function args_prefix();
}
?>