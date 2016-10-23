<?php
namespace plugin\app\control\base;
defined('IN_PLAY') || exit('Access Denied');
class e extends \control\ajax{
    protected $salt = 'zetga145';
    protected $salt2 = 'zetga1457';

    function errorCode($z){
        return control('code','error')->errorCode($z);
    }
    function __construct(){
        $this->uid;
        call_user_func_array(array(parent,'__construct'),func_get_args());
    }
    function session_start(){
        if(!$this->g->session){
            $this->g->session = 1;
            session_start();
        }
        return true;
    }
    function _get_uid(){
        $user_token = cookie('user_token',post('user_token'));
        if(!is_string($user_token) || !$user_token)return '-1';
        $e = base64_decode($user_token);
        if(!$e)return '-2';
        list($md5,$uid) = explode('|',$e);
        if(!$uid || !$md5)return '-3';
        $info = model('user')->find($uid);
        $this->userInfo = $info;
        if(!$info)return '-4';
        $this->userInfo = $info;

        return $md5 == md5($info['password'].$this->salt2) ? $uid : '-5';
    }
    function _get_userInfo(){
        $this->uid;
        return $this->userInfo;
    }
    function _check_type($type){
        if($this->uid<1)$this->errorCode(411);
        if($this->userInfo['type']!=$type)$this->errorCode(411);
        return true;
    }
    function _check_uid($uid){
        $z = model('user')->find($uid);
        if(!$z)$this->errorCode(414);
        return $z;
    }
    function _check_access(){
        $access = post('access');
        //
        //
        $this->_check_vip();
    }
    function _city_name($id = 0){
        $c = model('manager_organ')->find($id);
        if(!$c)return '';
        if(!$c['bid'])return $c['jgmc'];
        $p = model('manager_organ')->find($c['bid']);
        if(!$p)return $c['jgmc'];
        return $p['jgmc'].' - '.$c['jgmc'];
    }
    function _equip_name($id = 0){
        $c = model('equipment_list')->find($id);
        if(!$c)return '';
        if(!$c['bid'])return $c['name'];
        $p = model('equipment_list')->find($c['bid']);
        if(!$p)return $c['name'];
        return $p['name'].' - '.$c['name'];
    }
    function _dateline_format(&$data,$key){
        if(!$data[$key])$data[$key] = post($key,0);
        if(!is_numeric($data[$key]))$data[$key] = strtotime($data[$key]);
    }
    function _equip_name_m($id = ''){
        $array = explode(';',$id);
        $where['id'] = array('contain',$array,'IN');
        $z = model('equipment_list')->where($where)->limit(99)->select('name');
        return implode(';',array_keys($z));
    }
    function _check_follow($uid){
        return model('fans')->where(array('uid'=>$uid,'fans_id'=>$this->uid))->find() ? 1 : 0;
    }

    function _check_fans($uid){
        return model('fans')->where(array('fans_id'=>$uid,'uid'=>$this->uid))->find() ? 1 : 0;
    }
    
    function _check_vip(){
        if($this->userInfo['vip']<TIME_NOW)$this->errorCode(412);
    }
    
    function _check_login(){
        if(!$this->uid || $this->uid<0)$this->errorCode(410,$this->uid);
    }
    function _get_microtime(){
        list($usec, $sec) = explode(" ", microtime());
        return (string)(floor(((float)$usec + (float)$sec)*1000)/1000);
    }
    function _get_today(){
        return strtotime(date('Y-m-d',TIME_NOW));
    }
    function _get_yesterday(){
        return $this->today-24*3600;
    }
    
    // function _pusher($content='测试~',$uid=0){
    //     if(!$uid){
    //         $uid = $this->uid;
    //         if(!$uid)return false;
    //         if(!$this->userInfo['push'])return false;
    //     }else{
    //         $userInfo = model('user')->find($uid);
    //         if(!$userInfo)return false;
    //         if(!$userInfo['push'])return false;
    //     }
    //     require_once(PLUGIN_ROOT."tool/class/control/JPush/JPush.php");
    //     $client = new \JPush('6505eff9f988de697771e58b', '29a604d9acbeba974b11d3c6');
    //     $result = $client->push()
    //         ->setPlatform('all')
    //         ->addAlias('A'.$uid)
    //         ->setNotificationAlert($content)
    //         ->send();
    // }
}
?>