<?php
namespace plugin\tool\control;
defined('IN_PLAY') || exit('Access Denied');
class captcha extends \control\ajax{
    function _beginning(){
        $this->checkAJAX = 0;
        //var_dump($this->uid);die();
    }
    function get_captcha($phone){
        $phone = post('phone',$phone);
        if(!preg_match('#^1\d{10}$#',$hpone))$this->error(500,'手机格式错误');
        $s = '';$a = '1234567890';
        for($i=0;$i<6;$i++){
            $s.=$a[rand(0,9)];
        }
        $z = file_get_contents ("https://sapi.253.com/msg/HttpBatchSendSM?account=VIP-lssm-1&pswd=Key-147852&mobile={$phone}&needstatus=false&msg=您好，您的验证码是：{$s}");
        $this->success();
    }
    function _check_captcha(){


        return true;
    }
}
?>