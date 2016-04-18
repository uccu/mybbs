<?php
namespace template;
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}

class base
{
	public static function ifexist($tplfile){
		if(!is_file($tplfile))throw new \Exception('tplfile not exist: '.basename($tplfile));
		if($fp = @fopen($tplfile, 'r')){
			$template = @fread($fp, filesize($tplfile));
			fclose($fp);
		}
		return $template;
	}
	public static function isflesh($name,$folder,$plugin){

		$tplfile=PLAY_ROOT.'\\source\\plugin\\'.$plugin.'\\template\\'.($folder?$folder.'\\':'').$name.'.php';
		$filetime = filemtime($tplfile);
		$oldfiletime = model('cache')->get('template_'.$plugin.'_'.($folder?$folder.'_':'').$name);
        //echo $oldfiletime;
		if(!$filetime){
			return true;
		}
		elseif($oldfiletime == $filetime){
			return true;
		}else{
			model('cache')->replace('template_'.$plugin.'_'.($folder?$folder.'_':'').$name,$filetime);
			//main_cache::replace('template_last',$tplfile.'|'.$name2.'|'.$oldfiletime.'|'.$filetime);
			return false;
		}
		
	}
	public static function ttoc($name,$folder='',$plugin='',$sub=false){
		if(!$plugin){
            $name = str_replace('/','\\',$name);
            $config = table('config');
            if(strpos($name, ':')){
                list($plugin,$name) = explode(':', $name);
            }else{
                $plugin = $config->plugin;
            }
            $folder = '';
            if(strpos($name, '\\')){
                list($folder,$name) = explode('\\', $name);
            }
        }
		$tplfile = PLAY_ROOT.'source\\plugin\\'.$plugin.'\\template\\'.($folder?$folder.'\\':'').$name.'.php';
		$template=self::ifexist($tplfile);
		while(preg_match("/<\!--\{template (.*?)\}-->/",$template,$pr)){
            $template=preg_replace("/<\!--\{template (.*?)\}-->/",self::ttoc($pr[1]),$template,1);
        }
		while(preg_match("/<\!--\{subtemplate (.*?)\}-->/",$template,$pr))
            $template=preg_replace("/<\!--\{subtemplate (.*?)\}-->/",self::ttoc($pr[1],'','',true),$template,1);
		$p=array(
            "/<\!--\{eval\}-->/",
            "/<\!--\{\/eval\}-->/",
            "/<\!--\{eval (.*?)\}-->/",


            "/<\!--\{if (.*?)\}-->/",
            "/<\!--\{elseif (.*?)\}-->/",
            "/<\!--\{else\}-->/","/<\!--\{loop (.*?) (.*?)\}-->/",
            "/<\!--\{\/(if|loop)\}-->/",
            '/\{if (.*?)\}/',
            '/\{elseif (.*?)\}/',
            '/\{else\}/',
            '/\{\/if\}/',
            '/\{\$?([a-z_0-9\[\]\'"]+)\}/i',
            '/\{\$?([a-z_0-9]+)\.([a-z_0-9]+)\}/i',
            '/\{\$?([a-z_0-9]+)\.([a-z_0-9]+)\.([a-z_0-9]+)\}/i',
            '/[\r\n\t]/'
        );
		$r=array(
            "<?php ",
            " ?>",
            "<?php $1 ?>",
            
            
            "<?php if($1){ ?>",
            "<?php }elseif($1){ ?>",
            "<?php }else{ ?>",
            "<?php foreach($1 as $2){ ?>",
            "<?php } ?>",
            "<?php if($1){ ?>",
            "<?php }elseif($1){ ?>",
            "<?php }else{ ?>",
            "<?php } ?>",
            '<?php echo $$1;?>',
            '<?php echo $$1["$2"];?>',
            '<?php echo $$1["$2"]["$3"];?>',
            ''
        );
		$template = preg_replace($p,$r,$template);
		if(!$sub){
			$template ="<?php defined('IN_PLAY') || exit('Access Denied');?>".$template;
			$cfile=PLAY_ROOT.'/source/cache/'.$plugin.'_'.($folder?$folder.'_':'').$name.'.php';
			$fp = fopen($cfile, 'w');
			fwrite($fp, $template);
			fclose($fp);
		}
		return $template;
	}
	public static function load($name,$force=true){
        $name = str_replace('/','\\',$name);
        $config = table('config');
		if(strpos($name, ':')){
			list($plugin,$name) = explode(':', $name);
		}else{
            $plugin = $config->plugin;
        }
        $folder = '';$kname = $name;
        if(strpos($name, '\\')){
            list($folder,$kname) = explode('\\', $name);
        }
		
		if(!$force){
			$tplfile=PLUGIN_ROOT.$plugin.'\\template\\'.$name.'.php';
			if(!is_file($tplfile))return false;
		}
        if(!$plugin || !$kname)throw new \Exception('Oops! Name error: '.$name);
		$cfile=PLAY_ROOT.'/source/cache/'.$plugin.'_'.($folder?$folder.'_':'').$kname.'.php';
		file_exists($cfile) && self::isflesh($kname,$folder,$plugin) || self::ttoc($kname,$folder,$plugin);
		return $cfile;
	}
}



?>