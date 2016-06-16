<?php
namespace base;
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}
class init{
    private $g;
	function __construct(){
		require PLAY_ROOT.'/source/config/config.php';
        $this->g = table('config');
		$this->g->config = $config;
		$this->g->ip = $_SERVER["HTTP_CF_CONNECTING_IP"]?$_SERVER["HTTP_CF_CONNECTING_IP"]:
		($_SERVER["HTTP_X_FORWARDED_FOR"]?$_SERVER["HTTP_X_FORWARDED_FOR"]:$_SERVER["REMOTE_ADDR"]);
		date_default_timezone_set($this->g->config['TIMEZONE']);
		define('IS_AJAX',$_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest" ?1:0);
		$this->_init_input();
	}
	private function _init_input(){
		if($_POST){
			$_POST = str_ireplace(array('<','>','"',"'"),array('&lt;','&gt;','&quot;','&#39;'),$_POST);
			if($tran = control('tool:tran','format'))$_POST = $tran->t2c($_POST);
		}

		if(!preg_match('/^[a-z][a-z0-9_]+$/i',$_REQUEST['plugin']) || !$this->g->plugin=$_REQUEST['plugin']){
			header('Location: /404.html');
		}
		define('PLUGIN_NAME',$this->g->plugin);
		if(!preg_match('/^[a-z][a-z0-9_]+$/i',$_REQUEST['control']) || !$this->g->control = $_REQUEST['control']){
			header('Location: /404.html');
		}
		define('CONTROL_NAME',$this->g->control);
		if(file_exists(PLUGIN_ROOT.'/'.$this->g->plugin.'/config/config.php')){
			require PLUGIN_ROOT.$this->g->plugin.'/config/config.php';
			if($config)$this->g->config = array_merge($this->g->config,$config);
		}
		$this->g->template['baseurl'] = $this->g->config['BASE_URL'];
        $this->g->template['cacheid'] = model('cache')->get('cacheid');
		if(!$c = control()){
            
			if($file = template(false)){
				$g=(array)$this->g;include $file;
			}
            //else{var_dump($c);die();}
			else header('Location: /404.html');
		}else{
			if($this->g->method = $_REQUEST['method']){
				if(!method_exists($c,$this->g->method) || preg_match('/^[^a-z]$/i',$this->g->method[0]))header('Location: /404.html');
                define('METHOD_NAME',$this->g->method);
				$getter = $_REQUEST['getter'];
				if(!strlen($getter))$getter = array();
				else $getter = explode($this->g->config['GETTER_SEPARATOR'],str_ireplace(array('<','>','"',"'",'\\'),array('&lt;','&gt;','&quot;','&#39;','/'),$getter));
				call_user_func_array(array($c,$this->g->method),$getter);
			}else{
                if(method_exists($c,'_nomethod'))$c->_nomethod();
            }
		}
		
	}
	
}

?>