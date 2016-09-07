<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class item extends base\basic{
    private $out = true;
    function _beginning(){
        


    }


    function lists($lid){
        $lid = post('lid',$lid);
        if($lid)$where['lid'] = $lid;
        $where['del'] = 1;
        $q['list'] = model('goods')->where($where)->limit(999)->select();
        $this->success($q);
    }
    function types(){
        $where['del'] = 1;
        $q['list'] = model('goods_list')->where($where)->limit(999)->select();
        $this->success($q);
    }
    function info($tid){
        $tid = post('tid',$tid);
        $q['info'] = model('goods')->where($where)->find($tid);
        if(!$q['info'] || !$q['info']['del'])$this->errorCode(411);
        $this->success($q);
    }
    function collect($tid){
        $this->_check_login();
        $data['uid'] = $this->uid;
        $data['tid'] = $tid = post('tid',$tid);
        $this->_check_tid($tid);
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

    function add_cart($tid){

        //登录判断
        $this->_check_login();

        //商品存在判断+商品是否当前活动判断
        $tid = post('tid',$tid);
        $t = $this->_check_tid($tid,$this->aid);

        //定义已经购买的数量
        $has = 0;

        $where['aid'] = $this->aid;
        $where['tid'] = $tid;
        $where['uid'] = $this->uid;

        if($t['limits']){

            //检查购物车已添加数量是否超过阈值
            $cart = model('cart')->where($where)->find();
            $c = $cart?$cart['num']:0;$has += $c;
            if($t['limits']<=$has)$this->errorCode(420);

            //检查订单已购买数量是否超过阈值
            echo $o = model('order')->field('SUM(`num`) as `s`')->where($where)->find();
            $o = $o?$o['s']:0;$has += $o;
            if($t['limits']<=$has)$this->errorCode(420);
        }

        
        //添加购物车
        if($cart){
            $data['num'] = array('add',1);
            $data['ctime'] = TIME_NOW;
            model('cart')->where($where)->data($data)->save();
        }else{
            $data['aid'] = $this->aid;
            $data['tid'] = $tid;
            $data['uid'] = $this->uid;
            $data['num'] = 1;
            $data['ctime'] = TIME_NOW;
            model('cart')->data($data)->add();
        }
        $this->success();
    }

    function remove_cart($cid){
        $this->_check_login();
        $cid = post('cid',$cid);
        $z = model('cart')->find($cid);
        if($z['uid']==$this->uid)model('cart')->remove($cid);
        else $this->errorCode(700);
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
        $z = model('cart')->find($cid);
        if(!$z){
            $this->errorCode(424);
        }
        if($z['uid']==$this->uid){
            $num = post('num',0,'%d');
            if($num>0){
                $_POST['tid'] = $z['tid'];
                $this->add_cart();
            }elseif($num>=$z['num']){
                $this->errorCode(413);
            }else{
                $data['num'] = array('add',$num);
                model('cart')->data($data)->save($cid);
            }
        }else{
            $this->errorCode(700);
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
        $this->success();
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