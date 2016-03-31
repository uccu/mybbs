<?php
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}
class plugin_ajax extends main_plugin{
	function __construct(){
		global $_G;
		$method=$_REQUEST['method']?$_REQUEST['method']:false;
		$value=$_REQUEST['value']?$_REQUEST['value']:false;
		echo $method && method_exists($this,$method) ? $this->$method($value) : '';
		die();
	}
	protected function _forceOut($c=200,$d=0){
		if($c)$e['code']=$c;
		if($d)$e['data']=$d;
		echo json_encode($e);die();
	}
	protected function out($c=200,$d=0){
		if($c)$e['code']=$c;
		if($d)$e['data']=$d;
		return json_encode($e);
	}
	protected function test(){
		return $this->out(200,'good!');
	}
	protected function _posten($w,$t=false){
		if($_POST[$w])return $_POST[$w];
		else{
			if($t===false)$this->_forceOut(400,$w.' is not found!');
			else return $t;
		}
	}
}

?>