<?php
namespace plugin\user\control;
defined('IN_PLAY') || exit('Access Denied');
class adviser extends \control\ajax{
    function _beginning(){
        $this->user->_safe_type(1);
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
    function _get_diary(){
        return model('diary:diary');
    }
    function _get_reservationView(){
        $m = model('project:reservation');
        $m->add_table($m->storeMap);
        $m->add_table($m->expertMap);
        $m->add_table($m->userMap);
        return $m;
    }
    function get_user_list(){
        $where['adviser'] = $this->user->uid;
        $m = $this->model->field(array('uid','nickname','diary'))->where($where)->order('nickname')->limit(9999)->select();
        $this->success($m);
    }
    function get_user_detail($uid=0){
        $where['uid'] = post('uid',0,'%d');
        $where['adviser'] = $this->user->uid;
        $m = $this->model->field(array('uid','avatar','nickname','name','sex','age','area','marry','child','plastic','email',
                'work','phone','interest','score','ctime','last_time','ip'))->where($where)->find();
        if(!$m)$this->error(411,'获取失败');
        $this->success($m);
    }
    function get_diary_list($type=0){
        $limit = post('limit',6,'%d');
        $where['uid'] = post('uid');
        $where['type'] = $type?1:0;
        $where['reply'] = 0;
        $line = post('ctime',0,'%d');
        if($line)$where['ctime'] = array('logic',$line,'<');
        $m = $this->diary->field(array('did','ctime','otime','pic','last_pic','title','new'))->where($where)->order('ctime','DESC')->limit($limit)->select();
        $this->success($m);
    }
    function suggest(){
        $where['did'] = post('did');
        $where['uid'] = post('uid');
        $where0['uid'] = post('uid');
        $where0['adviser'] = $this->user->uid;
        $user = $this->model->where($where)->find();
        if(!$user)$this->error(422,'获取用户失败');
        $data['suggest'] = post('suggest');
        if(!$diary = $this->diary->where($where)->data($data)->save())$this->error(410,'修改失败');
        $this->success();
    }
    function get_diary_detail($did){
        $limit = post('limit',6,'%d');
        $where['uid'] = post('uid');
        $where0['did'] = post('did',$did,'%d');
        $where0['uid'] = $where['uid'];
        if(!$where0['did'])$this->error(401,'参数错误');
        $where0['reply'] = 0;
        $where['reply'] = $where0['did'];
        $line = post('ctime',0,'%d');
        if($line)$where['ctime'] = array('logic',$line,'<');
        $theme = $line ? array() : $this->diary->field(array('ctime','otime','pic','title'))->where($where0)->find();
        $reply = $this->diary->field(array('ctime','pic','content','suggest'))->where($where)->order('ctime','DESC')->limit($limit)->select();
        $m = array('theme'=>$theme,'reply'=>$reply);
        $data['new'] = 0;
        $this->diary->data($data)->save($where0['did']);
        $where1['uid'] = $where['uid'];
        $where1['reply'] = 0;
        $where1['new'] = 1;
        $data2['diary'] = 0;
        if(!$this->diary->where($where1)->find())$this->user->data($data2)->save($where['uid']);
        $this->success($m);
    }
    function get_reservation(){
        $where['adviser'] = $this->user->uid;
        $where['time'] = array('logic',time(),'<');
        $m = $this->reservationView->where($where)->limit(9999)->order(array('time'=>'DESC'))->select();
        $this->success($m);
    }
    
}

?>