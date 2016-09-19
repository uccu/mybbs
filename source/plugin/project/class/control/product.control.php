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
    function _get_favourite(){
        return model('user:favourite');
    }
    function _get_modelView(){
        $m = model('project:project_link_product');
        $m->add_table($m->productMap);
        return $m;
    }
    function get_list($jid=0){
        $tt = post('jid',0,'%d');
        if($tt)$jid = $tt;
        $limit = post('limit',6,'%d');
        $line = post('dctime',0,'%d');
        $where = array();
        if($jid)$where['jid'] = $jid;
        if($line)$where['dctime'] = array('logic',$line,'<');
        if($jid)$m = $this->modelView->field(array('did','dthumb','dname','dctime'))->where($where)->order('dctime','DESC')->limit($limit)->select();
        else $m = $this->model->field(array('did','dthumb','dname','dctime'))->where($where)->order('dctime','DESC')->limit($limit)->select();
        $this->success($m);
    }
    function product($did=0){
        $did = post('did',$did,'%d');
        $d = $this->model->find($did);
        if(!$d)$this->error(411,'获取失败');
        $where['uid'] = $this->user->uid;
        $where['did'] = $did;
        $d['favo'] = $this->favourite->where($where)->find() ? 1 : 0;
        $d['introduction'] = 'http://120.26.230.136:6087/project/product/product_info/introduction/'.$did;
        $d['fealture'] = 'http://120.26.230.136:6087/project/product/product_info/fealture/'.$did;
        $d['effect'] = 'http://120.26.230.136:6087/project/product/product_info/effect/'.$did;
        $d['purchase'] = 'http://120.26.230.136:6087/project/product/product_info/purchase/'.$did;
        $this->success($d);
    }
    
    function product_info($a,$did){
        $did = post('did',$did,'%d');
        $d = $this->model->find($did,0)->get_field($a);
        if(!$d)$d='';
        $this->g->template['content'] = $d;
        T('content');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>