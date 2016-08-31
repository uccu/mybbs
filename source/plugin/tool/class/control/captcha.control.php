<?php
namespace plugin\tool\control;
defined('IN_PLAY') || exit('Access Denied');
class captcha extends \control\ajax{
    function _beginning(){
        $this->checkAJAX = 0;
        //var_dump($this->uid);die();
    }
    function get_captcha(){
        $out = array(
            'captcha'=>'1234'
        );
        $this->success($out);
    }
    function _check_captcha(){


        return true;
    }
}
?>