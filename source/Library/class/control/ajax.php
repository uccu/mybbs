<?php
namespace control;
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}
class ajax extends \control{
	function __construct(){
		if(!IS_AJAX)$this->error('not ajax');
		if(method_exists($this,'_beginning'))call_user_func_array(array($this,'_beginning'),func_get_args());
	}
    function __get($name) {
        $sname = '_get_'.$name;
	    $this->$name = $this->$sname();
        return $this->$name;
	}
    
}


?>