<?php
namespace control;
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}
class ajax extends \control{
	function __construct(){
		global $_G;
		if(!IS_AJAX)$this->error('not ajax');
		
	}
}


?>