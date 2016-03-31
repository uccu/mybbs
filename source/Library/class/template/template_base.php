<?php
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}

class template_base
{
	function __construct() {
		
	}
	public static function ifexist($tplfile){
		if($fp = @fopen($tplfile, 'r')){
			$template = @fread($fp, filesize($tplfile));
			fclose($fp);
		}else throw new Exception('Oops! Template not exist: '.$name);
		return $template;
	}
	public static function isflesh($name){
		list($pluginid, $name2) = explode('/',$name);
		if(!$pluginid || !$name)throw new Exception('Oops! Name error: '.$name);
		$tplfile=PLAY_ROOT.'/source/plugin/'.$pluginid.'/template/'.$name2.'.php';
		$filetime = filemtime($tplfile);
		$oldfiletime = main_cache::get('template_'.$pluginid.'_'.$name2);
		if(!$filetime){
			return true;
		}
		elseif($oldfiletime == $filetime){
			return true;
		}else{
			main_cache::replace('template_'.$pluginid.'_'.$name2,$filetime);
			//main_cache::replace('template_last',$tplfile.'|'.$name2.'|'.$oldfiletime.'|'.$filetime);
			return false;
		}
		
	}
	public static function ttoc($name,$sub=false){
		//main_cache::add('template_time');
		// if(!$sub)main_cache::replace('template_last','template_'.$name);
		list($pluginid, $name2) = explode('/',$name);
		if(!$pluginid || !$name)throw new Exception('Oops! Name error: '.$name);
		$tplfile=PLAY_ROOT.'/source/plugin/'.$pluginid.'/template/'.$name2.'.php';
		$template=self::ifexist($tplfile);
		while(preg_match("/<\!--\{template (.*?)\}-->/",$template,$pr))$template=preg_replace("/<\!--\{template (.*?)\}-->/",self::ttoc($pr[1]),$template,1);
		while(preg_match("/<\!--\{subtemplate (.*?)\}-->/",$template,$pr))$template=preg_replace("/<\!--\{subtemplate (.*?)\}-->/",self::ttoc($pr[1],true),$template,1);
		$p=array("/<\!--\{eval\}-->/","/<\!--\{\/eval\}-->/","/<\!--\{eval (.*?)\}-->/","/<\!--\{if (.*?)\}-->/","/<\!--\{elseif (.*?)\}-->/","/<\!--\{else\}-->/","/<\!--\{loop (.*?) (.*?)\}-->/","/<\!--\{\/(if|loop)\}-->/",'/\{if (.*?)\}/','/\{elseif (.*?)\}/','/\{else\}/','/\{\/if\}/','/\{(\$.*?)\}/','/[\r\n\t]/');
		
		$r=array("<?php "," ?>","<?php $1 ?>","<?php if($1){ ?>","<?php }elseif($1){ ?>","<?php }else{ ?>","<?php foreach($1 as $2){ ?>","<?php } ?>","<?php if($1){ ?>","<?php }elseif($1){ ?>","<?php }else{ ?>","<?php } ?>","<?php echo $1;?>",'');
		$template = preg_replace($p,$r,$template);
		if(!$sub){
			$template ="<?php defined('IN_PLAY') || exit('Access Denied');?>".$template;
			$cfile=PLAY_ROOT.'/source/cache/'.$pluginid.'_'.$name2.'.php';
			$fp = fopen($cfile, 'w');
			fwrite($fp, $template);
			fclose($fp);
		}
		return $template;
	}
	public static function load($name){
		global $_G,$title,$keywords,$description;
		$_G['loadtimeset']['template']=microtime(get_as_float);
		$_G['template']['title']=$title;
		$_G['template']['keywords']=$keywords;
		$_G['template']['description']=$description;
		list($pluginid, $name2) = explode('/',$name);
		if(!$pluginid || !$name)throw new Exception('Oops! Name error: '.$name);
		$cfile=PLAY_ROOT.'/source/cache/'.$pluginid.'_'.$name2.'.php';
		(file_exists($cfile) && self::isflesh($name)) || self::ttoc($name);
		//self::ttoc($name);
		return $cfile;
	}
}



?>