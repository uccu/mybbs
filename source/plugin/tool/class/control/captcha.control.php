<?php
namespace plugin\tool\control;
defined('IN_PLAY') || exit('Access Denied');
class captcha extends \control\ajax{
    function _beginning(){
        $this->checkAJAX = 0;
        //var_dump($this->uid);die();
    }
    function get_captcha(){
        $ss = 'abscefghijkimnopqrstuvwxyz1234567890';
        for($i=0;$i<5;$i++)$s .=$ss[rand(0,35)];
        cookie('captcha',base64_encode($s),0);
        $this->success($s);
    }
    function _check_captcha(){
        if(base64_decode(cookie('captcha'))!=$_POST['captcha'])return false;
        return true;
    }
}
?>