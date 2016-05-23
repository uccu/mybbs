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
        
        $m['user'] = 'guwen_1';
        
        $this->success($m);
    }
    function up_pic($f = 'diary'){
        return $this->_up_pic($f);
    }
    function _up_pic($f = 'diary'){
        //$this->user->_safe_login();
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
            imagecopyresampled($image, $imgsrc, 0, 0, 0, 0,$arr[0], $arr[1],$w, $w);  //调整到的大小
            
            if($uc<10000)$fe1 = 0;else $fe1 = ($uid-$uid%10000)/10000;
            if($uc<100)$fe2 = 0;else $fe2 = ($uid%10000-$uid%100)/100;
            
           
            if(!is_dir($dir.$fe1))mkdir($dir.$fe1);
            if(!is_dir($dir.$fe1.'/'.$fe2))mkdir($dir.$fe1.'/'.$fe2);
            if(!imagepng($image,$dir.$fe1.'/'.$fe2.'/'.$uid.'.png'))$this->error(415,'保存图片失败');
            imagedestroy($image);
            $pic[] = $f.'/'.$fe1.'/'.$fe2.'/'.$uid.'.png';
        }
        return $pic;
    }
    
}
?>