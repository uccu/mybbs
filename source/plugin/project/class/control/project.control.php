<?php
namespace plugin\project\control;
defined('IN_PLAY') || exit('Access Denied');
class project extends \control\ajax{
    function _beginning(){
        //$this->user->_safe_login();
    }
    function _get_user(){
        return control('user:base','api');
    }
    function _get_model(){
        return model('project:project');
    }
    function get_list(){
        $m = $this->model->filed(array('jid','jthumb','jname'))->limit(999)->order(array('jorder','tctime'))->select();
        $this->success($m);
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>