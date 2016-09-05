<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class home extends base\basic{
    private $out = true;
    function _beginning(){
        //测试
        if(!$_POST)$_POST = $_GET;


    }


    function lists($lid){
        $lid = post('lid',$lid);
        if($lid)$where['lid'] = $lid;
        $where['del'] = 1;
        $q['list'] = model('goods')->where($where)->limit(999)->select();
        $this->success($q);
    }
    function types(){
        $q['list'] = model('goods_list')->limit(999)->select();
        $this->success($q);
    }
    function info($tid){
        $tid = post('lid',$lid);
        $q['info'] = model('goods')->find($tid);
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
        $data['aid'] = $this->aid;
        $data['uid'] = $this->uid;
        $data['tid'] = post('tid',$tid);
        if(!$data['tid'])$this->errorCode(411);
        $data['num'] = post('num',$num,'%d');

        $where['aid'] = $data['aid'];
        $where['tid'] = $data['tid'];
        $where['uid'] = $data['uid'];
        $t = model('goods')->find($tid);
        if(!$t)$this->errorCode(411);
        $c = $cart = model('cart')->where($where)->find();
        $c = $c?$c['num']:0;
        if($t['limit']){
            $o = model('order')->field('SUM(`num`) as `s`')->where($where)->get_field('s');
            $o = $o?$o:0;
            if($t['limit']<=$o+$c)$this->errorCode(420);
        }
        if(!$data['num'])$this->errorCode(413);
        $data['ctime'] = TIME_NOW;
        if($cart){
            $data['num'] = array('add',1);
            model('cart')->data($data)->save($cart['cid']);
        }
        else model('cart')->data($data)->add();
        $this->success();
    }

    function remove_cart($cid){
        $this->_check_login();
        $cid = post('cid',$cid);
        $z = model('cart')->find($cid);
        if($z['uid']==$this->uid)model('cart')->remove($cid);
        $this->success();
    }

    function cart(){
        $this->_check_login();
        $data['aid'] = $this->aid;
        $data['uid'] = $this->uid;
        $q['list'] = model('cart')->add_table(
            array(
                'goods'=>array(
                    'name','thumb','bean','_on'=>'tid'
                )
            )
        )->where($data)->limit(999)->select();
        $this->success($q);
    }

    function change_cart(){
        $this->_check_login();
        $data['aid'] = $this->aid;
        $data['uid'] = $this->uid;
        $z = model('cart')->find($cid);
        if($z['uid']==$this->uid){
            $num = post('num',0,'%d');
            $data['num'] = array('add',$num);
            model('cart')->data($data)->save($cid);
        }
        $this->success();
    }
    function order_list(){
        $this->_check_login();
        $data['aid'] = $this->aid;
        $data['uid'] = $this->uid;
        $q['list'] = model('order')->add_table(array('goods'=>array(
            'name','thumb','bean','_on'=>'tid'
        )))->where($data)->limit(999)->select();
        $this->success($q);
    }
    function order($cid){
        $this->_check_login();
        $cid = post('cid',$cid);
        $z = model('cart')->find($cid);
        if($z['uid']==$this->uid){
            $t = model('goods')->find($tid);
            if(!$t)$this->errorCode(411);
            $data['aid'] = $this->aid;
            $data['uid'] = $this->uid;
            $data['tid'] = $z['tid'];
            $data['status'] = 1;
            $data['num'] = $z['num'];
            $data['money'] = $data['num']*$t['price_act'];
            $data['bean'] = $t['bean'];
            $data['coin'] = $t['coin'];
            $z = model('order')->data($data)->add();
            if(!$z)$this->errorCode(421);
            $q['oid'] = $z;
        }
        $this->success($q);
    }
    function unorder($oid){
        $this->_check_login();
        $oid = post('oid',$oid);
        $z = model('order')->find($oid);
        if($z['uid']==$this->uid)model('order')->remove($oid);
        $this->success($q);
    }
    function _useCoin(){

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