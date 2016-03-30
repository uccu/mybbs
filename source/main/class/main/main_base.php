<?php
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}
class main_base{
	
	
	public function __get($name) {
		if(isset($this->$name))return $this->$name;
		$getter='get'.$name;
		if(method_exists($this,$getter)){
			return $this->$name=$this->$getter();
		} else {
			throw new Exception('The property "'.get_class($this).'->'.$name.'" is not defined');
		}
	}
	
	
	
	
	
	
	
}

?>