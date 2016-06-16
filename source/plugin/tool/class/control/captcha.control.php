<?php
namespace plugin\tool\control;
defined('IN_PLAY') || exit('Access Denied');
class captcha extends \control\ajax{
    function _beginning(){
        $this->checkAJAX = 0;
        //var_dump($this->uid);die();
    }
    function get_captcha(){
        $a = model('article')->find(1);
        //var_dump($a);
        $this->success('captcha');
    }
}
?>