<?php
namespace plugin\user\control;
defined('IN_PLAY') || exit('Access Denied');
class ajax extends \control\ajax{
    private function _get_g(){
        //$this->g->config['LOGIN_SALT']
        return table('config');
    }
    function _get_user(){
        return control('user:base','api');
    }
    function _get_model(){
        return model('user:user_info');
    }
    function login(){
        $lname = post('lname','');
        $pwd = post('pwd','');
        if(!$lname || !$pwd)$this->error('参数错误');
        $time = time();
        $where['lname'] = $lname;
        $user = $this->model->where($where)->find();
        if(!$user)$this->error('无用户');
        if(md5($pwd.$user['salt'])===$user['password']){
            $data['ip'] = $_SERVER["REMOTE_ADDR"];
            $data['lasttime'] = $time;
            $this->model->data($data)->save($user['uid']);
        }else $this->error('密码错误');
        
        $uid = $user['uid'];
        $uname = $user['uname'];
        $right = $user['right'];
        
        $until = post('until',1800,'%d');
        $rtime = $time + $until;
        $login_secury = 
            $this->g->config['LOGIN_SALT'][rand(0,4)].
            base64_encode(implode('|',array(
                $uid,$right,$uname,$rtime,$until,
                md5($uid.$right.$uname.$rtime.$until.$this->g->config['LOGIN_SALT'])
            )));
        cookie('login_secury',$login_secury,$until);
        return $this->success(1);
    }
    function logout(){
        cookie('login_secury','',-3600);
        return $this->success(1);
    }
    function create(){
        if($this->user->uid)
            $this->error('已登入');
        $lname = post('lname','');
        $pwd = post('pwd','');
        $uname = post('uname','');
        $email = post('email','');
        $captcha = post('captcha','');
        if(!$lname || !$pwd || !$uname || !$email || !$captcha)
            $this->error('参数错误');
        if($this->model->where(array('lname'=>$lname))->find())
             $this->error('lname错误');
        if($this->model->where(array('uname'=>$lname))->find())
             $this->error('uname错误');
        if($this->model->where(array('email'=>$lname))->find())
             $this->error('email错误');
        $ss = 'abscefghijkimnopqrstuvwxyz1234567890';
        for($i=0;$i<4;$i++)$salt .=$ss[rand(0,35)];
        $pwd = md5($pwd.$salt);
        $time = time();
        $data['uname'] = $uanme;
        $data['lname'] = $lname;
        $data['password'] = $pwd;
        $data['createtime'] = $time;
        $data['email'] = $email;
        $data['salt'] = $salt;
        if(!$this->model->data($data)->add())
            $this->error('创建失败');
        $this->login();
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>