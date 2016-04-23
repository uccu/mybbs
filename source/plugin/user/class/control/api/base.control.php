<?php
namespace plugin\user\control\api;
defined('IN_PLAY') || exit('Access Denied');
class base extends \control\ajax{
    function _beginning(){
        //var_dump($this->uid);die();
    }
    private function _get_g(){
        return table('config');
    }
    protected function _get_uid(){
        if($secury = cookie('login_secury'))if($s = substr($secury,1))if($s = base64_decode($s))if($s = explode('|',$s)){
            list($uid,$right,$uname,$time,$until,$md5) = $s;
            if($time<time()){
                cookie('login_secury','',-3600);
                return 0;
            }
            elseif(md5($uid . $right . $uname . $time . $until . $this->g->config['LOGIN_SALT']) === $md5){
                $time = time();
                $rtime = $time + $until;
                $login_secury = 
                    $this->g->config['LOGIN_SALT'][rand(0,4)].
                    base64_encode(implode('|',array(
                        $uid,$right,$uname,$rtime,$until,
                        md5($uid.$right.$uname.$rtime.$until.$this->g->config['LOGIN_SALT'])
                    )));
                cookie('login_secury',$login_secury,$until);
                $this->uid = $uid;
                $this->right = $right;
                $this->uname = $uname;
                return $uid;
            }
        }
        if($userhash = post('userhash')){
            $where['hash'] = $userhash;
            $t = model('user:user_info')->tableMap_hash;
            $u = model('user:user_hash')->add_table($t)->where($where)->find();
            if(!$u)return 0;
            $this->uid = $u['uid'];
            $this->right = $u['right'];
            $this->uname = $u['uname'];
            return $this->uid;
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