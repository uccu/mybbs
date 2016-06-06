<?php
namespace plugin\weixin\control;
defined('IN_PLAY') || exit('Access Denied');
class shili extends ab\ab{
    
/*
    set subnav

*/    
    function _get_map(){
        return array(
            'person'=>'真人秀','compare'=>'前后对比','video'=>'视频实例'
        );
    }
    
    function _app_person(){
        $this->g->template['content'] = $this->get_opition('person_desc');
        T('_static');
    }
    function _app_compare(){
        $this->g->template['content'] = $this->get_opition('compare_desc');
        T('_static');
    }
    function _app_video($aid){
        if($aid){
            $a = $this->shiliVideo->find($aid);
            $this->g->template['title'] = $a['atitle'];
            $this->g->template['content'] = $a['adescription'];
            T('_static');return;
        }
        $this->g->template['list'] = $this->shiliVideo->limit(9999)->order(array('actime'=>'desc'))->select();
         T(CONTROL_NAME.'/video');
    }
    
    
    
/*
    get template

*/
    function video($detail=0,$aid=0){
        if($detail)return $this->_video_detail($aid);
        $this->g->template['list'] = $this->shiliVideo->limit(9999)->order(array('actime'=>'desc'))->select();
        T(CONTROL_NAME.'/'.METHOD_NAME);
    }
    function compare(){
        T(CONTROL_NAME.'/'.METHOD_NAME);
    }
    function person(){
        T(CONTROL_NAME.'/'.METHOD_NAME);
    }
    function _video_detail($aid){
        if(!$aid)$this->g->template['aid'] = 0;
        else{
            $m = $this->shiliVideo->find($aid);
            if(!$m)header('Location:'.CONTROL_NAME.'/'.METHOD_NAME);
            $this->g->template['aid'] = $m['aid'];
        }
        T(CONTROL_NAME.'/'.METHOD_NAME.'_detail');
    }


/*
    get template when no method 
    
*/
    function _nomethod(){
        header('Location:'.CONTROL_NAME.'/person');
    }
    
    
    
/*

    save data by post

*/
    function save_person(){
        $m = $this->save_opition('person_desc');
        $this->success($m);
    }
    function save_compare(){
        $m = $this->save_opition('compare_desc');
        $this->success($m);
    }
    function save_video($aid){
        $_POST['adescription'] = post('adescription','',array($this,'_toraw'));
        if(!$aid){
            $_POST['actime'] = time();
            $m = $this->shiliVideo->data($_POST)->add();
        }else 
        $m = $this->shiliVideo->data($_POST)->save($aid);
        $this->success($m);
    }
    
    
/*
    get data 


*/
    function get_video($aid){
        if(!$aid)$m['adescription'] = '';
        else $m = $this->shiliVideo->find($aid);
        $this->success($m);
    }
    function get_person(){
        $m = $this->get_opition('person_desc',1);
        $this->success($m);
    }
    function get_compare(){
        $m = $this->get_opition('compare_desc',1);
        $this->success($m);
    }

   
   
    function del_video($aid){
        $m = $this->shiliVideo->remove($aid);
        $this->success($m);
    }
}