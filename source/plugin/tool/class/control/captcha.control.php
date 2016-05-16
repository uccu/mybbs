<?php
namespace plugin\tool\control;
defined('IN_PLAY') || exit('Access Denied');
class captcha extends \control\ajax{
    function _beginning(){

    }
    function get_captcha(){
        $this->success();
    }
    function _check_captcha($a){
        return true;
    }
}
?>


