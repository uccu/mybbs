<?php
namespace plugin\user\control\api;
defined('IN_PLAY') || exit('Access Denied');
class base extends \control\ajax{
    private function _get_g(){
        return table('config');
    }
    protected function _get_uid(){
        if($secury = cookie('login_secury'))if($s = substr($secury,1))if($s = base64_decode($s))if($s = explode('|',$s)){
            list($uid,$right,$uname,$time,$until,$md5) = $s;
            if($time<time()){
                cookie('login_secury','',2);
                return 0;
            }
            if(md5($uid . $right . $uname . $time . $until . $this->g->config['LOGIN_SALT']) === $md5){
                cookie('login_secury',$secury,$until);
                $this->uid = $uid;
                $this->right = $right;
                $this->uname = $uname;
                return $uid;
            }
        }
        return 0;
    }
    protected function _get_right(){
        return $this->uid ? $this->right : 0;
    }
    protected function _get_uname(){
         return $this->uid ? $this->uname : '';
    }
    public function _safe_login(){
        if(!$this->uid)$this->error('未登录');
    }
    public function _safe_right($r){
        $this->_safe_login();
        if($this->right<$r)$this->error('未授权');
    }
}
?>