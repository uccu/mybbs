<?php
namespace plugin\admin\control;
defined('IN_PLAY') || exit('Access Denied');
class common extends \control{
    function _beginning(){
        //$this->user->_safe_login();
    }
    function _get_user(){
        return control('user:base','api');
    }
    function _get_model(){
        return model('common:opition');
    }
    function _get_userModel(){
        return model('user:user_info');
    }
    function _get_project(){
        return model('project:project');
    }
    function pic(){
        $m = $this->model->find('logo_pic');
        if(!$m)$m = array();
        else $m = unserialize($m['content']);
        table('config')->template['pic'] = $m;
        T('admin:common/pic');
    }
    function ad(){
        
        
        T('admin:common/ad');
    }
    function _nomethod(){
        $this->pic();
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>