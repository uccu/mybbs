<?php
namespace plugin\app\control\base;
defined('IN_PLAY') || exit('Access Denied');
class e extends \control\ajax{
    protected $salt = 'zetga145';
    protected $salt2 = 'zetga1457';

    function errorCode($z){
        return control('code','error')->errorCode($z);
    }

    function error($z, $object, $url = ''){
        return control('code','error')->error('400',$z);
    }

    function __construct(){
        $this->uid;
        $this->salt = $this->g->config['PASSWORD_SALT'];
        call_user_func_array(array(parent,'__construct'),func_get_args());
    }
    function session_start(){
        if(!$this->g->session){
            $this->g->session = 1;
            session_start();
        }
        return true;
    }
    function _get_uid(){
        $user_token = cookie('user_token',post('user_token'));
        if(!is_string($user_token) || !$user_token)return '-1';
        $e = base64_decode($user_token);
        if(!$e)return '-2';
        list($md5,$uid) = explode('|',$e);
        if(!$uid || !$md5)return '-3';
        $info = model('user')->find($uid);
        $this->userInfo = $info;
        if(!$info)return '-4';
        $this->userInfo = $info;
        if($this->userInfo['banned'])$this->errorCode(600);
        return $md5 == md5($info['password'].$this->salt2) ? $uid : '-5';
    }
    function _get_userInfo(){
        $this->uid;
        return $this->userInfo;
    }
    function _check_type($type){
        if($this->uid<1)$this->errorCode(411);
        if($this->userInfo['type']!=$type)$this->errorCode(411);
        return true;
    }
    function _check_uid($uid){
        $z = model('user')->find($uid);
        if(!$z)$this->errorCode(414);
        return $z;
    }
    function _check_access(){
        $access = post('access');
        //
        //
        $this->_check_vip();
    }
    function _city_name($id = 0){
        $c = model('manager_organ')->find($id);
        if(!$c)return '';
        if(!$c['bid'])return $c['jgmc'];
        $p = model('manager_organ')->find($c['bid']);
        if(!$p)return $c['jgmc'];
        return $p['jgmc'].' - '.$c['jgmc'];
    }
    function _equip_name($id = 0){
        $c = model('equipment_list')->find($id);
        if(!$c)return '';
        if(!$c['bid'])return $c['name'];
        $p = model('equipment_list')->find($c['bid']);
        if(!$p)return $c['name'];
        return $p['name'].' - '.$c['name'];
    }
    function _rtype_name($id = 0){
        $c = model('repository_list')->find($id);
        if(!$c)return '';

        return $c['name'];

    }
    function _dateline_format(&$data,$key){
        if(!$data[$key])$data[$key] = post($key,0);
        if(!is_numeric($data[$key]))$data[$key] = strtotime($data[$key]);
    }
    function _equip_name_m($id = ''){
        $array = explode(';',$id);
        $where['id'] = array('contain',$array,'IN');
        $z = model('equipment_list')->where($where)->limit(99)->select('name');
        return implode(';',array_keys($z));
    }
    function _check_follow($uid){
        return model('fans')->where(array('uid'=>$uid,'fans_id'=>$this->uid))->find() ? 1 : 0;
    }

    function _check_fans($uid){
        return model('fans')->where(array('fans_id'=>$uid,'uid'=>$this->uid))->find() ? 1 : 0;
    }
    
    function _check_vip(){
        if($this->userInfo['vip']<TIME_NOW)$this->errorCode(412);
    }
    
    function _check_login(){
        if(!$this->uid || $this->uid<0)$this->errorCode(410,$this->uid);
    }
    function _get_microtime(){
        list($usec, $sec) = explode(" ", microtime());
        return (string)(floor(((float)$usec + (float)$sec)*1000)/1000);
    }
    function _get_today(){
        return strtotime(date('Y-m-d',TIME_NOW));
    }
    function _get_yesterday(){
        return $this->today-24*3600;
    }

    function _handle_score($score=0,$content='',$limit=0,$uid = 0){
        if(!$uid)$uid = $this->uid;
        if(!$score || !$content || $uid<1)return false;
        
        $userInfo = model('user')->find($uid);
        $data['score'] = $score;
        $data['content'] = $content;
        $data['ctime'] = TIME_NOW;
        $data['uid'] = $uid;
        $data2['score'] = array('add',$score);
        if($score<0 && abs($score)>$userInfo['score'])return false;

        if($limit){
            $where['uid'] = $uid;
            $where['content'] = $content;

            if($limit==-1){
                $count = model('score_log')->where($where)->get_field();
                $limit = 1;
            }else{
                $where['time'] = array('logic','>',$this->today);
                $count = model('score_log')->where($where)->get_field();  
            }
            if($count>=$limit)return false;
            
        }

        model('score_log')->data($data)->add();
        model('user')->data($data2)->save($uid);
        return true;

    }
    
    function _pusher($content='测试~',$uid=0,$extra = null){
        if(!$uid){
            $uid = $this->uid;
            if(!$uid)return false;
        }else{
            $userInfo = model('user')->find($uid);
            if(!$userInfo)return false;
        }

        model('message')->data(array('uid'=>$uid,'ctime'=>TIME_NOW,'content'=>$content))->add();
        require_once(PLUGIN_ROOT."tool/class/control/JPush/JPush.php");
        $client = new \JPush('c25dce89f1d1dba569b745b5', '875cb64c0de30e1445152f1f');
        $result = $client->push()
            //->setOptions(null,null,null,true)
            ->setPlatform('all')
            ->addAlias('A'.$uid)
            ->setNotificationAlert($content)
            ->addAndroidNotification(null,null,null,$extra)
            ->addIosNotification(null,'default','+1',null,null,$extra)
            ->send();
        $client = new \JPush('c25dce89f1d1dba569b745b5', '875cb64c0de30e1445152f1f');
        $result2 = $client->push()
            ->setOptions(null,null,null,true)
            ->setPlatform('ios')
            ->addAlias('A'.$uid)
            ->setNotificationAlert($content)
            ->addIosNotification(null,'default','+1',null,null,$extra)
            ->send();
        return [$result,$result2];
    }

    function _getCloudToken($uid = 0){
        $user = model('user')->find($uid);
        if(!user)return false;
        $nickname = 'A'.$user['uid'];

        require PLUGIN_ROOT.'tool/class/control/cloud/Easemob.class.php';
        $options['client_id']='YXA6PdAMsJwVEear3dnihXs_Zw';
        $options['client_secret']='YXA6tcRaygOWAwlbm6vMHIqQcBecSyc';
        $options['org_name']='1166161027178790';
        $options['app_name']='qingce';

        $h=new \Easemob($options);

        //$time = (string)TIME_NOW;

        $huan = false;
        if($user['huan'])
            $huan = $h->getUser($nickname);
        
        if(!$huan){
            $huan = $h->createUser($nickname,$nickname );
            if($huan && !$huan['error']){
                model('user')->data(array('huan'=>$huan['entities'][0]['uuid']))->save($uid);
            }
        }
        

        return $huan;
    }

    function _check_phone(){

        if($this->userInfo['type']==-2)$this->errorCode(433);
    }

    function _get_imgDir(){

        return $this->g->config['IMG_URL'];
    }


    protected function uploadFiles($name = null,$width = 0,$height = 0,$cut = 0){
        if(!$_FILES)return [];
        
        $paths = [];
        $upn = $upa = [];
        foreach($_FILES as $k=>$file){
            $upn[] = $k;
            if(!$name || $k==$name){
                $upa[] = $k;
                $paths[$k] = $this->uploadPic($file['tmp_name'],0,$width,$height,$cut);
            }
            
        }
        $data['upn'] = implode(',',$upn);
        $data['upa'] = implode(',',$upa);
        $data['succ'] = ($name?$paths[$name]:$paths) ? 1 : 0;
        $data['ctime'] = TIME_NOW;
        
        // LogUploadModel::copyMutiInstance()->set($data)->add();
        return $name?$paths[$name]:$paths;
    }
    protected function randWord($count = 1,$s = 0){
        $rand = 'ABCDEFGJIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';
        $rand2 = '1234567890abcdefghijklmnopqrstuvwxyz';
        $rand3 = '1234567890';
        $o = '';
        for($i=0;$i<$count;$i++){
            if(!$s)$o .= $rand[rand(0,61)];
            elseif($s==2)$o .= $rand2[rand(0,35)];
            elseif($s==3)$o .= $rand3[rand(0,9)];
        }
        return $o;
    }
    
    /* 处理上传图片 */
    protected function uploadPic($tmp_name,$type = 0,$width = 0,$height = 0,$cut = 0){
        if(!$tmp_name)$this->error('上传失败,无法获取缓存路径');
        $arr = getimagesize($tmp_name);
        /* 判断图片格式 */
        switch($arr[2]){
            case 3:
                $img = imagecreatefrompng($tmp_name);
                imagesavealpha($img,true);
                break;
            case 2:
                $img = imagecreatefromjpeg($tmp_name);
                break;
             case 1:
                $img = imagecreatefromgif($tmp_name);
                break;
            default:
                $this->error('解析图片失败');  //非jpg/png/gif 强制退出程序
                break;
        }
        $picRoot = 'D:\wamp\www\sbgl_test\upload_all\head\news_img';
        if($type === 'md5'){
            $md5 = md5_file($tmp_name);
            $folder = substr($md5,0,2);
            $folderRoot = $picRoot.'/'.$folder;
            if(!is_dir($folderRoot))
                !mkdir($folderRoot,0777,true) && $this->error('文件夹权限不足，无法创建文件！');
            $folderRoot .= '/';
            $src = $folderRoot.$md5.'.jpg';
            $path = $folder.'/'.$md5.'.jpg';
        }else{
            $folder = DATE_TODAY;
            $folderRoot = $picRoot.'/'.$folder;
            if(!is_dir($folderRoot))
                !mkdir($folderRoot,0777,true) && $this->error('文件夹权限不足，无法创建文件！');
            $folderRoot .= '/';
            $time = date('H.i.s.').$this->randWord(6,3);
            $src = $folderRoot.$time.'.jpg';
            $path = $folder.'/'.$time.'.jpg';
        }
        $width0 = $arr[0];
        $height0 = $arr[1];
        $width = $width?$width:$width0;
        // var_dump($height);die();
        $height = $height?$height:$height0;
        
        $image = imagecreatetruecolor($width, $height);
        $color = imagecolorallocatealpha($image, 255, 255, 255,127);
        imagefill($image, 0, 0, $color);
        if($cut == 0)
            imagecopyresampled($image, $img,0,0,0,0,$width,$height,$width0,$height0);
        
        imagejpeg($image,$src,75);
        imagedestroy($image);
        return $path;
    }
}
?>