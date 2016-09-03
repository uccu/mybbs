<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class my extends base\basic{
    private $out = true;
    function _beginning(){
        $this->_check_login();


    }


    function info(){
        $q['myInfo'] = model('user')->find($this->uid);
        $this->success($q);
    }
    function has_message(){
        $where['uid'] = $this->uid;
        $where['read'] = 0;
        $z = model('message')->where($where)->find();
        $q['read'] = $z?'1':'0';
        $this->success($q);
    }


    function remind(){
        $this->success();
    }
    function add_address(){
        $data['ctime'] = TIME_NOW;
        $data['uid'] = $this->uid;
        $data['addr'] = post('addr','');
        if($data['addr'])$this->errorCode(414);
        model('user_address')->data($data)->add();
        $this->success();
    }
    function default_address($id){
        $id = post('id',0,$id);
        $z = model('user_address')->find($id);
        if(!$z || $z['uid']!=$this->uid)$this->errorCode(415);
        $where['uid'] = $this->uid;
        $data['type'] = 0;
        model('user_address')->where($where)->data($data)->save();
        $data['type'] = 1;
        model('user_address')->data($data)->save($id);
        $this->success();
    }
    function address_list(){
        $where['uid'] = $this->uid;
        $z['list'] = model('user_address')->where($where)->order(array('type'=>'DESC','ctime'=>'DESC'))->limit(999)->select();
        $this->success($z);
    }
    
    function coin(){
        $z['coin'] = $this->userInfo['coin'];
        $this->success($z);
    }
    function coin_custom(){//获取余额明细
        $where['uid'] = $this->uid;
        $where['status'] = array('contain',array(2,3,4,5));
        $where2 = '(`balance` != 0 OR `coin` != 0)';
        $z['list'] = model('order')->where($where)->where($where2)->limit(999)->select();
        $this->success($z);

    }
    function cash(){

    }
    function my_cash(){

    }
    function score_shop(){

    }
    function score_custom(){

    }
    function get_message(){


    }
    function close_push(){

    }
    
    function open_push(){
        
    }


    function avatar(){

    }

    function username(){

    }
    function sex(){

    }

    function birth(){

    }

    function sign_detail(){

    }

    function sign(){
 
    }

    function prize_list(){

    }
    function my_collect(){
        
    }
    function my_fans(){

    }
    function set_pay_password(){

    }

}
?>