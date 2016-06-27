<?php
namespace plugin\app\control;
defined('IN_PLAY') || die('Access Denied');
class MyIndex extends api\ajax{
    function _beginning(){
        
    }
    
    function _nomethod(){
        $this->user->_safe_login();
        T();
    }
}




?>