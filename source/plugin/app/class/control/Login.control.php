<?php
namespace plugin\app\control;
defined('IN_PLAY') || die('Access Denied');
class Login extends api\ajax{
    
    
    //登录
    function login(){
        //已经登录
        if($this->user->uid)$this->error(301,'已登入');

        //获取手机号和密码
        $phone = post('phone','');$pwd = post('pwd','');
        if(!$phone || !$pwd)$this->error(401,'参数错误');

        //查找用户
        $where['phone'] = $phone;
        $user = $this->coser->where($where)->find();
        if(!$user)$this->error(402,'该用户未注册');

        //验证密码
        if(md5(md5($pwd).$user['salt'])!==$user['password'])$this->error(403,'密码错误');

        //增加cookie
        $uid = $user['uid'];
        $until = post('until',0,'%d');
        $salt = 'QWERTYUIOPASDFGHJKLZXCVBNM';
        $login_secury = $salt[rand(0,20)].base64_encode(implode('|',array($uid,$until,$time,md5($uid.$until.$time.$this->g->config['LOGIN_SALT']))));
        cookie('xm_secury',$login_secury,$until?$until-TIME_NOW:0);

        //输出成功
        $this->success();
    }

    //登出
    function logout(){
        cookie('xm_secury','',-3600);
        $this->success();

    }
}




?>