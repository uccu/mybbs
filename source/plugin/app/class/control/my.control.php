<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class my extends base\e{
    function _beginning(){
        $this->_check_login();
    }
    function choose_char($type){
        if($this->userInfo['type'] != -1)$this->errorCode(408);
        $type = post('type',$type,'0');
    }
}
?>