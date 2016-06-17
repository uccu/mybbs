<?php
namespace plugin\my\control;
defined('IN_PLAY') || exit('Access Denied');
class ajax extends \control\ajax{
    function _beginning(){
        
    }
    function release(){
        $title = post('title');
        $content = post('content');
        $content = preg_replace('/\n/i','<br />',$content);
        echo $content;
    }
    function uploadPic($box = 'common'){
        $picz = post('picz');
        if($picz){
            $picz = base64_decode(str_replace('data:image/png;base64,', '', $picz));
            $md5 = md5($picz);
            file_put_contents(CACHE_ROOT.$md5.'.zz', $picz);
            $imgsrc0 = CACHE_ROOT.$md5.'.zz';
        }else{
            $file = reset($_FILES);
            if($file['error'])$this->error(400,'上传失败,也许图片太大了');
            $imgsrc0 = $file['tmp_name'];
        }
        $f = post('box',$box);
        $circle = post('circle');
        $dir = PLAY_ROOT.'pic/'.$f.'/';
        $pic = array();$time = time();
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
                $md5 = md5_file($imgsrc0);
                if(!is_dir(PLAY_ROOT.'pic'))mkdir(PLAY_ROOT.'pic');
                if(!is_dir(PLAY_ROOT.'pic/'.$f))mkdir(PLAY_ROOT.'pic/'.$f);
                $ym = date('Ym',$time);
                $d = date('d',$time);
                move_uploaded_file($imgsrc0,$dir.$ym.'/'.$d.'/'.$md5.'.gif');
                $pic = $f.'/'.$ym.'/'.$d.'/'.$md5.'.gif?'.$this->g->template['cacheid'];
                $this->success($pic);
                break;
            default:
                $this->error(414,'解析图片失败');  //非jpg/png/gif 强制退出程序
                break;
        }
        $width = $arr[0];$height = $arr[1];
        $maxWidth = 400;
        if($width>$maxWidth){$height = $height * $maxWidth / $width;$width = $maxWidth;}
        $w =$width>$height?$height:$width;
        $image = $circle?imagecreatetruecolor($w, $w):imagecreatetruecolor($width, $height);
        imagealphablending($image,false);
        imagesavealpha($image,true);
        $color = imagecolorallocatealpha($image, 0, 0, 0,127);
        imagefill($image, 0, 0, $color);
        imagecopyresampled($image, $imgsrc,0,0,0,0,$width,$height,$arr[0], $arr[1]);
        $md5 = md5_file($imgsrc0);
        if(!is_dir(PLAY_ROOT.'pic'))mkdir(PLAY_ROOT.'pic');
        if(!is_dir(PLAY_ROOT.'pic/'.$f))mkdir(PLAY_ROOT.'pic/'.$f);
        $ym = date('Ym',$time);
        $d = date('d',$time);
        if(!is_dir($dir.$ym))mkdir($dir.$ym);
        if(!is_dir($dir.$ym.'/'.$d))mkdir($dir.$ym.'/'.$d);
        if(!imagejpeg($image,$dir.$ym.'/'.$d.'/'.$md5.'.jpg',75))$this->error(415,'保存图片失败');
        $pic = $f.'/'.$ym.'/'.$d.'/'.$md5.'.jpg';
        
        imagedestroy($image);
        if($picz)unlink($imgsrc0);
        $this->success($pic);
    }
    
    
}


?>