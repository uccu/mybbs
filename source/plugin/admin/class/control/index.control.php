<?php
namespace plugin\admin\control;
defined('IN_PLAY') || exit('Access Denied');
class index extends \control\ajax{
    function _beginning(){
        if($this->user->type<2)header('Location:/admin/login');
        table('config')->template['userType'] = $this->user->type;T();
    }
    protected function _get_user(){
        return control('user:base','api');
    }
    protected function _get_model(){
        return model('user:user_info');
    }
    protected function _get_ip(){
        return model('user:ip_content');
    }
    protected function _get_captcha(){
        return control('tool:captcha');
    }

}