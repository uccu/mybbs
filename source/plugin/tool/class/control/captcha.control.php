<?php
namespace plugin\tool\control;
defined('IN_PLAY') || exit('Access Denied');
class captcha extends \control\ajax{
    function _beginning(){

    }
    function _get_user(){
        return control('user:base','api');
    }
    function get_captcha($phone=''){
		$code = rand(1000,9999);
		$phone = post('phone',$phone);
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
  <cpid>4149</cpid>
  <userpass>4764782a16498b3fa3c5c4871c83b137</userpass>
  <port>531800</port>
  <cpmid>0'.time().'</cpmid>
  
  <mobile><![CDATA['.$phone.']]></mobile>
  <message><![CDATA[【塔莉亚】您好：本次验证码是'.$code.'，请妥善保管，勿泄露给他人！]]></message>
  <respDataType>JSON</respDataType>
</mtpacket>';
/*$p = '<?xml version="1.0" encoding="utf-8"?>
<property>
  <cpid>10003</cpid>
  <userpass>D5CDFHDFHDF82FE4EB6</userpass>
  <port>188</port>
  <respDataType>JSON</respDataType>
</property>
';*/
        curl_setopt($ch, CURLOPT_URL, 'http://api.ict-china.com/do/smsApi!mt.shtml');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($p));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $p);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$output = curl_exec($ch);
		curl_close($ch);
        session_start();
		$_SESSION['captcha'] = $code;
		$z = json_decode($output,true);
		$z['phone'] = $phone;
        $this->success($z);
    }
    function _check_captcha($a){
		session_start();
		if($_SESSION['captcha']==$a)
        return true;
		else $this->error(501,'验证码错误');
    }
    function _get_setting(){
        return model('user:score_setting');
    }
    function get_my_qrcode(){
            include PLUGIN_ROOT."tool/class/control/qr/qrlib.php";    
            //header("Content-type: image/png");
            $uid = $this->user->uid;
            $dir = PLAY_ROOT.'pic/qrcode/';
            if($uc<10000)$fe1 = 0;else $fe1 = ($uid-$uid%10000)/10000;
            if($uc<100)$fe2 = 0;else $fe2 = ($uid%10000-$uid%100)/100;
            if(!is_dir(PLAY_ROOT.'pic/qrcode'))mkdir(PLAY_ROOT.'pic/qrcode');
            if(!is_dir($dir.$fe1))mkdir($dir.$fe1);
            if(!is_dir($dir.$fe1.'/'.$fe2))mkdir($dir.$fe1.'/'.$fe2);
            \QRcode::png($this->g->config['BASE_URL'].'user/share/'.$uid, $dir.$fe1.'/'.$fe2.'/'.$uid.'.png', 'H', 8, 2);
            $array = array('url'=>'qrcode/'.$fe1.'/'.$fe2.'/'.$uid.'.png');
            $array['uid'] = $uid;
            $array['content'] = '分享好友可获得'.$this->setting->score('register_friend').'点积分';
            $this->success($array);
    }
    function pusher($content='亲~~该写日记了！'){
        require_once(PLUGIN_ROOT."tool/class/control/JPush/JPush.php");
        $client = new \JPush('a152f7c45e9b75f25692cbc2', 'c77c6c2b49f0f86eadef42f7');
        $result = $client->push()
            ->setPlatform('all')
            ->addAllAudience()
            ->setNotificationAlert($content)
            ->send();
        $this->success(json_encode($result));

    }
    function pusher_test($content='推送测试~~'){
        require_once(PLUGIN_ROOT."tool/class/control/JPush/JPush.php");
        $client = new \JPush('a152f7c45e9b75f25692cbc2', 'c77c6c2b49f0f86eadef42f7');
        $result = $client->push()
            ->setPlatform('all')
            ->addAlias('A25')
            ->setNotificationAlert($content)
            ->send();
        $this->success(json_encode($result));

    }
    function _pusher($uid,$content='您的用户更新了日记哟~'){
        if(!$uid)return false;
        require_once(PLUGIN_ROOT."tool/class/control/JPush/JPush.php");
        $client = new \JPush('7ad3174f8cec5f0f533d7905', 'd5e374d771a1a7fb6023b1b6');
        $result = $client->push()
            ->setPlatform('all')
            ->addAlias('A'.$uid)
            ->setNotificationAlert($content)
            ->send();
        //$this->success(json_encode($result));

    }
}
?>