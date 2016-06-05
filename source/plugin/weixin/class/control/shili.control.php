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
    
    
/*
    get template

*/
    function video(){

        T(CONTROL_NAME.'/'.METHOD_NAME);
    }
    function compare(){
        T(CONTROL_NAME.'/'.METHOD_NAME);
    }
    function person(){
        T(CONTROL_NAME.'/'.METHOD_NAME);
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
    
    
    
/*
    get data 


*/
    function get_person(){
        $m = $this->get_opition('person_desc',1);
        $this->success($m);
    }
    function get_compare(){
        $m = $this->get_opition('compare_desc',1);
        $this->success($m);
    }

   
}