<?php
namespace plugin\diary\control;
defined('IN_PLAY') || exit('Access Denied');
class diary extends \control\ajax{
    function _beginning(){
        
    }
    function _get_user(){
        return control('user:base','api');
    }
    function _get_model(){
        return model('diary:diary');
    }
    function get_list($type=1){
        $limit = post('limit',6,'%d');
        $where['uid'] = $this->user->uid;
        $where['type'] = $type?1:0;
        $line = post('ctime',0,'%d');
        if($line)$where['ctime'] = array('logic',$line,'<');
        $m = $this->model->field(array('did','ctime','otime','pic','last_pic','title'))->where($where)->order('ctime','DESC')->limit($limit)->select();
        $this->success($m);
    }
    function new_diary(){
        $this->user->_safe_login();
        $time = time();
        $data['title'] = post('title');
        $data['otime'] = post('otime');
        if(!$data['title'] || !$data['otime'])$this->error(401,'参数错误');
        $data['ctime'] = $time;
        $data['type'] = post('type')?1:0;
        $data['uid'] = $this->user->uid;
        $imgsrc0 = $_FILES['file']['tmp_name'];
        
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
        $ym = date('Ym',$time);
        $d = date('d',$time);
        if(!is_dir(PLAY_ROOT.'pic/diary/'.$ym))mkdir(PLAY_ROOT.'pic/diary/'.$ym);
        if(!is_dir(PLAY_ROOT.'pic/diary/'.$ym.'/'.$d))mkdir(PLAY_ROOT.'pic/diary/'.$ym.'/'.$d);
        $md5 = md5_file($imgsrc0);
        if(!imagepng($image,PLAY_ROOT.'pic/diary/'.$ym.'/'.$d.'/'.$md5.'.png'))$this->error(415,'保存图片失败');
        imagedestroy($image);
        $data['pic'] = 'diary/'.$ym.'/'.$d.'/'.$md5.'.png';
        if(!$id = $this->model->data($data)->add())$this->error(416,'创建失败');;
        $this->success();
    }
    function add_diary(){
        $this->user->_safe_login();
        $time = time();
        $data['content'] = post('content');
        if(!$data['content'])$this->error(401,'参数错误');
        $data['did'] = post('did');
        if(!$madiary = $this->model->find($data['did']))$this->error(417,'未找到日记');
        $data['ctime'] = $time;
        $data['type'] = $madiary['type'];
        $data['uid'] = $this->user->uid;
        $imgsrc0 = $_FILES['file']['tmp_name'];
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
        $ym = date('Ym',$time);
        $d = date('d',$time);
        if(!is_dir(PLAY_ROOT.'pic/diary/'.$ym))mkdir(PLAY_ROOT.'pic/diary/'.$ym);
        if(!is_dir(PLAY_ROOT.'pic/diary/'.$ym.'/'.$d))mkdir(PLAY_ROOT.'pic/diary/'.$ym.'/'.$d);
        $md5 = md5_file($imgsrc0);
        if(!imagepng($image,PLAY_ROOT.'pic/diary/'.$ym.'/'.$d.'/'.$md5.'.png'))$this->error(415,'保存图片失败');
        imagedestroy($image);
        $data['pic'] = 'diary/'.$ym.'/'.$d.'/'.$md5.'.png';
        if(!$id = $this->model->data($data)->add())$this->error(416,'创建失败');;
        $this->success();
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>