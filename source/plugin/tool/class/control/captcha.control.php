<?php
namespace plugin\tool\control;
defined('IN_PLAY') || exit('Access Denied');
class captcha extends \plugin\app\control\base\e{
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
        $data['captcha'] = $s;
        $data['usercode'] = $usercode;
        $data['ip'] = $this->g->ip;
        model('captcha')->data($data)->add();


        $ch=curl_init();
		$headers = array();
        $headers[] = 'X-Apple-Tz: 0';
        $headers[] = 'X-Apple-Store-Front: 143444,12';
        $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
        $headers[] = 'Accept-Encoding: gzip, deflate';
        $headers[] = 'Accept-Language: en-US,en;q=0.5';
        $headers[] = 'Cache-Control: no-cache';
        $headers[] = 'Content-type:text/xml; charset=utf-8';
        $headers[] = 'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0';
        $headers[] = 'X-MicrosoftAjax: Delta=true';
		$p = '<?xml version="1.0" encoding="utf-8"?>
<mtpacket>
  <cpid>4205</cpid>
  <userpass>4370b00a2465a841f4a7103468b3a7cf</userpass>
  <port>512010</port>
  <cpmid>0'.time().'</cpmid>
  
  <mobile><![CDATA['.$usercode.']]></mobile>
  <message><![CDATA[【运维卫士】您好：本次验证码是'.$s.'，请妥善保管，勿泄露给他人！]]></message>
  <respDataType>JSON</respDataType>
</mtpacket>';

        curl_setopt($ch, CURLOPT_URL, 'http://api.ict-china.com/do/smsApi!mt.shtml');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($p));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $p);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$output = curl_exec($ch);
		curl_close($ch);



        // session_start();
        // $_SESSION['captcha'] = $s;
        // $_SESSION['usercode'] = $usercode;
        
        $z['new'] = model('user')->where(array('usercode'=>$usercode))->find() ? 0 : 1;
        $this->success($z);
    }
    function _check_captcha(){
        //session_start();
        $where['ip'] = $this->g->ip;
        $c = model('captcha')->where($where)->order(array('ctime'=>'DESC'))->find();
        if(!$c)$this->error(501,'验证码错误');
        if($this->uid>0){
            if($this->userInfo['usercode']!=$c['usercode'])$this->error(501,'手机号与预留的手机号不同');
        }else{
            if($_POST['usercode']!=$c['usercode']){
                $this->error(502,'发送验证码手机号与操作手机号不同'.$_POST['usercode'].'/'.$c['usercode']);
            }
        }
        if($c['captcha'] !== post('captcha',-1)){
            $this->error(501,'验证码错误');
        }
        return true;
    }
}
?>