<?php
namespace plugin\tool\control\format;
defined('IN_PLAY') || exit('Access Denied');
require_once(dirname(__FILE__).'/phpQuery/phpQuery.php');
class query{
	function __construct(){
		
	}
	function get($url){
		\phpQuery::newDocumentFile($url);
	}
	function set($a){
		\phpQuery::newDocumentHTML($a);
	}
	function jq($a){
		return \phpQuery::pq($a); 
	}
	
}
