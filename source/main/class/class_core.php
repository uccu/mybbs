<?php
define('IN_PLAY', true);
define('PLAY_ROOT', substr(dirname(__FILE__), 0, -17));
set_exception_handler(array('core','handleException'));
set_error_handler(array('core','handleError'));
register_shutdown_function(array('core', 'handleShutdown'));
if(function_exists('spl_autoload_register'))spl_autoload_register(array('core', 'autoload'));
else{function __autoload($class){return core::autoload($class);}}
require PLAY_ROOT.'/source/main/function/core.php';
$_G['loadtimeset']['start']=microtime(get_as_float);
C::init();
class core
{
	private static $_tables;
	private static $_imports;
	public static function init(){
		new main_application();
	}
	public static function t($name){
		if(strpos($name, '_') == false)$name .= '_global';
		if(!isset(self::$_tables[$name]))self::$_tables[$name] = new $name;
		return self::$_tables[$name];
	}
	public static function m($name){
		$tname = 'model_'.$name;
		if(!isset(self::$_tables[$tname]))self::$_tables[$tname] = new $tname($name);
		return self::$_tables[$tname];
	}
	public static function c($name){
		$tname = 'control_'.$name;
		if(!isset(self::$_tables[$tname]))self::$_tables[$tname] = new $tname($name);
		return self::$_tables[$tname];
	}
	public static function import($name, $folder = '', $force = true) {
		$key = $name;
		if(!isset(self::$_imports[$key])) {
			$path = PLAY_ROOT.'/source';
			if(strpos($name, '/') !== false) {
				$pre = basename(dirname($name));
				$filename = dirname($name).'/'.$pre.'_'.basename($name).'.php';
			} else $filename = $name.'.php';
			
			if(is_file($path.'/main/'.$filename)) {
				include $path.'/main/'.$filename;
				self::$_imports[$key] = true;
				return true;
			}elseif($folder){
				list($prek) = explode('_', basename($name));
				if(is_file($path.'/plugin/'.$prek.'/'.$folder.'/'.$folder.'_'.basename($name).'.php')){
					include $path.'/plugin/'.$prek.'/'.$folder.'/'.$folder.'_'.basename($name).'.php';
					self::$_imports[$key] = true;
					return true;
				}else{
					if($folder==='control')return false;
					throw new Exception('Oops! System file lost: '.$filename.' or '.'plugin/'.$prek.'/'.$folder.'/'.$folder.'_'.basename($name));
				}
				
			}elseif($pre && is_file($path.'/plugin/'.$pre.'/class/'.$pre.'_'.basename($name).'.php')) {
				include $path.'/plugin/'.$pre.'/class/'.$pre.'_'.basename($name).'.php';
				self::$_imports[$key] = true;
				return true;
			} elseif(!$force) {
				return false;
			} else {
				throw new Exception('Oops! System file lost: '.$filename.' or '.'plugin/'.$pre.'/class/'.$pre.'_'.basename($name));
			}
		}
		return true;
	}
	public static function handleException($exception) {
		global $_G;
		if(defined('SHOW_ERROR'))var_dump($exception);
		echo "handleException";
		die();
	}
	public static function handleError($errno, $errstr, $errfile, $errline) {
		if($errno) {
			switch($errno){
				case 2:
					if(stristr($errstr,'foreach'))return null;
					elseif(stristr($errstr,'mysql'))return null;
					//elseif(stristr($errstr,'match'))return null;
					break;
				case 8:
				//case 2:
					return null;
					break;
				default:
					break;
			}
			var_dump($errno,$errstr,basename($errfile),$errline);
			echo "handleError";
			die();
		}
	}

	public static function handleShutdown() {
		if(($error = error_get_last()) && $error['type']) {
			global $_G;
			if(stristr($error['file'],'eval'))return null;
			if(defined('SHOW_ERROR'))var_dump($error);
			echo "handleShutdown";
			die();
		}
	}
	public static function autoload($class) {
		$class = strtolower($class);
		if(strpos($class, '_') !== false) {
			list($folder) = explode('_', $class);
			$file = 'class/'.$folder.'/'.substr($class, strlen($folder) + 1);
		} else $file = 'class/'.$class;
		try {
			self::import($file,in_array($folder,array('model','control'))?$folder:'');
			return true;
		} catch (Exception $exc) {
			$trace = $exc->getTrace();
			foreach ($trace as $log)if(empty($log['class']) && $log['function'] == 'class_exists')return false;
			throw new Exception($exc);
		}
	}
}

class C extends core {}

?>