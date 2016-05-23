<?php
namespace plugin\project\control;
defined('IN_PLAY') || exit('Access Denied');
class project extends \control\ajax{
    function _beginning(){
        
    }
    function _get_user(){
        return control('user:base','api');
    }
    function _get_model(){
        return model('project:project');
    }
    function _get_favourite(){
        return model('user:favourite');
    }
    
    function get_list(){
        $m = $this->model->field(array('jid','jthumb','jname'))->limit(999)->order(array('jorder'))->select();
        $this->success($m);
    }
    function project($jid=0){
        $this->user->_safe_login();
        $tt = post('jid',0,'%d');
        if($tt)$jid = $tt;
        $d = $this->model->find($jid);
        if(!$d)$this->error(411,'获取失败');
        $where['uid'] = $this->user->uid;
        $where['jid'] = $jid;
        $d['favo'] = $this->favourite->where($where)->find() ? 1 : 0;
        $this->success($d);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>