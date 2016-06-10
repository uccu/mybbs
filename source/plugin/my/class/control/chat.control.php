<?php
namespace plugin\my\control;
defined('IN_PLAY') || exit('Access Denied');
use \control;
class chat extends control{
    function _beginning(){
        
    }
    function room($id=0){
         $this->g->template['title'] .= ' - Room - '.$id;
        if(!$id && !is_numeric($id))return;
        T();
    }
    function _nomethod(){
		$this->g->template['title'] = 'Chat - Master Room';
        T();
    }
    
}


?>