<?php
namespace plugin\tool\control;
defined('IN_PLAY') || exit('Access Denied');
class captcha extends \control\ajax{
    function _beginning(){

    }
    function _get_user(){
        return control('user:base','api');
    }
    function get_captcha(){
        $this->success();
    }
    function _check_captcha($a){
        return true;
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
    function _pusher($uid,$content='您的用户更新了日记哟~'){
        require_once(PLUGIN_ROOT."tool/class/control/JPush/JPush.php");
        $client = new \JPush('7ad3174f8cec5f0f533d7905', 'd5e374d771a1a7fb6023b1b6');
        $result = $client->push()
            ->setPlatform('all')
            ->setAudience(array('A'.$uid))
            ->setNotificationAlert($content)
            ->send();
        $this->success(json_encode($result));

    }
}
?>