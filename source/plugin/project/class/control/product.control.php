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
        return model('project:product');
    }
    function get_list($jid=0){
        $this->user->_safe_login();
        $tt = post('jid',0,'%d');
        if($tt)$jid = $tt;
        $limit = post('limit',6,'%d');
        $line = post('dctime',0,'%d');
        $where = array();
        if($jid)$where['jid'] = $jid;
        if($line)$where['dctime'] = array('logic',$line,'<');
        $m = $this->model->field(array('did','dthumb','dname'))->where($where)->order('dctime','DESC')->limit($limit)->select();
        $this->success($m);
    }
    function product($did=0){
        $this->user->_safe_login();
        $d = $this->model->find($did);
        if(!$d)$this->error(411,'获取失败');
        $this->success($d);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>