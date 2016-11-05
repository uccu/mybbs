<?php
namespace plugin\tool\control;
defined('IN_PLAY') || exit('Access Denied');
class captcha extends \plugin\app\control\base\basic{
    function _beginning(){
        $this->checkAJAX = 0;
        //var_dump($this->uid);die();
    }
    function get_captcha($phone){
        $phone = post('phone',$phone);
        if(!preg_match('#^1\d{10}$#',$phone))$this->error(500,'手机格式错误');
        $s = '';$a = '1234567890';
        for($i=0;$i<6;$i++){
            $s.=$a[rand(0,9)];
        }
        if(model('captcha_black')->where(array('ip'=>$this->g->ip))->find()){
            $this->errorCode(701);
        }
        $count = model('captcha_log')->where(array('ip'=>$this->g->ip,'ctime'=>array('logic',TIME_NOW-600,'>')))->get_field();
        model('captcha_log')->data(array(
            'phone'=>$phone,
            'captcha'=>$s,
            'ctime'=>TIME_NOW,
            'ip'=>$this->g->ip,
        ))->add();
        if($count>10){
            model('captcha_black')->data(array('ip'=>$this->g->ip))->add(true);
            $this->errorCode(701);
        }
        if($count>5){
            $this->errorCode(701);
        }
        
        $z['o'] = file_get_contents ("http://sapi.253.com/msg/HttpBatchSendSM?account=VIP-lssm-1&pswd=Key-147852&mobile={$phone}&needstatus=false&msg=您好，您的验证码是：{$s}");
        session_start();
        $_SESSION['captcha'] = $s;
        $_SESSION['phone'] = $phone;
        $z['new'] = model('user')->where(array('phone'=>$phone))->find() ? 0 : 1;
        $this->success($z);
    }
    function _check_captcha(){
        session_start();
        if($this->uid>0){
            if($this->userInfo['phone']!=$_SESSION['phone'])$this->error(501,'手机号与预留的手机号不同');
        }else{
            if($_POST['phone']!=$_SESSION['phone'])$this->error(502,'发送验证码手机号与注册手机号不同:');
        }
        if($_SESSION['captcha'] !== post('captcha',-1)){
            $this->error(501,'验证码错误');
        }

        return true;
    }


    function token_cc($uid){

        $info = model('user')->find($uid);
        $user_token = base64_encode(md5($info['password'].$this->salt2).'|'.$info['uid']);

        echo $user_token;

    }

    function push_cc($uid){
        $z = $this->_pusher('测试',$uid);
        
        var_dump($z);
    }
}
?>