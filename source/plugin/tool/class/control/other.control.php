<?php
namespace plugin\tool\control;
defined('IN_PLAY') || exit('Access Denied');
class other extends \control\ajax{
    function _beginning(){

    }
    function _get_area(){
        return model('tool:area');
    }
    function _get_user(){
        return control('user:base','api');
    }
    function _get_work(){
        return model('tool:work_list');
    }
    function _get_userModel(){
        return model('user:user_info');
    }
    function get_area(){
        $province = post('province');
        $city = post('city');
        $gg = array();$ge = array();$r = 0;
        if($province){
            $m = $this->area->field('DISTINCT city')->where(array('province'=>$province))->order(array('province','city','district'))->limit(9999)->select();
            foreach($m as &$v)$v = $v['city'];
        }
        elseif($city){
            $m = $this->area->field(array('district'))->where(array('city'=>$city))->order(array('province','city','district'))->limit(9999)->select();
            foreach($m as &$v)$v = $v['district'];
        }else{
            $m = $this->area->field('DISTINCT province')->order(array('province','city','district'))->limit(9999)->select();
            foreach($m as &$v)$v = $v['province'];
        }
        $this->success($m);
    }
    function get_work(){
        $m = $this->work->limit(9999)->order('name')->select();
        $this->success($m);
    }
    function get_adviser(){
        //require PLUGIN_ROOT.'tool/class/control/cloud/ServerAPI.php';
        //$p = new \ServerAPI('c9kqb3rdklawj','f1sgYa3kFvaP0');
        //$r = $p->getToken('7','testUser','http://120.26.230.136:6087/pic/iavatar/0/0/7.png');
        $this->user->_safe_login();
        //$this->user->uid = 13;
        $user = $this->userModel->find($this->user->uid);
        //$r = $p->getToken($user['uid'],$user['nickname']?$user['nickname']:' ','http://120.26.230.136:6087/pic/'.$user['avatar']);
        //var_dump($r);
        //$o = json_decode($r,true);
        //if($o){
            if(!$user['adviser']){
                $where['user_type'] = 1;
                $advisers = $this->userModel->field(array('avatar','nickname','uid'))->where($where)->limit(9999)->select();
                $rand = rand(0,count($advisers)-1);
                $adviser = $advisers[$rand];
                $data['adviser'] = $adviser['uid'];
                $this->userModel->data($data)->save($user['uid']);
                $user['adviser'] = $adviser['uid'];
            }else $adviser=$this->userModel->field(array('avatar','nickname','uid'))->find($user['adviser']);
            //$array['token'] = $o['token'];
            $array['adviser'] = $user['adviser'];
            $array['adviser_info'] = $adviser;
            $this->success($array);
        //}
        //else $this->error(411,'获取失败');
    }
  
    function _up_pic($f = 'diary'){
        $this->user->_safe_login();
        $dir = PLAY_ROOT.'pic/'.$f.'/';
        $pic = array();$time = time();
        foreach($_FILES as $file){
            $imgsrc0 = $file['tmp_name'];
            if(!$imgsrc0)continue;
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
            $w = $arr[1]<$arr[0]?$arr[1]:$arr[0];
            $image = imagecreatetruecolor($w, $w);    //图像大小
            imagealphablending($image,false);
            imagesavealpha($image,true);
            $color = imagecolorallocatealpha($image, 0, 0, 0,127);
            imagefill($image, 0, 0, $color);
            imagecopyresampled($image, $imgsrc,-($arr[0]-$w)/2, -($arr[1]-$w)/2,0, 0 ,$arr[0], $arr[1],$arr[0], $arr[1]);  //调整到的大小
            $ym = date('Ym',$time);
            $d = date('d',$time);
            if(!is_dir($dir.$ym))mkdir($dir.$ym);
            if(!is_dir($dir.$ym.'/'.$d))mkdir($dir.$ym.'/'.$d);
            $md5 = md5_file($imgsrc0);
            if(!imagepng($image,$dir.$ym.'/'.$d.'/'.$md5.'.png'))$this->error(415,'保存图片失败');
            imagedestroy($image);
            $pic[] = $f.'/'.$ym.'/'.$d.'/'.$md5.'.png';
        }
        return $pic;
    }
    
    function _up_avatar($f = 'avatar'){
        $this->user->_safe_login();
        $uid = $this->user->uid;
        $dir = PLAY_ROOT.'pic/'.$f.'/';
        $pic = array();$time = time();
        foreach($_FILES as $file){
            $imgsrc0 = $file['tmp_name'];
            if(!$imgsrc0)continue;
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
            $ww = $w = $arr[1]<$arr[0]?$arr[1]:$arr[0];
            if($w>100)$w=100;
            $image = imagecreatetruecolor($w, $w);    //图像大小
            imagealphablending($image,false);
            imagesavealpha($image,true);
            $color = imagecolorallocatealpha($image, 0, 0, 0,127);
            imagefill($image, 0, 0, $color);
            imagecopyresampled($image, $imgsrc, 0, 0, 0, 0,$w, $w,$ww, $ww);  //调整到的大小
            
            if($uc<10000)$fe1 = 0;else $fe1 = ($uid-$uid%10000)/10000;
            if($uc<100)$fe2 = 0;else $fe2 = ($uid%10000-$uid%100)/100;
            
           
            if(!is_dir($dir.$fe1))mkdir($dir.$fe1);
            if(!is_dir($dir.$fe1.'/'.$fe2))mkdir($dir.$fe1.'/'.$fe2);
            $user = $this->userModel->find($this->user->uid);
            $time = time();
            if($user['avatar']!='noavatar.png')
            if(file_exists(PLAY_ROOT.'pic/'.$user['avatar']))unlink(PLAY_ROOT.'pic/'.$user['avatar']);
            if(!imagepng($image,$dir.$fe1.'/'.$fe2.'/'.$uid.'_'.$time.'.png',5))$this->error(415,'保存图片失败');
            imagedestroy($image);
            $pic[] = $f.'/'.$fe1.'/'.$fe2.'/'.$uid.'_'.$time.'.png';
        }
        return $pic;
    }
    
}
?>