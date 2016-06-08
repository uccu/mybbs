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
		$this->config->config['ip'] = $_SERVER["HTTP_CF_CONNECTING_IP"]?$_SERVER["HTTP_CF_CONNECTING_IP"]:
		($_SERVER["HTTP_X_FORWARDED_FOR"]?$_SERVER["HTTP_X_FORWARDED_FOR"]:$_SERVER["REMOTE_ADDR"]);
		date_default_timezone_set($this->config->config['TIMEZONE']);
		define('IS_AJAX',$_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest" ?1:0);
		$this->_init_input();
	}
	private function _init_input(){
		$tran = control('tool:tran','format');
		if($_POST)$_POST = $tran->t2c(str_ireplace(array('<','>','"',"'",'\\'),array('&lt;','&gt;','&quot;','&#39;','/'),$_POST));
		$p=floor($_REQUEST['page']);
		$this->config->page=$p>0&&$p<101?$p:1;
		$this->config->maxpage=$this->config->maxrow=1;
		if(!preg_match('/^[a-z][a-z0-9_]+$/i',$_REQUEST['plugin']) || !$this->config->plugin=$_REQUEST['plugin']){
			header('Location: /404.html');
		}
		define('PLUGIN_NAME',$this->config->plugin);
		if(!preg_match('/^[a-z][a-z0-9_]+$/i',$_REQUEST['control']) || !$this->config->control = $_REQUEST['control']){
			header('Location: /404.html');
		}
		define('CONTROL_NAME',$this->config->control);
		if(file_exists(PLUGIN_ROOT.'/'.$this->config->plugin.'/config/config.php')){
			require PLUGIN_ROOT.$this->config->plugin.'/config/config.php';
			if($config)$this->config->config = array_merge($this->config->config,$config);
		}
		$this->config->template['baseurl'] = $this->config->config['BASE_URL'];
        $this->config->template['cacheid'] = model('cache')->get('cacheid');
		if(!$c = control()){
            
			if($file = template(false)){
				$g=(array)$this->config;include $file;
			}
            //else{var_dump($c);die();}
			else header('Location: /404.html');
		}else{
			if($this->config->method = $_REQUEST['method']){
				if(!method_exists($c,$this->config->method) || preg_match('/^[^a-z]$/i',$this->config->method[0]))header('Location: /404.html');
                define('METHOD_NAME',$this->config->method);
				$getter = $_REQUEST['getter'];
				if(!strlen($getter))$getter = array();
				else $getter = explode($this->config->config['GETTER_SEPARATOR'],$tran->t2c(str_ireplace(array('<','>','"',"'",'\\'),array('&lt;','&gt;','&quot;','&#39;','/'),$getter)));
				call_user_func_array(array($c,$this->config->method),$getter);
			}else{
                if(method_exists($c,'_nomethod'))$c->_nomethod();
            }
		}
		
	}
	
}

?>