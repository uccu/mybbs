<?php
namespace plugin\tool\control;
defined('IN_PLAY') || exit('Access Denied');
class smtp extends \control\ajax{
	function _beginning(){

    }
    function _send(){
		call_user_func_array(array('\plugin\tool\control\smtp\smtp','send'),func_get_args());
		return true;
    }
	
}

?>