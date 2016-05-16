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
        $m = $this->model->field(array('jid','jthumb','jname'))->limit(999)->order(array('jorder'))->select();
        $this->success($m);
    }
    function project($jid=0){
        $this->user->_safe_login();
        $d = $this->model->find($jid);
        if(!$d)$this->error(411,'获取失败');
        $this->success($d);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>