<?php
namespace plugin\project\control;
defined('IN_PLAY') || exit('Access Denied');
class product extends \control\ajax{
    function _beginning(){
        //$this->user->_safe_login();
    }
    function _get_user(){
        return control('user:base','api');
    }
    function _get_model(){
        return model('common:opition');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>