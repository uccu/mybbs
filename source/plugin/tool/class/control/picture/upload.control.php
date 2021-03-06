<?php
namespace plugin\tool\control\picture;
defined('IN_PLAY') || exit('Access Denied');
class upload extends \control\ajax{
    function _beginning(){
        
    }
    function _get_srcs(){
        return $this->parsing_one();
    }

    function parsing_one($box='common',$small=0,$large=0,$medium=0,$raw=0){
        $file = reset($_FILES);$pic = array();$picz = post('raw_base64_picz');
        if($picz){
            $picz = base64_decode(str_replace('data:image/png;base64,', '', $picz));
            $md5 = md5($picz);
            file_put_contents(CACHE_ROOT.$md5.'.zz', $picz);
            $imgsrc0 = CACHE_ROOT.$md5.'.zz';
        }elseif($file){
            if($file['error'])$this->error(402,'上传失败,也许图片太大了');
            $imgsrc0 = $file['tmp_name'];
        }else return $pic;
        
        $f = post('box',$box);
        $circle = post('circle');
        $small = post('small',$small);
        $large = post('large',$large);
        $medium = post('medium',$medium);
        $avatar = post('avatar');
        $cut = post('cut');
        $raw = post('raw',$raw);
        $dir = PLAY_ROOT.'pic/'.$f.'/';
        
        
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
        $autoHeight = post('auto',false)?true:false;
        $avatarWidth = $avatarHeight = 100;
        $smallWidth = 180;$smallHeight = 120;
        $mediumWidth = 400;$mediumHeight = 210;
        $largeWidth = 800;$largeHeight = 420;

        if($avatar){
            $this->parse($img,$avatarWidth,$avatarHeight,$arr[0],$arr[1],$dir.$ym.'/'.$d.'/'.$md5.'.avatar.jpg',0,$autoHeight,$cut,$circle);
            $pic['avatar'] = $f.'/'.$ym.'/'.$d.'/'.$md5.'.avatar.jpg';
        }if($small){
            $this->parse($img,$smallWidth,$smallHeight,$arr[0],$arr[1],$dir.$ym.'/'.$d.'/'.$md5.'.small.jpg',0,$autoHeight,$cut,$circle);
            $pic['small'] = $f.'/'.$ym.'/'.$d.'/'.$md5.'.small.jpg';
        }if($medium){
            $this->parse($img,$mediumWidth,$mediumHeight,$arr[0],$arr[1],$dir.$ym.'/'.$d.'/'.$md5.'.medium.jpg',1,$autoHeight,$cut,$circle);
            $pic['medium'] = $f.'/'.$ym.'/'.$d.'/'.$md5.'.medium.jpg';
        }if($large){
            $this->parse($img,$largeWidth,$largeHeight,$arr[0],$arr[1],$dir.$ym.'/'.$d.'/'.$md5.'.large.jpg',1,$autoHeight,$cut,$circle);
            $pic['large'] = $f.'/'.$ym.'/'.$d.'/'.$md5.'.large.jpg';
        }if($raw){
            $this->parse($img,$arr[0],$arr[1],$arr[0],$arr[1],$dir.$ym.'/'.$d.'/'.$md5.'.jpg',1,$autoHeight,$cut,$circle);
            $pic['raw'] = $f.'/'.$ym.'/'.$d.'/'.$md5.'.jpg';
        }
        $pic['e'] = $f.'/'.$ym.'/'.$d.'/'.$md5;
        if($picz)unlink($imgsrc0);
        return $pic;


    }
    function parse($m,$w,$h,$w0,$h0,$src,$a=0,$autoHeight=false,$cut=false,$circle=false){
        $w1 = $w0;$h1=$h0;
        if($circle){
            $h=$w;
            if($w0<=$h0){
                if($w0<=$w){
                    $h=$w=$w0;
                }else{
                    $h0 = $h0*$w/$w0;
                    $w0 = $w;
                }
            }elseif($w0>=$h0){
                if($h0<=$w){
                    $h=$w=$h0;
                }else{
                    $w0 = $w0*$w/$h0;
                    $h0 = $w;
                }    
            }
        }elseif(!$cut){
            if($w0>$w){
                $h0 = $h0*$w/$w0;
                $w0 = $w;
            }
            if(!$autoHeight && $h0>$h){
                $w0 = $w0*$h/$h0;
                $h0 = $h;
            }
        }
        if($cut){

            $image = imagecreatetruecolor($w, $h);
        }
        elseif($a)$image = imagecreatetruecolor($w0, $h0);
        else $image = imagecreatetruecolor($w, $h);
        //imagealphablending($image,false);
        //imagesavealpha($image,true);
        $color = imagecolorallocatealpha($image, 255, 255, 255,127);
        imagefill($image, 0, 0, $color);
        if($cut){
            imagecopyresampled($image, $m,($w-$w0)/2,($h-$h0)/2,0,0,$w0,$h0,$w1,$h1);
        }elseif($a)imagecopyresampled($image, $m,0,0,0,0,$w0,$h0,$w1,$h1);
        else imagecopyresampled($image, $m,($w-$w0)/2,($h-$h0)/2,0,0,$w0,$h0,$w1,$h1);
        imagejpeg($image,$src,75);
        imagedestroy($image);

    }
}
?>
