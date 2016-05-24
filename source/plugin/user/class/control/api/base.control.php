<?php
namespace plugin\user\control\api;
defined('IN_PLAY') || exit('Access Denied');
class base extends \control\ajax{
    function _beginning(){
        
    }
    protected function _get_ip(){
        return model('user:ip_content');
    }
    protected function _get_uid(){
        if($this->g->config['CHECK_IP']){
            $where = array();
            $where['ip'] = $this->g->config['ip'];
            $where['type'] = 'password';
            $where['time'] = array('logic',time()-900,'>');
            $c = $this->ip->where($where)->get_field('count(1)');
            if($c>4){
                header('Location: /404.html');die();
            }
        }
        
        $secury = post('login_secury');
        $time = time();
        if(!$secury)$secury = cookie('login_secury');
        if(!$secury)return 0;
        if(!$s = substr($secury,1))$this->error(405,'非法操作');
        if(!$s = base64_decode($s))$this->error(405,'非法操作');
        if(!$s = explode('|',$s))$this->error(405,'非法操作');
        list($uid,$until,$type,$md5) = $s;
        if($until!=0 && $until<$time){
            cookie('login_secury','',-3600);
            $this->error(101,'登入超时');
            return 0;
        }elseif(md5($uid.$until.$type.$this->g->config['LOGIN_SALT']) === $md5){
            $this->uid = $uid;
            $this->type = $type;
            return $uid;
        }    
        //echo md5($uid.$until.$type.$this->g->config['LOGIN_SALT']).'|'.$md5;
        return 0;
    }
    protected function _get_type(){
        return $this->uid ? $this->type : 0;
    }
    public function _safe_login(){
        if(!$this->uid)$this->error(406,'未登入');
    }
    public function _safe_type($r){
        $this->_safe_login();
        if($this->type<$r)$this->error(407,'未授权');
    }
}
?>