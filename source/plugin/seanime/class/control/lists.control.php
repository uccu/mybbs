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
    function search($s=''){
        if(!$s)$this->all();
        $where['tag'] = array('match',$s);
        $_m = model('seanime_resource_tag');
        $table = model('seanime_resource')->foreignTagTable;
        $_m->add_table($table);
        $list = $_m->field($this->listField)->where($where)->limit(100)
                ->sql()
                ->select();
        echo $list;die();
        $g = (array)table('config');
        include template();
    }
    function subtitle($sub='',$order=0,$desc='DESC'){
        $where=array();
        if($sub)$where['subtitle'] = $sub;
        $this->_get_list($where,$order,$desc);
    }
    function sdtype($type='',$order=0,$desc='DESC'){
        $where=array();
        if($type)$where['sdtype'] = $type;
        $this->_get_list($where,$order,$desc);
    }
    function all($order=0,$desc='DESC'){
        $this->_get_list(array(),$order,$desc);
    }
    function ltype($type='',$order=0,$desc='DESC'){
        $where=array();
        if($type)$where['sloc_type'] = $type;
        $this->_get_list($where,$order,$desc);
    }
    function today($order=0,$desc='DESC'){
        $where['stimeline']=array('logic',strtotime(date('Y-m-d')),'>');
        if($type)$where['sloc_type'] = $type;
        $this->_get_list($where,$order,$desc);
    }
    function yesterday($order=0,$desc='DESC'){
        $y = strtotime(date('Y-m-d',time()-3600*24));
        $t = strtotime(date('Y-m-d'));
        $where['stimeline']=array('between',array($y,$t));
        
        if($type)$where['sloc_type'] = $type;
        $this->_get_list($where,$order,$desc);
    }
    function _nomethod(){
       $this->all();
    }
}

?>