<?php
namespace control;
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}
class ajax extends \control{
	protected $checkAJAX = 1;
	function __construct(){
		call_user_func_array(array(parent,'__construct'),func_get_args());
		if($this->g->config['CHECK_AJAX'])if(!IS_AJAX)$this->error('not ajax');
	}
    protected function success($object,$url='') {
		return $this->_out($object,$url,200);
	}
	protected function error($code,$object,$url='') {
		return $this->_out($object,$url,$code);
	}
	private function _out($object,$url='',$code=1) {
		$data['data'] = $object;
		$data['url'] = $url;
		$data['code'] = $code;
		if($this->g->config['AJAX_JSON_HEADER'])header('Content-Type:application/json; charset=utf-8');
		echo json_encode($data);
		die();
	}
    
}


?>