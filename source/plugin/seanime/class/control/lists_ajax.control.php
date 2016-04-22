<?php
namespace plugin\seanime\control;
defined('IN_PLAY') || exit('Access Denied');
class lists_ajax extends \control\ajax{
    private $listField;
    function _beginning(){
        $this->listField = array('sid','subtitle','sname','sloc_type','size','stimeline','sdtype','outstation','outlink');
        
        
        //include template();
    }
    function _get_list($where=array(),$order='time',$desc='DESC'){
        $data = post('data','');
        if(!strlen($data))$this->error('error');
        if($order !== 'size')$order = 'stimeline';
        $where['show'] = 1;
        $where2[$order] = array('logic',$data,strtoupper($desc) == 'ASC' || !$desc?'>':'<');
        $_m = model('seanime_resource');
        $list = $_m->field($this->listField)->where($where)->where($where2)->order($order,$desc)->limit(50)
                //->sql()
                ->select();
        //var_dump($desc);die();
        $station =array('本站','动漫花园','NYAA','Leopard');
        foreach($list as &$v){
            $v['outstation'] =$station[$v['outstation']];
        }
        $this->success($list);
    }
    function subtitle($sub='',$order='time',$desc='DESC'){
        $where=array();
        if($sub)$where['subtitle'] = $sub;
        $this->_get_list($where,$order,$desc);
    }
    function aid($aid='',$order='time',$desc='DESC'){
        $where=array();
        if($aid)$where['aid'] = $aid;
        $this->_get_list($where,$order,$desc);
    }
    function sdtype($type='',$order='time',$desc='DESC'){
        $where=array();
        if($type)$where['sdtype'] = $type;
        $this->_get_list($where,$order,$desc);
    }
    function all($order='time',$desc='DESC'){
        $this->_get_list(array(),$order,$desc);
    }
    function ltype($type='',$order='time',$desc='DESC'){
        $where=array();
        if($type)$where['sloc_type'] = $type;
        $this->_get_list($where,$order,$desc);
    }
    function today($order='time',$desc='DESC'){
        $where['show'] = 1;
        $where['stimeline']=array('logic',strtotime(date('Y-m-d')),'>');
        $this->_get_list($where,$order,$desc);
    }
    function yesterday($order='time',$desc='DESC'){
        $y = strtotime(date('Y-m-d',time()-3600*24));
        $t = strtotime(date('Y-m-d'));
        $where['show'] = 1;
        $where['stimeline']=array('contain',array($y,$t),'BETWEEN','AND');
        $this->_get_list($where,$order,$desc);
    }
}

?>