<?php
namespace base;
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}

class init{
    private $config;
	function __construct(){
		require PLAY_ROOT.'/source/config/config.php';
        $this->config = table('config');
		$this->config->config = $config;
		define('IS_AJAX',$_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest" ?1:0);
		$this->_init_input();
	}
	private function _init_input(){
		$p=floor($_REQUEST['page']);
		$this->config->page=$p>0&&$p<101?$p:1;
		$this->config->maxpage=$this->config->maxrow=1;
		if(!preg_match('/^[a-z0-9_]+$/i',$_REQUEST['plugin']) || !$this->config->plugin=$_REQUEST['plugin']){
			header('Location: /404.html');
		}
		if(!preg_match('/^[a-z0-9_]+$/i',$_REQUEST['control']) || !$this->config->control = $_REQUEST['control']){
			header('Location: /404.html');
		}
		$this->config->folder = $_REQUEST['folder'];
		if($this->config->folder && !preg_match('/^[a-z0-9_]+$/i',$_REQUEST['folder'])){
			header('Location: /404.html');
		}
		$this->config->template['baseurl']=$this->config->config['BASE_URL'];
		if(!$c = control()){
            
			if($file = template(false))include $file;
            else{var_dump($c);die();}
			//else header('Location: /404.html');
		}else{
			if($this->config->method = $_REQUEST['method']){
				if(!method_exists($c,$this->config->method) || preg_match('/^[^a-z]$/i',$this->config->method[0]))header('Location: /404.html');
                $getter = $_REQUEST['getter'];
				if(!strlen($getter))$getter = array();
				else $getter = explode($this->config->config['GETTER_SEPARATOR'],$getter);
				call_user_func_array(array($c,$this->config->method),$getter);
			}
		}
		
	}
	
}

?>