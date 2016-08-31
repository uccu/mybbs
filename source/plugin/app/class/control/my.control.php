<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class home extends base\basic{
    private $out = true;
    function _beginning(){
        


    }


    function info(){

        $q['myInfo'] = array();
        $this->success($q);
    }
    function has_message(){

        $this->success($q);
    }
    function order_list(){
        $q['itemList'] = array();
        $this->success($q);
    }
    function unorder(){

    }
    function order_info(){
        
    }

    function remind(){
        
    }

}
?>