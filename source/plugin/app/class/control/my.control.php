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
        if($this->userInfo['type'] != -1)$this->errorCode(408);
        $type = post('type',$type,'0');
        if($type!=1)$type = 0;
        $data['count'] = model('user')->data(array('type'=>$type))->save($this->uid);
        $this->success($data);
    }

    function change_nickname($nickname,$sex){
        $data['nickname'] = post('nickname',$nickname);
        $data['sex'] = post('sex',$sex);
        $data['city'] = post('city');
        $this->_change_info($data);


        $this->success();
    }



}
?>