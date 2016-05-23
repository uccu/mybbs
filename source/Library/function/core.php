<?php
defined('IN_PLAY') || exit('Access Denied');
function dintval($int, $allowarray = false){
	$ret = intval($int);
	if($int == $ret || !$allowarray && is_array($int))return $ret;
	if($allowarray && is_array($int)) {
		foreach($int as &$v)$v=dintval($v,true);
		return $int;
	}elseif($int <= 0xffffffff){
		$l = strlen($int);
		$m = substr($int, 0, 1) == '-' ? 1 : 0;
		if(($l - $m) === strspn($int,'0987654321', $m))return $int;
	}
	return $ret;
}
function template($t=true,$f=true){
	$config = table('config');
	if(is_bool($t)){
		$f=$t;$t=$config->plugin.':'.($config->folder?$config->folder.'/':'').$config->control;
	}
	return template\base::load($t,$f);
	
}
function T($_t=true,$_f=true){
	$_t = template($_t,$_f);
    $g = (array)table('config');
	include $_t;
}
function table($t,$f='',$e='',$r=true){return C::t($t,$f,$e,$r);}
function control($t=false,$f=''){
	$config = table('config');
	if(!$t){
		$t = $config->plugin.':'.$config->control;$f=$config->folder;
	}
	//var_dump($t);die();
	return C::c($t,$f);
}
function model($m,$f=''){return C::m($m,$f);}
function cookie($name,$value=null,$expire='',$path='/',$domain=0){
    if($value!==null){
        if(!$domain){
            $config = table('config');
            $domain = '.'.$config->config['HOST'];
        }
        if(!is_int($expire))return strlen($_COOKIE[$name])?$_COOKIE[$name]:$value;
        return setcookie($name,$value,$expire?$expire+time():0,$path,$domain);
    }else{
        return $_COOKIE[$name];
    }
}
function post($s,$r='',$e=''){
	if(!isset($_POST[$s]))return $r;
    $f = $_POST[$s];
    if(is_array($e)){
        $f = call_user_func_array($e,array($f));
    }
    else switch($e){
		case '%d':
			$f = dintval($f);break;
		case '%f':
			$f = sprintf('%F', $f);break;
		case '%s':
			$f = unserialize($f);break;
		case '%b':
			$f = base64_decode($f);break;
		case '%j':
		    $f = json_decode($f);break;
		default:
			break;
	}
    if(is_string($f))return strlen($f)?$f:$r;
    else return $f;
}
function addcss($c=0,$f=0,$p=0,$e=true){
	$g = table('config');
	if(!$c)$c = $g->control;
	if(!$p)$p = $g->plugin;
    if(!$f)$f = $g->folder;
	$r = "<link rel=\"stylesheet\" type=\"text/css\" href=\"".dirname($g->template['baseurl'])."/source/plugin/".$p."/css/".($f?$f.'/':'').$c.".css?".$g->template['cacheid']."\">";
	if($e)echo $r;
	return $r;
}
function addjs($c=0,$f=0,$p=0,$e=true){
	$g = table('config');
	if(!$c)$c = $g->control;
	if(!$p)$p = $g->plugin;
    if(!$f)$f = $g->folder;
	$r = '<script src="'.dirname($g->template['baseurl'])."/source/plugin/".$p."/js/".($f?$f.'/':'').$c.'.js?'.$g->template['cacheid'].'" type="text/javascript"></script>';
	if($e)echo $r;
	return $r;
}
?>