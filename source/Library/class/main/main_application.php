<?php
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}

class main_application{
	static function &instance(){
		static $object;
		if(empty($object)) {
			$object = new self();
		}
		return $object;
	}

	public function __construct(){
		global $_G;
		//数据库连接
		define('IS_AJAX',$_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest" ?1:0);
		$this->_init_mysql();
		//预加载插件列表
		$_G['cache']['preloadlist']=json_decode(main_cache::get('preloadlist'));
		foreach($_G['cache']['preloadlist'] as $p)table($p)->preload();
		//获取数据预过滤
		$this->_init_input();
		//获取缓存ID
		$_G['cache']['id']=main_cache::get('cacheid');
	}
	private function _init_mysql(){
		mysql_database::init();
	}
	public function toarr($e){
		if(is_array($e)){
			$lis=array();
			foreach($e as $b){
				if(!is_array($b))$lis['mod']=$this->toarr($b);
				elseif(isset($b[0]) && isset($b[1])){
					if($b[0]=='sname')$b[1]=$lis[$b[0]]=str_ireplace(array('_'),array(' '),$b[1]);
					$lis[$b[0]]=$this->toarr($b[1]);
				}
			}
			return $lis;
		}else return M::t2c(str_ireplace(array('&222;','&333;','<','>','"',"'",'\\'),array('(',')','&lt;','&gt;','&quot;','&#39;','\\\\'),$e));
	}
	private function _init_input(){
		global $_G;
		foreach($_POST as &$v)$v=$this->toarr($v);
		foreach($_GET as &$v)$v=$this->toarr($v);
		$_REQUEST=array_merge($_GET,$_POST);
		$p=floor($_REQUEST['page']);
		$_G['page']=$p>0&&$p<101?$p:1;
		$_G['maxpage']=$_G['maxrow']=1;
		$_G['plugin']=$_REQUEST['plugin']?$_REQUEST['plugin']:'index';
		$_G['mod']=$_REQUEST['mod']?$_REQUEST['mod']:'index';
		if(!in_array($_G['mod'],table($_G['plugin'])->ModList))throw new Exception('MOD is not correct!');
		$_G['template']['baseurl']='http://4moe.com/';
		
		
	}
	
}

?>