<?php
namespace plugin\weixin\control;
defined('IN_PLAY') || exit('Access Denied');
class hudong extends ab\ab{
    function _get_map(){
        return array(
            'question'=>'我要咨询','activity'=>'优惠活动','apptro'=>'APP介绍','register'=>'注册送好礼'
        );
    }
    
    
    function _app_activity(){
        $this->g->template['content'] = $this->get_opition('activity_desc');
        T('_static');
    }
    function _app_apptro(){
        $this->g->template['content'] = $this->get_opition('apptro_desc');
        T('_static');
    }
    function _app_register(){
        $this->g->template['content'] = $this->get_opition('register_desc');
        T('_static');
    }
    function _app_question(){
       
         T(CONTROL_NAME.'/question');
    }
    function up(){
        if(!$_POST['name'])$this->error(400,'姓名为空');
        if(!$_POST['phone'])$this->error(400,'手机为空');
        if(!preg_match("/\d+/",$_POST['phone']))$this->error(400,'手机格式不对');
        if(!$_POST['content'])$this->error(400,'留言为空');
        $_POST['ftime'] = time();
        $this->feedback->data($_POST)->add();
        $this->success();
    }
    
    function question($detail=1,$fid=0){
        if($detail=='detail')return $this->_question_detail($fid);
        $page = $detail;$limit = 10;
        $maxRow= $this->feedback->limit(99999999)->get_field();
        $maxPage = floor(($maxRow-1)/10)+1;
        $this->g->template['maxRow'] = $maxRow;
        $this->g->template['maxPage'] = $maxPage;
        $this->g->template['currentPage'] = $page;
        $this->g->template['list'] = $this->feedback->page($page,$limit)->order(array('fid'=>'desc'))->select();
        
        T(CONTROL_NAME.'/'.METHOD_NAME);
    }
    function activity(){
        T(CONTROL_NAME.'/'.METHOD_NAME);
    }
    function apptro(){
        T(CONTROL_NAME.'/'.METHOD_NAME);
    }
    function register(){
        T(CONTROL_NAME.'/'.METHOD_NAME);
    }
    function _question_detail($fid){
        $m = $this->feedback->find($fid);
        if(!$m)header('Location:'.CONTROL_NAME.'/'.METHOD_NAME);
        $this->g->template['fid'] = $m['fid'];
        T(CONTROL_NAME.'/'.METHOD_NAME.'_detail');
    }
    
    

    function _nomethod(){
        header('Location:'.CONTROL_NAME.'/question');
    }
    
    
    
    
    function save_activity(){
        $m = $this->save_opition('activity_desc');
        $this->success($m);
    }
    function save_apptro(){
        $m = $this->save_opition('apptro_desc');
        $this->success($m);
    }
    function save_register(){
        $m = $this->save_opition('register_desc');
        $this->success($m);
    }
    
    
    
    
    function get_question($fid){
        $m = $this->feedback->find($fid);
        $this->success($m);
    }
    function get_register(){
        $m = $this->get_opition('register_desc',1);
        $this->success($m);
    }
    function get_apptro(){
        $m = $this->get_opition('apptro_desc',1);
        $this->success($m);
    }
    function get_activity(){
        $m = $this->get_opition('activity_desc',1);
        $this->success($m);
    }
    
    
    
    function del_question($id){
        $m = $this->feedback->remove($id);
        $this->success($m);
    }
   
}