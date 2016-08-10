<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class cases extends \control\ajax{
    
    protected function _beginning(){
        //echo '12';
    }
    function get_subnav($sid){
        if($sid){
            $z = model('subnav')->where(array('sid'=>$sid))->limit(9999)->select();
        }else{
            $z = model('subnav')->where(array('sid'=>0))->limit(9999)->select();
        }
        $this->success($z);
    }
    function get_list($id,$limit,$timeline){
        if(!$limit)$limit = 15;
        $ze = model('subnav')->where(array('tid'=>$id))->find();
        if(!$ze)$this->error(400,'没有该分类');
        $z = model('subnav')->where(array('sid'=>$id))->get_field();
        if(!$z){
            $where = array('tid'=>$id);
            if($timeline)$where['ctime'] = array('logic',floor($timeline),'<');
            $z = model('anli')->where($where)->limit($limit)->order(array('ctime'=>'DESC'))->select();
        }else{
            $where = array('td'=>$id);
            if($timeline)$where['ctime'] = array('logic',floor($timeline),'<');
            $z = model('anli')->table(array(
                'anli'=>array(
                    'aid','thumb','name','ctime','des','tid','_mapping'=>'a'
                ),'subnav'=>array(
                    'name'=>'tname','sid'=>'td','_mapping'=>'s','_on'=>'tid'
                )
            ))->where($where)->limit($limit)->order(array('ctime'=>'DESC'))->select();
        }

        $this->success($z);
    }
    function _nomethod(){
        $subnavs = model('subnav')->limit(9999)->select();
        $subnavsArray = array();
        foreach($subnavs as $v)$subnavsArray[$v['sid']][] = $v;
        
        $this->g->template['subnav'] = $subnavsArray[0];
        unset($subnavsArray[0]);
        $this->g->template['subsubnav'] = $subnavsArray;
        T();
    }
    


}