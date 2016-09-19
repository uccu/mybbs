<?php
namespace plugin\admin\control;
defined('IN_PLAY') || exit('Access Denied');
class login extends \control\ajax{
    function _beginning(){
        if($this->user->uid)header('Location:/admin/index');
        else T();
    }
    protected function _get_user(){
        return control('user:base','api');
    }
   
}