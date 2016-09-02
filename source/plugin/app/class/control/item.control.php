<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class home extends base\basic{
    private $out = true;
    function _beginning(){
        


    }


    function lists($lid){
        $lid = post('lid',$lid);
        if($lid)$where['lid'] = $lid;
        $where['del'] = 1;
        $q['itemList'] = model('goods')->where($where)->limit(999)->select();
        $this->success($q);
    }
    function types(){
        $q['typeList'] = model('goods_list')->limit(999)->select();
        $this->success($q);
    }
    function info($tid){
        $tid = post('lid',$lid);
        $q['itemInfo'] = model('goods')->find($tid);
        $this->success($q);
    }
    function collect($tid){
        $this->_check_login();
        $data['uid'] = $this->uid;
        $data['tid'] = post('tid',$tid);
        if(!$data['tid'])$this->errorCode(411);
        if(model('collect')->where($data)->find())$this->errorCode(412);
        $data['ctime'] = TIME_NOW;
        model('collect')->data($data)->add(true);
        $this->success();
    }

    function uncollect($tid){
        $this->_check_login();
        $data['uid'] = $this->uid;
        $data['tid'] = post('tid',$tid);
        if(!$data['tid'])$this->errorCode(411);
        model('collect')->where($data)->remove();
        $this->success();
    }

    function add_cart($tid,$num=1){
        $this->_check_login();
        $data['uid'] = $this->uid;
        $data['tid'] = post('tid',$tid);
        if(!$data['tid'])$this->errorCode(411);
        $data['num'] = post('num',$num);
        if(!$data['num'])$this->errorCode(413);
        $data['ctime'] = TIME_NOW;
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