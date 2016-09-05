<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class in extends base\basic{
    
    function _beginning(){
        
    }
    function _check_phone($z){
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
    function login($phone,$password){
        $password = post('password',$password);
        $phone = post('phone',$phone);
        $where['phone'] = $phone;
        $info = model('user')->where($where)->find();
        if(!$info)$this->errorCode(401);
        if(md5(md5($password).$this->salt)!=$info['password'])$this->errorCode(402);
        $this->_out_info($info,true);
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
            $this->_add_user($info);
        }
        $this->_out_info($info,true);
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
            $phone = $type;
            if(model('user')->where(array('phone'=>$phone))->find()){
                $this->errorCode(405);
            }
            $password = post('password','');
            $this->_check_password($password);
            $password = md5(md5($password).$this->salt);
            $data['password'] = $password;
            $data['phone'] = $phone;
        }else{
            $this->errorCode(403);
        }
        if(!$value)$this->errorCode(403);
        $z = model('user')->data($data)->save($uid);
        $info = model('user')->find($uid);
        $this->_out_info($info,true);
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

    function register(){
        $phone = post('phone','');
        $this->_check_phone($phone);
        if(model('user')->where(array('phone'=>$phone))->find()){
            $this->errorCode(405);
        }
        control('tool:captcha')->_check_captcha();
        $password = post('password','');
        $this->_check_password($password);
        $password = md5(md5($password).$this->salt);
        if($referee = post('referee','0')){
            if(!model('user')->find($referee))$this->errorCode(408);
            $info['referee'] = $referee;
        }
        $info['phone'] = $phone;
        $info['password'] = $password;
        $this->_add_user($info);
    }
    function _add_user($info){
        $info['ctime'] = time();
        $info['username'] = '用户_'.$info['ctime'];
        $z = model('user')->data($info)->add();
        if(!$z)$this->errorCode(409);
        $info['uid'] = $z;
        $this->_out_info($info,true);

    }
    function _out_info($info,$cookie = false){
        $user_token = base64_encode(md5($info['password'].$this->salt2).'|'.$info['uid']);
        if($cookie)cookie('user_token',$user_token,0);
        $out = array(
            'user_token'=>$user_token
        );
        $this->success($out);

    }
    function logout(){
        cookie('user_token',$user_token,-1);
        $this->success();
    }
    function forget(){
        $phone = post('phone','');
        $this->_check_phone($phone);
        if(!$info = model('user')->where(array('phone'=>$phone))->find()){
            $this->errorCode(401);
        }
        control('tool:captcha')->_check_captcha();
        $password = post('password','');
        $this->_check_password($password);
        $password = md5(md5($password).$this->salt);
        $save = model('user')->data(array('password'=>$password))->save($info['uid']);
        $this->_out_info($info);
        
    }

}
?>