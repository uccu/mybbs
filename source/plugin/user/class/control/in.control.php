<?php
namespace plugin\user\control;
defined('IN_PLAY') || exit('Access Denied');
class in extends \control\ajax{
    function _beginning(){
    }
    protected function _get_user(){
        return control('user:base','api');
    }
    protected function _get_model(){
        return model('user:user_info');
    }
    protected function _get_ip(){
        return model('user:ip_content');
    }
    protected function _get_captcha(){
        return control('tool:captcha');
    }
    function login($e=0){
        if($this->user->uid)$this->error(301,'已登入');
        $phone = post('phone','');
        $pwd = post('pwd','');
        if(!$phone || !$pwd)$this->error(401,'参数错误');
        $time = time();
        $where['phone'] = $phone;
        $user = $e?$this->model->where('uid='.$e)->find():$this->model->where($where)->find();
        if(!$user)$this->error(402,'该用户未注册');
        if(md5(md5($pwd).$user['salt'])===$user['password']){
            $data['ip'] = $this->g->config['ip'];
            $data['lasttime'] = $time;
            $this->model->data($data)->save($user['uid']);
        }else{
            if($this->g->config['CHECK_IP']){
                $data = array();
                $data['ip'] = $this->g->config['ip'];
                $data['type'] = 'password';
                $data['time'] = time();
                $this->ip->data($data)->add();
            }
            $this->error(403,'密码错误');
        }
        $uid = $user['uid'];
        $type = $user['user_type'];
        $until = post('until',0,'%d');
        if($until)$until =$time;
        $salt = 'QWERTYUIOPASDFGHJKLZXCVBNM';
        $login_secury = 
            $salt[rand(0,20)].
            base64_encode(implode('|',array(
                $uid,$until,$type,
                md5($uid.$until.$type.$this->g->config['LOGIN_SALT'])
            )));
        cookie('login_secury',$login_secury,$until?$until-$time:0);
        if(post('cookie'))cookie('login_zz','1',$until?$until-$time:0);
        $out['login_secury'] = $login_secury;
        $out['user_info'] = $e?$this->model->where('uid='.$e)->field(array('uid','avatar','nickname','name','sex','age','area','marry','child','plastic','email',
                'work','phone','interest','score','ctime','last_time','ip'))->find():
                $this->model->field(array('uid','avatar','nickname','name','sex','age','area','marry','child','plastic','email',
                'work','phone','interest','score','ctime','last_time','ip'))->where($where)->find();
        //if($score = model('cache')->get('login_score')){
        //    $scoreSafe = model('cache')->get('login_score_time');
        //    if($scoreSafe!=strtotime(date('Y-m-d'))){
         //       model('cache')->replace('login_score_time',strtotime(date('Y-m-d')));
                $this->user->uid = $user['uid'];
                if($score = control('user:score','api')->_add_score_detail('登录积分','login')){
                    $out['score'] = $score;
                }
         //       $out['score'] = $score;
         //   }
            
        //}
        require PLUGIN_ROOT.'tool/class/control/cloud/ServerAPI.php';
        $p = new \ServerAPI('c9kqb3rdklawj','f1sgYa3kFvaP0');
        $r = $p->getToken($user['uid'],$user['nickname']?$user['nickname']:' ','http://120.26.230.136:6087/pic/'.$user['avatar']);
        $o = json_decode($r,true);
        $out['token'] = $o['token'];
            if(!$user['adviser']){
                $where['user_type'] = 1;
                $advisers = $this->model->where($where)->limit(9999)->select();
                $rand = rand(0,count($advisers)-1);
                $adviser = $advisers[$rand];
                $data['adviser'] = $adviser['uid'];
                $this->model->data($data)->save($user['uid']);
                $user['adviser'] = $adviser['uid'];
            }
            $out['adviser'] = $user['adviser'];
        return $this->success($out);
    }
    
    function adviser_login($e=array()){
        
        $phone = post('phone','');
        $pwd = post('pwd','');
        if(!$phone || !$pwd)$this->error(401,'参数错误');
        $time = time();
        $where['phone'] = $phone;
        
        $user = $e?$e:$this->model->where($where)->find();
        
        if(!$user)$this->error(402,'该用户未注册');
        if(md5(md5($pwd).$user['salt'])===$user['password']){
            $data['ip'] = $this->g->config['ip'];
            $data['lasttime'] = $time;
            $this->model->data($data)->save($user['uid']);
        }else{
            if($this->g->config['CHECK_IP']){
                $data = array();
                $data['ip'] = $this->g->config['ip'];
                $data['type'] = 'password';
                $data['time'] = time();
                $this->ip->data($data)->add();
            }
            $this->error(403,'密码错误');
        }
        $uid = $user['uid'];
        $type = $user['user_type'];
        if($type<1)$this->error(407,'未授权');
        $until = post('until',0,'%d');
        if($until)$until =$time;
        $salt = 'QWERTYUIOPASDFGHJKLZXCVBNM';
        $login_secury = 
            $salt[rand(0,20)].
            base64_encode(implode('|',array(
                $uid,$until,$type,
                md5($uid.$until.$type.$this->g->config['LOGIN_SALT'])
            )));
        cookie('login_secury',$login_secury,$until?$until-$time:0);
        if(post('cookie'))cookie('login_zz','1',$until?$until-$time:0);
        $out['login_secury'] = $login_secury;
        
        $out['user_info'] = $e?$this->model->where('uid='.$e)->field(array('uid','avatar','nickname','name','sex','age','area','marry','child','plastic','email',
                'work','phone','interest','score','ctime','last_time','ip'))->find():
                $this->model->field(array('uid','avatar','nickname','name','sex','age','area','marry','child','plastic','email',
                'work','phone','interest','score','ctime','last_time','ip'))->where($where)->find();
        
        
        require PLUGIN_ROOT.'tool/class/control/cloud/ServerAPI.php';
        $p = new \ServerAPI('c9kqb3rdklawj','f1sgYa3kFvaP0');
        $r = $p->getToken($user['uid'],$user['nickname']?$user['nickname']:' ','http://120.26.230.136:6087/pic/'.$user['avatar']);
        $o = json_decode($r,true);
        $out['token'] = $o['token'];
        return $this->success($out);
    }
    function logout(){
        $this->user->_safe_login();
        cookie('login_secury','',-3600);
        return $this->success();
    }
    function create(){
        if($this->user->uid)
            $this->error(301,'已登入');
            //var_dump($this->user->uid);die();
        $phone = post('phone','');
        $pwd = post('pwd','');
        $captcha = post('captcha','');
        if(!$phone || !$pwd || !$captcha)
            $this->error(401,'参数错误');
        $this->captcha->_check_captcha($captcha);
        if($this->model->where(array('phone'=>$phone))->find())
             $this->error(302,'手机号已注册');
        $ss = 'abscefghijkimnopqrstuvwxyz1234567890';
        for($i=0;$i<5;$i++)$salt .=$ss[rand(0,35)];
        $pwd = md5(md5($pwd).$salt);
        $time = time();
        $data['phone'] = $phone;
        $data['password'] = $pwd;
        $data['ctime'] = $time;
        $data['salt'] = $salt;
        $data['nickname'] = '用户_'.$time;
        $data['avatar'] = 'noavatar.png';
        if(!$rr = $this->model->data($data)->add())
            $this->error(404,'创建失败');
        $data['uid'] = $rr;
        $data['user_type'] = 0;
        $this->login($rr);
    }
    function forget_password(){
        if($this->user->uid)
            $this->error(301,'已登入');
        $phone = post('phone','');
        $pwd = post('pwd','');
        $captcha = post('captcha','');
        if(!$phone || !$pwd || !$captcha)
            $this->error(401,'参数错误');
        $this->captcha->_check_captcha($captcha);
        $user = $this->model->where(array('phone'=>$phone))->find();
        if(!$user)$this->error(402,'该用户未注册');
        $data['password'] = md5(md5($pwd).$user['salt']);
        $out = $this->model->data($data)->save($user['uid']);
        if(!$out)$this->error(410,'修改失败');
        $this->success();
    }
    function change_password(){
        //$this->user->_safe_login();
        $phone = post('phone','');
        $pwd = post('pwd','');
        $newPwd = post('new_pwd','');
        if($this->user->uid)$user = $this->model->where()->find($this->user->uid);
        elseif($phone)$user = $this->model->where(array('phone'=>$phone))->find();
        else $this->error(401,'参数错误');
        if(md5(md5($pwd).$user['salt'])===$user['password']){
            $data['password'] = md5(md5($newPwd).$user['salt']);
            $this->model->data($data)->save($this->user->uid);
        }else $this->error(403,'密码错误');
        $this->success();
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>