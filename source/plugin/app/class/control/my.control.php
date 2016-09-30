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


}
?>