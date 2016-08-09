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
		define('PLUGIN_NAME',$_GET['plugin']);$this->g->plugin = PLUGIN_NAME;
		define('PLUGIN_DIR',PLUGIN_ROOT.PLUGIN_NAME.'/');
		define('CONTROL_NAME',$_GET['control']);$this->g->control = CONTROL_NAME;
		define('METHOD_NAME',$_GET['method']);$this->g->method = METHOD_NAME;
		if(!PLUGIN_NAME || !preg_match('/^[a-z][a-z0-9_]+$/i',PLUGIN_NAME))header('Location: /404.html');
		

		
		if(!CONTROL_NAME || !preg_match('/^[a-z][a-z0-9_]+$/i',CONTROL_NAME))header('Location: /404.html');

		
		if(file_exists(PLUGIN_ROOT.PLUGIN_NAME.'/config/config.php')){
			require PLUGIN_ROOT.PLUGIN_NAME.'/config/config.php';
			if($config)$this->g->config = array_merge($this->g->config,$config);
		}
		
		$this->g->template['baseurl'] = $this->g->config['BASE_URL'];
        
		if(!$c = control()){
			if($file = template(false)){
				$g=(array)$this->g;foreach($g['template'] as $k=>$v)$$k = $v;include $file;
			}
            //else{var_dump($c);die();}
			else header('Location: /404.html');
		}else{
			if(isset($this->g->config['prefix']))if($cache = model('cache'))$this->g->template['cacheid'] = $cache->get('cacheid');
			if(METHOD_NAME){
				if(!method_exists($c,METHOD_NAME) || preg_match('/^[^a-z]$/i',$this->g->method[0]))header('Location: /404.html');
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