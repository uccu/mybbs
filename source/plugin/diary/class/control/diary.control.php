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
    function _get_tool(){
        return model('tool:other');
    }
    function get_list($type=0){
        $this->user->_safe_login();
        $limit = post('limit',6,'%d');
        $where['uid'] = $this->user->uid;
        $where['type'] = $type?1:0;
        $where['reply'] = 0;
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
        $pic = $this->tool->_up_pic('diary');
        if(!$pic)$this->error(418,'没有上传照片');
        $data['pic'] = $pic[0];
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
        $pic = $this->tool->_up_pic('diary');
        if(!$pic)$this->error(418,'没有上传照片');
        $data['pic'] = $pic[0];
        if(!$id = $this->model->data($data)->add())$this->error(416,'创建失败');
        $data2['last_pic'] = $data['pic'];
        $this->model->data($data2)->save($data['did']);
        $this->success();
    }
    function get_detail($did){
        $this->user->_safe_login();
        $limit = post('limit',6,'%d');
        $where['uid'] = $this->user->uid;
        $where0['did'] = post('did',$did,'%d');
        $where0['uid'] = $this->user->uid;
        if(!$where0['did'])$this->error(401,'参数错误');
        $where0['reply'] = 0;
        $where['reply'] = $where0['did'];
        $line = post('ctime',0,'%d');
        if($line)$where['ctime'] = array('logic',$line,'<');
        $theme = $line ? array() : $this->model->field(array('otime','pic','title'))->where($where0)->find();
        $reply = $this->model->field(array('ctime','pic','content','suggest'))->where($where)->order('ctime','DESC')->limit($limit)->select();
        $m = array('theme'=>$theme,'reply'=>$reply);
        $this->success($m);
    }
    function pic_compare($did=0,$type=0){
        $time = time();
        $type = post('type',$type);
        $where['uid'] = $this->user->uid;
        $where['reply'] = post('did',$did,'%d');
        $where0['did'] = post('did',$did,'%d');
        $where0['uid'] = $this->user->uid;
        $m0 = $this->model->field(array('ctime','pic'))->where($where0)->select();
        if(!$m0)$this->error(417,'未找到日记');
        $m = $this->model->field(array('ctime','pic'))->where($where)->order('ctime')->limit(9999)->select();
        $m = array_merge($m0,$m);
        if(!$m)$this->error(417,'未找到日记');
        $last = end($m);
        if($type == 'week'){
            $week = $time-3600*24*7;
            foreach($m as $t)if($t['ctime']>$week){
                $first = $t;break;
            }
        }elseif($type == 'month'){
            $month = $time - 3600*24*7*30;
            foreach($m as $t)if($t['ctime']>$month){
                $first = $t;break;
            }
        }elseif($type == 'year'){
            $year = $time - 3600*24*7*30*365;
            foreach($m as $t)if($t['ctime']>$year){
                $first = $t;break;
            }
        }else{
            $first = reset($m);
        }
        $f = array('first'=>$first,'last'=>$last);
        $this->success($f);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>