<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class other extends base\e{
    function _beginning(){
        //$this->_check_login();
    }

    function organ($bid=0){
        $where['bid'] = post('bid',$bid,'%d');
        $z['list'] = model('manager_organ')->where($where)->order(array('orders'))->limit(999)->select();
        $this->success($z);
    }
    function city($bid=0){
        $where['bid'] = array('logic',0,'!=');
        $z['list'] = model('manager_organ')->add_table(array(
            
        ))->where($where)->order(array('orders'))->limit(999)->select();
        $this->success($z);
    }

    function ver(){

        $out['ver_id'] = model('cache')->get('ver_id');
        $out['ver_message'] = model('cache')->get('ver_message');

        $this->success($out);

    }

    function time(){

        echo time();

    }

    function date(){

        echo date('Y-m-d H:i:s');
    }
    


}
?>