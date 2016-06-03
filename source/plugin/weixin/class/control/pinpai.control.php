<?php
namespace plugin\weixin\control;
defined('IN_PLAY') || exit('Access Denied');
class pinpai extends \control\ajax{
    function _beginning(){
        if(!$this->user->uid)header('Location:/weixin/index');
        //rand(100000, 2094967294);
    }
    protected function _get_user(){
        return control('user:base','api');
    }
   
   
    function introduction(){
        T('pinpai/introduction');
    }
    function coverage(){
        T('pinpai/coverage');
    }
    function expert(){
        T('pinpai/expert');
    }
    function project(){
        T('pinpai/project');
    }
    function _nomethod(){
        $this->introduction();
    }
   
}