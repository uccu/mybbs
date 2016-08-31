<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class home extends base\basic{
    private $out = true;
    function _beginning(){
        


    }


    function lists(){

        $q['itemList'] = array();
        $this->success($q);
    }
    function types(){
        
        $q['typeList'] = array();
        $this->success($q);
    }
    function info(){
        $q['itemInfo'] = array();
        $this->success($q);
    }
    function collect(){

        $this->success();
    }

    function uncollect(){

        $this->success();
    }

    function add_cart(){

        $this->success();
    }

    function remove_cart(){

        $this->success();
    }

    function cart(){
        $q['itemList'] = array();
        $this->success($q);
    }

    function change_cart(){

        $this->success();
    }
    function order_list(){
        $q['itemList'] = array();
        $this->success($q);
    }
    function order(){

        $this->success();
    }
    function unorder(){

        $this->success();
    }
    function alipay(){
        
        $this->success();
    }
    function wxpay(){

        $this->success();
    }

    function alipay_c(){
        
        $this->success();
    }
    function wxpay_c(){
        
        $this->success();
    }


}
?>