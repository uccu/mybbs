<?php
namespace plugin\app\control\base;
defined('IN_PLAY') || exit('Access Denied');
class basic extends \control\ajax{
    protected $salt = 'zetga345';
    protected $salt2 = 'zetga3457';

    function errorCode($z){
        return control('code','error')->errorCode($z);
    }
    // function __construct(){
    //     call_user_func_array(array(parent,'__construct'),func_get_args());
    // }
    function session_start(){
        if(!$this->g->session){
            $this->g->session = 1;
            session_start();
        }
        return true;
    }
    function _get_uid(){
        $user_token = cookie('user_token',post('user_token'));
        if(!is_string($user_token) || !$user_token)return '0';
        $e = base64_decode($user_token);
        if(!$e)return '0';
        list($md5,$uid) = explode('|',$e);
        if(!$uid || !$md5)return '0';
        $info = model('user')->find($uid);
        $this->userInfo = $info;
        if(!$info)return '0';
        $this->userInfo = $info;
        return $md5 == md5($info['password'].$this->salt2) ? $uid : '0';
    }
    function _get_userInfo(){
        return array();
    }
    
    function _get_aid(){
        $now = TIME_NOW;
        $where['zz'] = "stime<$now AND etime>$now";
        $z = model('activity')->where($where)->find();
        if(!$z)$this->errorCode(419);
        return $z ? $z['aid'] : 0;
    }
    function _get_lastAid(){
        $now = TIME_NOW;
        $where['zz'] = "stime<$now AND etime>$now";
        $z = model('activity')->where($where)->find();
        if($z)return $z['aid'];
        $where['etime'] = array('logic',$now,'<');
        $z = model('activity')->where($where)->find();
        if(!$z)$this->errorCode(419);
        return $z ? $z['aid'] : 0;
    }
    function _check_login(){
        if(!$this->uid)$this->errorCode(410);
    }
    function _get_microtime(){
        list($usec, $sec) = explode(" ", microtime());
        return $usec + $sec;
    }
    function _get_today(){
        return strtotime(date('Y-m-d',TIME_NOW));
    }
    function _get_yesterday(){
        return $this->today-24*3600;
    }
    function _check_tid($tid,$aid=false){
        $where['tid'] = $tid;
        $where['del'] = 1;
        if(!$z = model('goods')->add_table(array(
            'goods_attribute'=>array(
                'attribute_name','_on'=>'lid'
            )
        ))->where($where)->find())$this->errorCode(411);
        if($aid){
            $w['aid'] = $aid;
            $w['tid'] = $tid;
            if(!model('activity_list')->where($where)->find())$this->errorCode(423);
        }
        return $z;
    }
    function _pusher($content='测试~',$uid=0){
        if(!$uid){
            $uid = $this->uid;
            if(!$uid)return false;
            if(!$this->userInfo['push'])return false;
        }else{
            $userInfo = model('user')->find($uid);
            if(!$userInfo)return false;
            if(!$userInfo['push'])return false;
        }
        require_once(PLUGIN_ROOT."tool/class/control/JPush/JPush.php");
        $client = new \JPush('6505eff9f988de697771e58b', '29a604d9acbeba974b11d3c6');
        $result = $client->push()
            ->setPlatform('all')
            ->addAlias('A'.$uid)
            ->setNotificationAlert($content)
            ->send();
    }
}
?>