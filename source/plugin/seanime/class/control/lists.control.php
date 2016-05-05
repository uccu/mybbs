<?php
namespace plugin\seanime\control;
defined('IN_PLAY') || exit('Access Denied');
class lists extends \control{
    private $listField;
    function _beginning(){
        $this->g->template['title']="4MOEの动漫资源 - ";
        $this->listField = array('sid','subtitle','sname','sloc_type','size','stimeline','sdtype','outstation','outlink');
        
        
        //include template();
    }
    function _get_g(){
        return table('config');
    }
    function _get_theme(){
        return model('seanime:seanime_theme');
    }
    function _get_user(){
        return control('user:base','api');
    }
    function _get_sort(){
        return model('seanime:seanime_sort');
    }
    function _get_list($where=array(),$order=0,$desc='DESC'){
        if($order !== 'size')$order = 'stimeline';
        if(!isset($where['show']))$where['show'] = 1;
        if($where['show']===false)unset($where['show']);
        $_m = model('seanime_resource');
        $list = $_m->field($this->listField)->where($where)->order($order,$desc)->limit(100)
                //->sql()
                ->select();
        //echo $list;die();
        $time =time();$today = strtotime(date('Y-m-d'));
        $where2['utime'] = array('logic',$time-3600*24,'>');
        $playbill = $this->theme->where($where2)->order('utime')->limit(999)->select();
        $playbill_y = $playbill_t = array();
        foreach ($playbill as $v){
            if($v['utime']<$today)$playbill_y[]=$v;
            else $playbill_t[]=$v;
        }
        $sd = $this->sort->sdtype;
        $this->user->uid;
        $user = (array)$this->user;
        $t = template();
        $g = (array)table('config');
        include $t;
    }
    function search($s=''){
        if(!$s)$this->all();
        $this->g->template['title'] .='搜索 - '.$s;
        $where['tag'] = array('match',$s);
        $_m = model('seanime_resource_tag');
        $table = model('seanime_resource')->foreignTagTable;
        $list = $_m->add_table($table)->field($this->listField)->where($where)->limit(100)
                //->sql()
                ->select();
        //echo $list;die();
        $time =time();$today = strtotime(date('Y-m-d'));
        $where2['utime'] = array('logic',$time-3600*24,'>');
        $playbill = $this->theme->where($where2)->order('utime')->limit(999)->select();
        $playbill_y = $playbill_t = array();
        foreach ($playbill as $v){
            if($v['utime']<$today)$playbill_y[]=$v;
            else $playbill_t[]=$v;
        }
        $sd = $this->sort->sdtype;
        $this->user->uid;
        $user = (array)$this->user;
        $t = template();
        $g = (array)table('config');
        include $t;
    }
    function subtitle($sub='',$order=0,$desc='DESC'){
        $this->g->template['title'] .='字幕|压制 - '.$sub;
        $where=array();
        if($sub)$where['subtitle'] = $sub;
        $this->_get_list($where,$order,$desc);
    }
    function aid($aid='',$order=0,$desc='DESC'){
        $where=array();
        $a = $this->theme->find($aid);
        $this->g->template['title'] .=$a?$a['name']:'未归类';
        if($aid)$where['aid'] = $aid;
        $this->_get_list($where,$order,$desc);
    }
    function sdtype($type='',$order=0,$desc='DESC'){
        $sd = $this->sort->sdtype;
        $this->g->template['title'] .=$sd[$type]['name']?$sd[$type]['name']:'未知';
        $where=array();
        if($type)$where['sdtype'] = $type;
        $this->_get_list($where,$order,$desc);
    }
    function all($order=0,$desc='DESC'){
        $this->g->template['title'] .='所有资源';
        $this->_get_list(array(),$order,$desc);
    }
    function ltype($type='',$order=0,$desc='DESC'){
        $where=array();
        if($type==1){
            $this->g->template['title'] .='种子资源';
        }elseif($type==2){
            $this->g->template['title'] .='磁力资源';
        }elseif($type==3){
            $this->g->template['title'] .='外链资源';
        }elseif($type==4){
            $this->g->template['title'] .='网盘资源';
        }else{
            $this->g->template['title'] .='未知资源';
        }
        if($type)$where['sloc_type'] = $type;
        $this->_get_list($where,$order,$desc);
    }
    function today($order=0,$desc='DESC'){
        $this->g->template['title'] .='今日资源';
        $where['show'] = 1;
        $where['stimeline']=array('logic',strtotime(date('Y-m-d')),'>');
        $this->_get_list($where,$order,$desc);
    }
    function yesterday($order=0,$desc='DESC'){
        $this->g->template['title'] .='昨日资源';
        $y = strtotime(date('Y-m-d',time()-3600*24));
        $t = strtotime(date('Y-m-d'));
        $where['show'] = 1;
        $where['stimeline']=array('between',array($y,$t));
        $this->_get_list($where,$order,$desc);
    }
    function my($order=0,$desc='DESC'){
        $where=array();
        $this->g->template['title'] .='我发布的资源';
        $where['suid'] = $this->user->uid;
        $where['show'] = false;
        $this->_get_list($where,$order,$desc);
    }
    function _nomethod(){
       $this->all();
    }
}

?>