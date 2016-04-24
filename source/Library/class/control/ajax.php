<?php
namespace control;
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}
class ajax extends \control{
	function __construct(){
		call_user_func_array(array(parent,'__construct'),func_get_args());
	}
    protected function success($object,$url='') {
		return $this->_out($object,$url,1);
	}
	protected function error($object,$url='') {
		return $this->_out($object,$url,0);
	}
	private function _out($object,$url='',$code=1) {
		$data['data'] = $object;
		$data['url'] = $url;
		$data['code'] = $code;
		echo json_encode($data);
		die();
	}
    
}


?>