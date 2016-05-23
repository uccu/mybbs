<?php
namespace plugin\admin\control;
defined('IN_PLAY') || exit('Access Denied');
class article extends \control{
    function _beginning(){
        //$this->user->_safe_login();
    }
    function _get_user(){
        return control('user:base','api');
    }
    function _get_model(){
        return model('article:theme');
    }
    function get_list(){
        $m = $this->model->limit(999)->order(array('torder','tctime'))->select();
        $this->success($m);
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>