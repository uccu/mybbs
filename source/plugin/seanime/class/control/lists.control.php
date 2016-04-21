<?php
namespace plugin\seanime\control;
defined('IN_PLAY') || exit('Access Denied');
class lists extends \control{
    private $listField;
    function _beginning(){
        $this->listField = array('sid','subtitle','sname','sloc_type','size','stimeline','sdtype','outstation','outlink');
        
        
        //include template();
    }
    function _get_list($where=array(),$order=0,$desc='DESC'){
        if($order !== 'size')$order = 'stimeline';
        $where['show'] = 1;
        $_m = model('seanime_resource');
        $list = $_m->field($this->listField)->where($where)->order($order,$desc)->limit(100)
                //->sql()
                ->select();
        //echo $list;die();
        $g = (array)table('config');
        include template();
    }
    function subtitle($sub='',$order=0,$desc=0){
        $where=array();
        if($sub)$where['subtitle'] = $sub;
        $this->_get_list($where,$order,$desc);
    }
    function sdtype($type='',$order=0,$desc=0){
        $where=array();
        if($type)$where['sdtype'] = $type;
        $this->_get_list($where,$order,$desc);
    }
    function all($order=0,$desc=0){
        $this->_get_list(array(),$order,$desc);
    }
    function ltype($type='',$order=0,$desc=0){
        $where=array();
        if($type)$where['sloc_type'] = $type;
        $this->_get_list($where,$order,$desc);
    }
    function today($order=0,$desc=0){
        $where['stimeline']=array('logic',strtotime(date('Y-m-d')),'>');
        if($type)$where['sloc_type'] = $type;
        $this->_get_list($where,$order,$desc);
    }
    function yesterday($order=0,$desc=0){
        $y = strtotime(date('Y-m-d',time()-3600*24));
        $t = strtotime(date('Y-m-d'));
        $where['stimeline']=array('contain',array($y,$t),'BETWEEN','AND');
        
        if($type)$where['sloc_type'] = $type;
        $this->_get_list($where,$order,$desc);
    }
    function _nomethod(){
       $this->all();
    }
}

?>