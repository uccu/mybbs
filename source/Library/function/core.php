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
function table($t,$f='',$e='',$r=true){return C::t($t,$f,$e,$r);}
function control($t=false,$f=''){
	$config = table('config');
	if(!$t){
		$t = $config->plugin.':'.$config->control;$f=$config->folder;
	}
	//var_dump($t);
	return C::c($t,$f);
}
function model($m,$f=''){return C::m($m,$f);}
function cookie($name,$value='',$expire='',$path='/',$domain=0){
    if($value){
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
function post($s,$r=''){
    $d = explode('.',$s);
    switch(count($d)){
        case 1:
            $f = $_POST[$d[0]];break;
        case 2:
            $f = $_POST[$d[0]][$d[1]];break;
        case 3:
            $f = $_POST[$d[0]][$d[1]][$d[2]];break;
        default:
            break;
    }
    return $f?$f:$r;
}
function addcss($c=0,$f=0,$p=0,$e=true){
	$g = table('config');
	if(!$c)$c = $g->control;
	if(!$p)$p = $g->plugin;
    if(!$f)$f = $g->folder;
	$r = "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$g->template['baseurl']."source/plugin/".$p."/css/".($f?$f.'/':'').$c.".css?".$g->template['cacheid']."\">";
	if($e)echo $r;
	return $r;
}
function addjs($c=0,$f=0,$p=0,$e=true){
	$g = table('config');
	if(!$c)$c = $g->control;
	if(!$p)$p = $g->plugin;
    if(!$f)$f = $g->folder;
	$r = '<script src="'.$g->template['baseurl']."source/plugin/".$p."/js/".($f?$f.'/':'').$c.'.js?'.$g->template['cacheid'].'" type="text/javascript"></script>';
	if($e)echo $r;
	return $r;
}
?>