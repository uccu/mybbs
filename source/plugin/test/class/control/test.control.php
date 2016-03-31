<?php
namespace plugin\test\control;
defined('IN_PLAY') || exit('Access Denied');
class test extends \control{
	
	function __construct(){
		model('test');
		
		
		
		
	}
	function abc($a,$b=0){
		var_dump($a,$b);
	}
	
	
	
}


?>