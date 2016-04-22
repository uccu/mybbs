<?php
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}
class control {
    function __construct(){
        table('config')->loadtimeset[__CLASS__]=microtime(get_as_float);
        if(method_exists($this,'_beginning'))call_user_func_array(array($this,'_beginning'),func_get_args());
    }
	function __call($name,$args) {
		return null;
	}
    function __get($name) {
        $sname = '_get_'.$name;
	    $this->$name = $this->$sname();
        return $this->$name;
	}
	
}


?>