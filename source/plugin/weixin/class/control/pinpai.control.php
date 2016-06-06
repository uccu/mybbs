<?php
namespace plugin\weixin\control;
defined('IN_PLAY') || exit('Access Denied');
class pinpai extends ab\ab{

    
/*
    set subnav

*/
    function _get_map(){
        return array(
            'introduction'  =>'机构简介',
            'coverage'      =>'媒体报道',
            'expert'        =>'专家团队',
            'project'       =>'精品项目',
        );
    } 
   
    function _app_introduction(){
        $this->g->template['content'] = $this->get_opition('introduction_desc');
        T('_static');
    }
    function _app_expert(){
        $this->g->template['content'] = $this->get_opition('expert_desc');
        T('_static');
    }
    function _app_coverage($aid){
        if($aid){
            $a = $this->pinpaiCoverage->find($aid);
            $this->g->template['title'] = $a['atitle'];
            $this->g->template['content'] = $a['adescription'];
            T('_static');return;
        }
        $this->g->template['list'] = $this->pinpaiCoverage->limit(9999)->order(array('actime'=>'desc'))->select();
         T(CONTROL_NAME.'/coverage');
    }
   
/*
    get template

*/
    function introduction(){
        T(CONTROL_NAME.'/'.METHOD_NAME);
    }
    function coverage($detail=0,$aid=0){
        if($detail)return $this->_coverage_detail($aid);
        $this->g->template['list'] = $this->pinpaiCoverage->limit(9999)->order(array('actime'=>'desc'))->select();
        T(CONTROL_NAME.'/'.METHOD_NAME);
    }
    function expert(){
        T(CONTROL_NAME.'/'.METHOD_NAME);
    }
    function project(){
        header('Location:/admin/project');
        T(CONTROL_NAME.'/'.METHOD_NAME);
    }
    function _coverage_detail($aid){
        if(!$aid)$this->g->template['aid'] = 0;
        else{
            $m = $this->pinpaiCoverage->find($aid);
            if(!$m)header('Location:'.CONTROL_NAME.'/'.METHOD_NAME);
            $this->g->template['aid'] = $m['aid'];
        }
        T(CONTROL_NAME.'/'.METHOD_NAME.'_detail');
    }
    
/*
    get template when no method 
    
*/
    function _nomethod(){
        header('Location:'.CONTROL_NAME.'/introduction');
    }
    
    
/*

    save data by post

*/
    function save_expert(){
        $m = $this->save_opition('expert_desc');
        $this->success($m);
    }
    function save_introduction(){
        $m = $this->save_opition('introduction_desc');
        $this->success($m);
    }
    function save_project(){
        $m = $this->save_opition('project_desc');
        $this->success($m);
    }
    function save_coverage($aid){
        $_POST['adescription'] = post('adescription','',array($this,'_toraw'));
        if(!$aid){
            $_POST['actime'] = time();
            $m = $this->pinpaiCoverage->data($_POST)->add();
        }else 
        $m = $this->pinpaiCoverage->data($_POST)->save($aid);
        $this->success($m);
    }

/*
    get data 


*/
    function get_coverage($aid){
        if(!$aid)$m['adescription'] = '';
        else $m = $this->pinpaiCoverage->find($aid);
        $this->success($m);
    }
    function get_expert(){
        $m = $this->get_opition('expert_desc',1);
        $this->success($m);
    }
    function get_introduction(){
        $m = $this->get_opition('introduction_desc',1);
        $this->success($m);
    }
    function get_project(){
        $m = $this->get_opition('project_desc',1);
        $this->success($m);
    }
    
    
    
    function del_coverage($aid){
        $m = $this->pinpaiCoverage->remove($aid);
        $this->success($m);
    }
}