<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class maintenance extends base\e{//运维
    function _beginning(){
        //$this->_check_login();
    }

    function company(){
        $page = post('page',1);
        $limit = post('limit',10);
        $z['list'] = model('install')->page($page,$limit)->order(array('location'))->select();
        $this->success($z);
    }

    function sale(){
        $page = post('page',1);
        $limit = post('limit',10);
        $z['list'] = model('sale')->page($page,$limit)->order(array('location'))->select();
        $this->success($z);
    }
    



}
?>