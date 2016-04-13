<?php
namespace plugin\test\control;
defined('IN_PLAY') || exit('Access Denied');
class test extends \control{
	
	function __construct(){
		//model('test','api')->start();
		
		
		
		
	}
	function abc($a,$b=0){
        model('cache')->replace('cacheid',1);
		//var_dump($a,$b);
        $g['plugin']=1234;
        include template('cache:baka');
	}
	
	
	
}


?>