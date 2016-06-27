<?php
namespace plugin\app\control;
defined('IN_PLAY') || die('Access Denied');
class Login extends api\ajax{
    
    
    //登录
    function login($phone,$pwd){
        //已经登录
        if($this->user->uid)$this->error(301,'已登入');

        //获取手机号和密码
        $phone = post('phone',$phone);$pwd = post('pwd',$pwd);
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
        $array['uid'] = $user['uid'];
        $this->success($array);
    }

    //登出
    function logout(){
        //删除cookie
        cookie('xm_secury','',-3600);
        $this->success();

    }

    //注册
    function register($phone,$pwd){
        //已经登录
        if($this->user->uid)$this->error(301,'已登入');

        //验证参数
        $phone = post('phone',$phone);
        $pwd = post('pwd',$pwd);
        if(!$phone || !$pwd)$this->error(401,'手机号和密码不能为空');
        if(!preg_match('/^1\d{10}$/',$phone))$this->error(402,'手机号格式不正确');
        if(!preg_match('/^.{6,16}$/',$pwd))$this->error(403,'密码长度不正确');

        //查找是否存在手机号
        if($this->coser->where(array('phone'=>$phone))->find())$this->error(302,'手机号已注册');

        //生成5位随机码
        $ss = 'abscefghijkimnopqrstuvwxyz1234567890';
        for($i=0;$i<5;$i++)$salt .=$ss[rand(0,35)];

        //单向加密密码
        $pwd = md5(md5($pwd).$salt);
        $data['phone'] = $phone;
        $data['password'] = $pwd;

        //其他属性设置默认值
        $data['ctime'] = TIME_NOW;
        $data['salt'] = $salt;
        $data['nickname'] = 'baka⑨';

        //创建用户
        if(!$rr = $this->coser->data($data)->add())$this->error(404,'创建失败');
        model('user_count')->data(array('uid'=>$rr))->add();
        model('user_live')->data(array('uid'=>$rr))->add();

        //输出用户id
        $this->success(array('uid'=>$rr));
        

    }
    function forgot($phone,$pwd,$captcha){
        //已经登录
        if($this->user->uid)$this->error(301,'已登入');

        //验证参数
        $phone = post('phone',$phone);
        $pwd = post('pwd',$pwd);
        $captcha = post('pwd',$captcha);
        if(!$phone || !$pwd)$this->error(401,'手机号和密码不能为空');
        if(!control('tool:captcha')->_check_captcha())$this->error(405,'验证码错误');
        //if(!preg_match('/^1\d{10}$/',$phone))$this->error(402,'手机号格式不正确');
        if(!preg_match('/^.{6,16}$/',$pwd))$this->error(403,'密码长度不正确');
       
        $where['phone'] = $phone;
        $coser = $this->coser->where($where)->find();
        if(!$coser)$this->error(406,'该用户未注册');
        $salt = $coser['salt'];
        //单向加密密码
        $pwd = md5(md5($pwd).$salt);
        $data['password'] = $pwd;
        $this->coser->where($where)->data($data)->save();
        $array['uid'] = $coser['uid'];
        $this->success($array);

    }
    function _nomethod(){
        $this->g->template['list'] = model('login_background')->limit(20)->order(array('bid'))->select();
        if($this->user->uid){
            header('Location:/app/myindex');die();
        }
        T();
    }
}




?>