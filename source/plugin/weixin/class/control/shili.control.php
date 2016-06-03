<?php
namespace plugin\weixin\control;
defined('IN_PLAY') || exit('Access Denied');
class shili extends \control\ajax{
    private $map = array(
        'person'=>'真人秀','compare'=>'前后对比','video'=>'视频实例'
    );
    function _beginning(){
        if(!$this->user->uid)header('Location:/weixin/index');

        $first = reset($map);
        if($this->map[$name])$this->g->template['subnav'] = "<script>subnav(".json_encode($this->map).",'person');</script>";
    }
    protected function _get_user(){
        return control('user:base','api');
    }

    function video(){

        T('shili/'.__FUNCTION__);
    }
    function compare(){
        T('shili/'.__FUNCTION__);
    }
    function person(){
        T('shili/'.__FUNCTION__);
    }

    function _nomethod(){
        $this->person();
    }
   
}