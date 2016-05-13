<?php
namespace plugin\common\control;
defined('IN_PLAY') || exit('Access Denied');
class opition extends \control\ajax{
    function _beginning(){
        //$this->user->_safe_login();
    }
    function _get_user(){
        return control('user:base','api');
    }
    function _get_model(){
        return model('common:opition');
    }
    function get_logo_pic(){
        $m = $this->model->find('logo_pic');
        if(!$m)$m = array();
        else $m = unserialize($m);
        $this->success($m);
        
    }
    function set_logo_pic(){
        
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>