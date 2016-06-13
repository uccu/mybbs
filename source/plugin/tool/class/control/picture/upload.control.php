<?php
namespace plugin\tool\control\picture;
defined('IN_PLAY') || exit('Access Denied');
class upload extends \control\ajax{
    function _beginning(){
        
    }
    function _get_srcs(){
        return $this->parsing_one();
    }

    function parsing_one($box='common',$small=0,$large=0){
        $file = reset($_FILES);$pic = array();
        if(!$file)return $pic;
        if($file['error'])$this->error(402,'上传失败,也许图片太大了');
        $f = post('box',$box);
        $circle = post('circle');
        $small = post('small',$small);
        $large = post('laege',$large);
        $dir = PLAY_ROOT.'pic/'.$f.'/';
        
        $imgsrc0 = $file['tmp_name'];
        if(!$imgsrc0)$this->error(403,'上传失败,无法获取缓存路径');
        $arr = getimagesize($imgsrc0);
        switch($arr[2]){
            case 3:
                $img = imagecreatefrompng($imgsrc0);
                imagesavealpha($img,true);
                break;
            case 2:
                $img = imagecreatefromjpeg($imgsrc0);
                break;
             case 1:
                $img = imagecreatefromgif($imgsrc0);
                break;
            default:
                $this->error(414,'解析图片失败');  //非jpg/png/gif 强制退出程序
                break;
        }

        $md5 = md5_file($imgsrc0);
        if(!is_dir(PLAY_ROOT.'pic'))mkdir(PLAY_ROOT.'pic');
        if(!is_dir(PLAY_ROOT.'pic/'.$f))mkdir(PLAY_ROOT.'pic/'.$f);
        $ym = date('Ym',TIME_NOW);
        $d = date('d',TIME_NOW);
        if(!is_dir($dir.$ym))mkdir($dir.$ym);
        if(!is_dir($dir.$ym.'/'.$d))mkdir($dir.$ym.'/'.$d);


        $smallWidth = 180;$smallHeight = 120;
        $largeWidth = 800;$largeHeight = 420;


        if($small){
            $this->parse($img,$smallWidth,$smallHeight,$arr[0],$arr[1],$dir.$ym.'/'.$d.'/'.$md5.'.small.jpg');
            $pic['small'] = $f.'/'.$ym.'/'.$d.'/'.$md5.'.small.jpg';
        }if($large){

            $this->parse($img,$largeWidth,$largeHeight,$arr[0],$arr[1],$dir.$ym.'/'.$d.'/'.$md5.'.large.jpg',1);
            $pic['large'] = $f.'/'.$ym.'/'.$d.'/'.$md5.'.large.jpg';
        }
        $pic['e'] = $f.'/'.$ym.'/'.$d.'/'.$md5;


        return $pic;


    }
    function parse($m,$w,$h,$w0,$h0,$src,$a=0){
        $w1 = $w0;$h1=$h0;
        if($w0>$w){
            $h0 = $h0*$w/$w0;
            $w0 = $w;
        }
        if($h0>$h){
            $w0 = $w0*$h/$h0;
            $h0 = $h;
        }
        if($a)$image = imagecreatetruecolor($w0, $h0);
        else $image = imagecreatetruecolor($w, $h);
        imagealphablending($image,false);
        imagesavealpha($image,true);
        $color = imagecolorallocatealpha($image, 255, 255, 255,127);
        imagefill($image, 0, 0, $color);
        if($a)imagecopyresampled($image, $m,0,0,0,0,$w0,$h0,$w1,$h1);
        else imagecopyresampled($image, $m,($w-$w0)/2,($h-$h0)/2,0,0,$w0,$h0,$w1,$h1);
        imagejpeg($image,$src,75);
        imagedestroy($image);

    }
}
?>
