<?php
namespace plugin\weixin\control;
defined('IN_PLAY') || exit('Access Denied');
class app extends \control\ajax{
    
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
        $limit = post('limit',6,'%d');
        $line = post('dctime',0,'%d');
        $where = array();
        if($jid)$where['jid'] = $jid;
        if($line)$where['dctime'] = array('logic',$line,'<');
        $this->g->template['list'] = $model->field(array('did','dthumb','dname','dctime'))->where($where)->order('dctime','DESC')->limit($limit)->select();
        if($line)$this->success($this->g->template['list']);
        T(CONTROL_NAME.'/'.METHOD_NAME);
    }
    function project_list(){
        $limit = post('limit',6,'%d');
        $line = post('dctime',0,'%d');
        $where = array();
        if($line)$where['dctime'] = array('logic',$line,'<');
        $project = model('project:project')->limit(9999)->order(array('jctime'=>"DESC"))->select();$p2=array();$c = 0;
        foreach($project as $p){
            if($p2[$c] && count($p2[$c])==4)$c++;
            if(!$p2[$c])$p2[$c]=array();
            $p2[$c][] = $p;
        }
        $this->g->template['project'] = $p2;
        //var_dump($p2);
        $this->g->template['title'] = '产品与项目';
        $this->g->template['product'] = model('project:product')->field(array('did','dthumb','dname','dctime'))->where($where)->order('dctime','DESC')->limit($limit)->select();
        if($line)$this->success($this->g->template['product']);
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