<?php
namespace plugin\weixin\control;
defined('IN_PLAY') || exit('Access Denied');
class admin extends \control\ajax{
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


    function admin_login($e=array()){
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
        if($type<2)$this->error(407,'未授权');
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
        cookie('login_zz','1',$until?$until-$time:0);
        $out['login_secury'] = $login_secury;
        return $this->success($out);
    }
    function up_pic(){
        $this->user->_safe_login();
        $f = post('box');
        $circle = post('circle');
        $dir = PLAY_ROOT.'pic/'.$f.'/';
        $pic = array();$time = time();
        foreach($_FILES as $file){
            $imgsrc0 = $file['tmp_name'];
            $arr = getimagesize($imgsrc0);
            switch($arr[2]){
                case 3:
                    $imgsrc = imagecreatefrompng($imgsrc0);
                    imagesavealpha($imgsrc,true);
                    break;
                case 2:
                    $imgsrc = imagecreatefromjpeg($imgsrc0);
                break;
                case 1:
                    $imgsrc = imagecreatefromgif($imgsrc0);
                    imagesavealpha($imgsrc,true);
                    break;
                default:
                    $this->error(414,'解析图片失败');  //非jpg/png/gif 强制退出程序
                    break;
            }
            if(!$circle){
                $w = $arr[1]<$arr[0]?$arr[1]:$arr[0];
                $image = imagecreatetruecolor($arr[0], $arr[1]);    //图像大小
                imagealphablending($image,false);
                imagesavealpha($image,true);
                $color = imagecolorallocatealpha($image, 0, 0, 0,127);
                imagefill($image, 0, 0, $color);
                imagecopyresampled($image, $imgsrc,0,0,0, 0 ,$arr[0], $arr[1],$arr[0], $arr[1]);
            }else{
                $w = $arr[1]<$arr[0]?$arr[1]:$arr[0];
                $image = imagecreatetruecolor($w, $w);    //图像大小
                imagealphablending($image,false);
                imagesavealpha($image,true);
                $color = imagecolorallocatealpha($image, 0, 0, 0,127);
                imagefill($image, 0, 0, $color);
                imagecopyresampled($image, $imgsrc,-($arr[0]-$w)/2, -($arr[1]-$w)/2,0, 0 ,$arr[0], $arr[1],$arr[0], $arr[1]);  //调整到的大小
            
            }
            
            $md5 = md5_file($imgsrc0);
            if(!is_dir(PLAY_ROOT.'pic/'.$f))mkdir(PLAY_ROOT.'pic/'.$f);
            if($f=='common'){
                if(!imagepng($image,$dir.$md5.'.png'))$this->error(415,'保存图片失败');
                imagedestroy($image);
                $pic[] = $f.'/'.$md5.'.png';
            }else{
                $ym = date('Ym',$time);
                $d = date('d',$time);
                if(!is_dir($dir.$ym))mkdir($dir.$ym);
                if(!is_dir($dir.$ym.'/'.$d))mkdir($dir.$ym.'/'.$d);
                $md5 = md5_file($imgsrc0);
                if(!imagepng($image,$dir.$ym.'/'.$d.'/'.$md5.'.png'))$this->error(415,'保存图片失败');
                imagedestroy($image);
             $pic[] = $f.'/'.$ym.'/'.$d.'/'.$md5.'.png';
            }
            
        }
        $this->success($pic);
    }
    function logout(){
        $this->user->_safe_login();
        cookie('login_secury','',-3600);
        cookie('login_zz','',-3600);
        header('Location: /weixin/login');
    }
}