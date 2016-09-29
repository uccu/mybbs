<?php
namespace plugin\tool\control;
defined('IN_PLAY') || exit('Access Denied');
class captcha extends \plugin\app\control\base\basic{
    function _beginning(){
        $this->checkAJAX = 0;
        //var_dump($this->uid);die();
    }
    function get_captcha($usercode){
        $usercode = post('usercode',$usercode);
        if(!preg_match('#^1\d{10}$#',$usercode))$this->error(500,'手机格式错误');
        $s = '';$a = '1234567890';
        for($i=0;$i<6;$i++){
            $s.=$a[rand(0,9)];
        }
        //$z['o'] = file_get_contents ("https://sapi.253.com/msg/HttpBatchSendSM?account=VIP-lssm-1&pswd=Key-147852&mobile={$usercode}&needstatus=false&msg=您好，您的验证码是：{$s}");
        session_start();
        $_SESSION['captcha'] = $s;
        $_SESSION['usercode'] = $usercode;
        $z['new'] = model('user')->where(array('usercode'=>$usercode))->find() ? 0 : 1;
        $this->success($z);
    }
    function _check_captcha(){
        session_start();
        if($this->uid>0){
            if($this->userInfo['usercode']!=$_SESSION['usercode'])$this->error(501,'手机号与预留的手机号不同');
        }else{
            if($_POST['usercode']!=$_SESSION['usercode'])$this->error(502,'发送验证码手机号与注册手机号不同:');
        }
        // if($_SESSION['captcha'] !== post('captcha',-1)){
        //     $this->error(501,'验证码错误');
        // }
        return true;
    }
}
?>