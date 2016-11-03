<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class in extends base\e{
    private $cookie=false;
    function _beginning(){
        
    }
    function _check_usercode($z){
        if(!is_string($z))$this->errorCode(700);

        if(!preg_match('#^1\d{10}$#',$z)){
            $this->errorCode(407);
        }
        return $z;
    }
    function _check_password($z){
        if(!is_string($z))$this->errorCode(700);
        if(strlen($z)<6)$this->errorCode(406);
        return $z;
    }
    function login($usercode,$password,$cookie){
        $password = post('password',$password);
        $usercode = post('usercode',$usercode);
        $where['usercode'] = $usercode;
        if($cookie = post('cookie',$cookie)){
            $this->cookie = true;
        }

        $info = model('user')->where($where)->find();
        if(!$info)$this->errorCode(401);
        if(md5(md5($password).$this->salt)!=$info['password'])$this->errorCode(402);
        $this->_out_info($info,$this->cookie);
    }
    function login_third(){
        $type = post('platform');
        $value = post('key','');
        if(!$value)$this->errorCode(404);
        if($type=='qq'){
            $where['qq'] = $value;
        }elseif($type=='wb'){
            $where['wb'] = $value;
        }elseif($type=='wx'){
            $where['wx'] = $value;
        }else{
            $this->errorCode(403);
        }
        if(!$value)$this->errorCode(403);
        $info = model('user')->where($where)->find();
        if(!$info){
            $info = $where;
            $info['password'] = md5(time());
            $info['type'] = 0;
            $this->_add_user($info);
        }
        $this->_out_info($info,$this->cookie);
    }
    function bind(){
        $this->_check_login();
        $uid = $this->uid;
        $type = post('platform','');
        $value = post('key','');
        if($type=='qq'){
            $data['qq'] = $value;
        }elseif($type=='wb'){
            $data['wb'] = $value;
        }elseif($type=='wx'){
            $data['wx'] = $value;
        }elseif(preg_match('#^1\d{10}$#',$type)){
            $usercode = $type;
            if(model('user')->where(array('usercode'=>$usercode))->find()){
                $this->errorCode(405);
            }
            $password = post('password','');
            $this->_check_password($password);
            $password = md5(md5($password).$this->salt);
            $data['password'] = $password;
            $data['usercode'] = $usercode;
            control('tool:captcha')->_check_captcha();
        }else{
            $this->errorCode(403);
        }
        if(!$value)$this->errorCode(403);
        $z = model('user')->data($data)->save($uid);
        $info = model('user')->find($uid);
        $this->_out_info($info,$this->cookie);
    }

    function unbind(){
        $this->_check_login();
        $uid = $this->uid;
        $type = post('platform','');
        if($type=='qq'){
            $data['qq'] = '';
        }elseif($type=='wb'){
            $data['wb'] = '';
        }elseif($type=='wx'){
            $data['wx'] = '';
        }else{
            $this->errorCode(403);
        }
        $z = model('user')->data($data)->save($uid);
        if(!$z)$this->errorCode(409);
        $this->success();
    }

    function register($usercode,$password){
        $usercode = post('usercode',$usercode);
        $this->_check_usercode($usercode);
        if($cookie = post('cookie',$cookie)){
            $this->cookie = true;
        }
        if(model('user')->where(array('usercode'=>$usercode))->find()){
            $this->errorCode(405);
        }
        control('tool:captcha')->_check_captcha();
        $password = post('password',$password);
        $this->_check_password($password);
        $password = md5(md5($password).$this->salt);

        $info['usercode'] = $usercode;
        $info['password'] = $password;
        $info['type'] = '-1';
        $this->_add_user($info);
    }
    function _add_user($info){
        $info['ctime'] = time();
        if(!$info['usercode'])$info['usercode']='';
        $info['nickname'] = $info['usercode'];
        $info['terminal'] = post('terminal','');
        $z = model('user')->data($info)->add();
        if(!$z)$this->errorCode(409);
        $info['uid'] = (string)$z;
        $info['news'] = "1";

        $this->_out_info($info,$this->cookie);

    }
    function _out_info($info,$cookie = false){
        $user_token = base64_encode(md5($info['password'].$this->salt2).'|'.$info['uid']);
        if($cookie)cookie('user_token',$user_token,0);

        $o = $this->_getCloudToken($info['uid']);

        $out = array(
            'user_token'=>$user_token,
            'uid'=>$info['uid'],
            'news'=>$info['news']?"1":"0",
            'type'=>$info['type'],
            'apply'=>$info['apply']?$info['apply']:"0",
            'complete'=>$info['complete']?"1":"0",
            'vip'=>$info['vip']?$info['vip']:"0",
            'isvip'=>$info['vip']>TIME_NOW?'1':"0",
            'qust'=>$info['qust']?$info['qust']:'3',
            //'huan'=>$o
        );
        
        $this->success($out);

    }
    function logout(){
        cookie('user_token',$user_token,-1);
        $this->success();
    }
    function forget($usercode,$password){
        $usercode = post('usercode',$usercode);
        $this->_check_usercode($usercode);
        if(!$info = model('user')->where(array('usercode'=>$usercode))->find()){
            $this->errorCode(401);
        }
        control('tool:captcha')->_check_captcha();
        $password = post('password',$password);
        $this->_check_password($password);
        $password = md5(md5($password).$this->salt);
        $save = model('user')->data(array('password'=>$password))->save($info['uid']);
        $this->_out_info($info);
        
    }
}
?>