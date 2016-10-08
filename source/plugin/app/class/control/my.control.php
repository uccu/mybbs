<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class my extends base\e{
    function _beginning(){
        $this->_check_login();
    }

    function _change_info($info,$v){
        if($v)$info = array($info=>$v);
        return model('user')->data($info)->save($this->uid);
    }

    function choose_char($type){
        $this->_check_type(-1);
        //$type = post('type',$type,'0');
        $type = 0;
        $data['count'] = model('user')->data(array('type'=>$type))->save($this->uid);
        $this->success($data);
    }

    function change_u_info($nickname,$sex,$city,$plant){
        $this->_check_type(0);
        $data['nickname'] = post('nickname',$nickname);
        $data['sex'] = post('sex',$sex);
        $data['city'] = post('city',$city);
        $data['plant'] = post('plant',$plant);
        $data['thumb'] = post('thumb');
        if(!$data['thumb'])unset($data['thumb']);
        $this->_change_info($data);
        $this->success();
    }
    function change_o_info($nickname,$sex,$city,$plant){
        $this->_check_type(-1);
        $data['nickname'] = post('nickname','');
        $data['sex'] = post('sex',0,'%d');
        $data['city'] = post('city',0,'%d');
        $data['plant'] = post('plant','');
        $data['company'] = post('company','');
        $data['at_start'] = post('at_start',0,'%d');
        $data['at_end'] = post('at_end',0,'%d');
        $data['experience'] = post('experience','');
        $data['generator'] = post('generator',0,'%d');
        $data['label'] = post('label','');
        $data['field'] = post('field',0,'%d');
        $data['thumb'] = post('thumb','');
        $data['type'] = 0;
        $data['apply'] = 1;
        if(!$data['thumb'])unset($data['thumb']);
        $this->_change_info($data);
        $this->success();
    }

    function my_info(){
        $u = $this->userInfo;
        unset($u['password']);
        $t['info'] = $u;
        
        $t['fans'] = model('fans')->where(array('uid'=>$this->uid))->get_field();
        $t['follow'] = model('fans')->where(array('follow'=>$this->uid))->get_field();
        $t['collect'] = 0;
        $this->success($t);
    }

    function my_fans(){
        model('fans')->mapping('f');
        $t['fans'] = model('fans')->add(array(
            'user'=>array('_on'=>'f.fans_id=u.uid','_mapping'=>'u','nickname','tag','avatar'),
            '_table'=>array('_on'=>'f.fans_id=f2.uid','_mapping'=>'f2','fans_id'=>'follow')
        ))->where(array('uid'=>$this->uid))->select();
        foreach($t['fans'] as &$v)$v['follow'] = $v['follow']?'1':'0';
        $this->success($t);
    }


}
?>