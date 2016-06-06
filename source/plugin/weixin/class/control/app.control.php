<?php
namespace plugin\weixin\control;
defined('IN_PLAY') || exit('Access Denied');
class app extends \control{
    
/*
    set subnav

*/    
    function pinpai($m,$a,$b){
        $c = control(METHOD_NAME);
        $m = '_app_'.$m;
        if(method_exists($c,$m))$c->$m($a,$b);
        else header('Location: /404.html');
    }
    function shili($m,$a,$b){
        $c = control(METHOD_NAME);
        $m = '_app_'.$m;
        if(method_exists($c,$m))$c->$m($a,$b);
        else header('Location: /404.html');
    }
    function hudong($m,$a,$b){
        $c = control(METHOD_NAME);
        $m = '_app_'.$m;
        if(method_exists($c,$m))$c->$m($a,$b);
        else header('Location: /404.html');
    }
    function up(){
        return control('hudong')->up();
    }
    
    function product_list($jid){
        $jid = post('jid',$jid,'%d');
        if($jid){
            $model = model('project:project_link_product');
            $model->add_table($model->productMap);
        }else $model = model('project:product');
        $limit = post('limit',10,'%d');
        $line = post('dctime',0,'%d');
        $where = array();
        if($jid)$where['jid'] = $jid;
        if($line)$where['dctime'] = array('logic',$line,'<');
        $this->g->template['list'] = $model->field(array('did','dthumb','dname','dctime'))->where($where)->order('dctime','DESC')->limit($limit)->select();
        T(CONTROL_NAME.'/'.METHOD_NAME);
    }
    function product($id){
        $this->g->template['title'] = '产品详情';
        $this->g->template = array_merge($this->g->template, model('project:product')->find($id));
        T(CONTROL_NAME.'/'.METHOD_NAME);
    }
    function project($id){
        $m = model('project:project')->find($id);
        if(!$m)header('Location: /404.html');
        $this->g->template = array_merge($this->g->template, $m);
        $this->g->template['title'] = $m['jname'];
        T(CONTROL_NAME.'/'.METHOD_NAME);
    }
  
}