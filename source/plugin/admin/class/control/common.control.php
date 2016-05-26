<?php
namespace plugin\admin\control;
defined('IN_PLAY') || exit('Access Denied');
class common extends \control\ajax{
    function _beginning(){
        if($this->user->type<2)header('Location:/admin/login');
        table('config')->template['userType'] = $this->user->type;
    }
    function _get_user(){
        return control('user:base','api');
    }
    function _get_model(){
        return model('common:opition');
    }
    function _get_userModel(){
        return model('user:user_info');
    }
    function _get_project(){
        return model('project:project');
    }
    function pic(){
        $m = $this->model->find('logo_pic');
        if(!$m)$m = array();
        else $m = unserialize($m['content']);
        table('config')->template['pic'] = $m;
        T('admin:common/pic');
    }
    function change_pic(){
        $m = $this->model->find('logo_pic');
        if(!$m)$m = array();
        else $m = unserialize($m['content']);
        $id = post('id');
        $m[$id] = array('type'=>post('type'),'value'=>post('value'),'pic'=>post('pic'));
        $move = post('move');
        if(strlen($move)){
            foreach($m as $k=>$v){
                if($k==$move)$mm[] = $m[post('id')];
                if($k==$id)continue;
                $mm[] = $v;
            }
            if(count($mm)!=count($m))$mm[] = $m[post('id')];
            $m = $mm;
        }
        $data['content'] = array('logic',$m,'%s');
        $m = $this->model->data($data)->save('logo_pic');
        $this->success($m);
    }
    function del_pic(){
        $m = $this->model->find('logo_pic');
        if(!$m)$m = array();
        else $m = unserialize($m['content']);
        unset($m[post('id')]);
        $m =  array_values($m);
        $data['content'] = array('logic',$m,'%s');
        $m = $this->model->data($data)->save('logo_pic');
        $this->success($m);
    }
    function add_pic(){
        $m = $this->model->find('logo_pic');
        if(!$m)$m = array();
        else $m = unserialize($m['content']);
        $m[] = array('type'=>'none','value'=>'','pic'=>'no_pic');
        $data['content'] = array('logic',$m,'%s');
        $m = $this->model->data($data)->save('logo_pic');
        $this->success($m);
    }
    function shop(){
        $m = $this->model->find('shop_pic');
        if(!$m)$m = array();
        else $m = unserialize($m['content']);
        table('config')->template['pic'] = $m;
        T('admin:common/shop');
    }
    function up_pic($f = 'common'){
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
            if(!post('circle')){
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
    function up_avatar($f = 'avatar'){
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
        $this->success($pic);
    }
    function change_shop(){
        $m = $this->model->find('shop_pic');
        if(!$m)$m = array();
        else $m = unserialize($m['content']);
        $id = post('id');
        $m[$id] = array('type'=>post('type'),'value'=>post('value'),'pic'=>post('pic'));
        $move = post('move');
        if(strlen($move)){
            foreach($m as $k=>$v){
                if($k==$move)$mm[] = $m[post('id')];
                if($k==$id)continue;
                $mm[] = $v;
            }
            if(count($mm)!=count($m))$mm[] = $m[post('id')];
            $m = $mm;
        }
        $data['content'] = array('logic',$m,'%s');
        $m = $this->model->data($data)->save('shop_pic');
        $this->success($m);
    }
    function del_shop(){
        $m = $this->model->find('shop_pic');
        if(!$m)$m = array();
        else $m = unserialize($m['content']);
        unset($m[post('id')]);
        $m =  array_values($m);
        $data['content'] = array('logic',$m,'%s');
        $m = $this->model->data($data)->save('shop_pic');
        $this->success($m);
    }
    function add_shop(){
        $m = $this->model->find('shop_pic');
        if(!$m)$m = array();
        else $m = unserialize($m['content']);
        $m[] = array('type'=>'none','value'=>'','pic'=>'no_pic');
        $data['content'] = array('logic',$m,'%s');
        $m = $this->model->data($data)->save('shop_pic');
        $this->success($m);
    }
    function save_ad(){
        $m = array('url'=>post('url'),'desc'=>post('desc'),'content'=>post('content'),'pic'=>post('pic'));
        $data['content'] = array('logic',$m,'%s');
        $m = $this->model->data($data)->save('logo_ad');
        $this->success($m);
    }
    function ad(){
        $m = $this->model->find('logo_ad');
        if(!$m)$m = array();
        else $m = unserialize($m['content']);
        table('config')->template['ad'] = $m;
        T('admin:common/ad');
    }
    function _nomethod(){
        $this->pic();
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>