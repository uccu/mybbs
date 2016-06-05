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
   
   
   
/*
    get template

*/
    function introduction(){
        T(CONTROL_NAME.'/'.METHOD_NAME);
    }
    function coverage(){
        T(CONTROL_NAME.'/'.METHOD_NAME);
    }
    function expert(){
        T(CONTROL_NAME.'/'.METHOD_NAME);
    }
    function project(){
        T(CONTROL_NAME.'/'.METHOD_NAME);
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


/*
    get data 


*/
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
}