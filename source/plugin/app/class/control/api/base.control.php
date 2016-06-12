<?php
namespace plugin\app\control\api;
defined('IN_PLAY') || exit('Access Denied');
class base extends \control\ajax{
    function _beginning(){
        
    }

    protected function _get_uid(){
        //获取cookie
        $secury = cookie('xm_secury');

        //基础验证cookie
        if(!$secury)return 0;
        if(!$s = substr($secury,1))return 0;
        if(!$s = base64_decode($s))return 0;
        if(!$s = explode('|',$s))return 0;
        list($uid,$until,$time,$md5) = $s;

        //验证过期时间
        if($until!=0 && $until<$time){
            cookie('xm_secury','',-3600);return 0;
        }elseif(md5($uid.$until.$time.$this->g->config['LOGIN_SALT']) === $md5){
            $this->type = $type;return $uid;
        }
        return 0;
    }

    public function _safe_login(){
        if(!$this->uid)$this->error(406,'未登入');
    }
    
}
?>