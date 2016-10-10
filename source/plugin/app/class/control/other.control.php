<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class other extends base\e{
    function _beginning(){
        //$this->_check_login();
    }

    function organ($bid=0){
        $where['bid'] = post('bid',$bid,'%d');
        $z['list'] = model('manager_organ')->where($where)->select();
        $this->success($z);
    }
    



}
?>