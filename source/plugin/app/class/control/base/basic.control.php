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
        if(!$info)return '0';
        $this->userInfo = $info;
        return $md5 == md5($info['password'].$this->salt2) ? $uid : '0';
    }
    function _check_login(){
        if(!$this->uid)$this->errorCode(410);
    }
}
?>