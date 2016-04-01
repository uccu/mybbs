<?php
namespace base;
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}

class init{
	function __construct(){
		global $_G;
		require PLAY_ROOT.'/source/config/config.php';
		$_G['config'] = $config;
		define('IS_AJAX',$_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest" ?1:0);
		$this->_init_input();
	}
	private function _init_input(){
		global $_G;
		$p=floor($_REQUEST['page']);
		$_G['page']=$p>0&&$p<101?$p:1;
		$_G['maxpage']=$_G['maxrow']=1;
		if(!preg_match('/^[a-z0-9_]+$/i',$_REQUEST['plugin']) || !$_G['plugin']=$_REQUEST['plugin']){
			header('Location: 404.html');
		}
		if(!preg_match('/^[a-z0-9_]+$/i',$_REQUEST['control']) || !$_G['control'] = $_REQUEST['control']){
			header('Location: 404.html');
		}
		$_G['folder'] = $_REQUEST['folder'];
		if($_G['folder'] && !preg_match('/^[a-z0-9_]+$/i',$_REQUEST['folder'])){
			header('Location: 404.html');
		}
		$_G['template']['baseurl']=$_G['config']['BASE_URL'];
		if(!$c = control()){
			if($file = template(false))include $file;
			else header('Location: 404.html');
		}else{
			if($method = $_REQUEST['method']){
				if(!method_exists($c,$method) || preg_match('/^[^a-z]$/i',$method[0]))header('Location: 404.html');
				if(!$getter = $_REQUEST['getter'])$getter = array();
				else $getter = explode($_G['config']['GETTER_SEPARATOR'],$getter);
				call_user_func_array(array($c,$method),$getter);
			}
		}
		
	}
	
}

?>