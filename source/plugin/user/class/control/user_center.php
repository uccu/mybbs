<?php
namespace plugin\user\control;
defined('IN_PLAY') || exit('Access Denied');
class user_center extends \control\ajax{
    function _beginning(){
    }
    function _get_user(){
        return control('user:base','api');
    }
    function _get_model(){
        return model('user:user_info');
    }
    function change_password(){
        
        
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>