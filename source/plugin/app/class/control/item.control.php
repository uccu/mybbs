<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class item extends base\basic{
    private $out = true;
    function _beginning(){
        


    }


    function lists($lid,$aid){
        $lid = post('lid',$lid);
        if($lid)$where['lid'] = $lid;
        $where['del'] = 1;
        $aid = post('aid',$aid);
        $where['aid'] = $aid;
        $q['list'] = model('goods')->add_table(array(
            'activity_list'=>array('aid','_on'=>'tid')
        ))->where($where)->limit(999)->select();
        if(!$q['list'])$this->errorCode(427);
        $this->success($q);
    }
    function types(){
        $where['del'] = 1;
        $q['list'] = model('goods_list')->where($where)->order(array('orders'))->limit(999)->select();
        if(!$q['list'])$this->errorCode(427);
        $this->success($q);
    }
    function info($tid){
        $tid = post('tid',$tid);
        $q['info'] = model('goods')->where($where)->find($tid);
        if(!$q['info'] || !$q['info']['del'])$this->errorCode(411);
        $q['collected'] =0;
        if($this->uid && model('collect')->where(array('uid'=>$this->uid,'tid'=>$tid))->find())$q['collected'] =1;
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
            $o = model('order')->field('SUM(`num`) as `s`')->where($where)->find();
            $o = $o?$o['s']:0;$has += $o;
            if($t['limits']<=$has)$this->errorCode(420);
        }

        
        //添加购物车
        if($cart){
            $data['num'] = array('add',1);
            $data['ctime'] = TIME_NOW;
            model('cart')->where($where)->data($data)->save();
        }else{
            $data['referee'] = post('referee',0);
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
                'collect'=>array(
                    '_on'=>'tuan_cart.uid=c.uid AND tuan_cart.tid=c.tid','id'=>'collected','_mapping'=>'c','_join'=>'LEFT JOIN'
                ),
                'goods'=>array(
                    'name','thumb','bean','price_act','price','_on'=>'tuan_cart.tid=g.tid','_mapping'=>'g'
                ),
            )
        )->where($data)->limit(999)->select();
        if(!$q['list'])$this->errorCode(427);
        foreach($q['list'] as &$v)$v['collected']=$v['collected']?'1':'0';
        $this->success($q);
    }

    function change_cart($cid,$num=1){
        $this->_check_login();
        $cid = post('cid',$cid);
        $z = model('cart')->find($cid);
        if(!$z)$this->errorCode(424);
        
        if($z['uid']==$this->uid){
            $num = post('num',$num,'%d');
            if($num>0){
                $_POST['tid'] = $z['tid'];
                $this->add_cart();
            }elseif($num+$z['num']<1){
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
    function order_list($status){
        $this->_check_login();
        $data['aid'] = $this->aid;
        $data['uid'] = $this->uid;
        $status = post('status',$status);
        if($status)$data['status'] = $status;
        $q['list'] = model('order')->add_table(array(
            'goods'=>array(
                'name','thumb','bean','price_act','price','_on'=>'tid'
            )
        ))->where($data)->limit(999)->select();
        if(!$q['list'])$this->errorCode(427);
        $this->success($q);
    }
    function torder($tid){
        //验证登录
        $this->_check_login();
        $tid = post('tid',$tid);
        $t = $this->_check_tid($tid,$this->aid);
        //验证购物车
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
            $o = model('order')->field('SUM(`num`) as `s`')->where($where)->find();
            $o = $o?$o['s']:0;$has += $o;
            if($t['limits']<=$has)$this->errorCode(420);
        }

        if(1){
            
            $data['aid'] = $this->aid;
            $data['uid'] = $this->uid;
            $data['tid'] = $tid;
            $data['referee'] = post('referee',0);
            $data['status'] = 1;
            $data['num'] = 1;
            $data['money'] = $data['num']*$t['price_act'];
            $data['price_act'] = $t['price_act'];
            $data['price'] = $t['price'];
            $data['thumb'] = $t['thumb'];
            $data['bean'] = $data['num']*$t['bean'];
            $data['coin'] = $data['num']*$t['coin'];
            $data['ctime'] = TIME_NOW;
            $zz = model('order')->data($data)->add();
            if(!$zz)$this->errorCode(421);
            $data['oid'] = $zz;
            $data['name'] = $t['name'];
            model('cart')->remove($cid);
            if($this->out){
                $q['user'] = model('user_address')->where(array('uid'=>$this->uid,'type'=>1))->find();
                if($q['user']){
                    $l = model('location')->limit(9999)->select('id');
                    $v = &$q['user'];
                    $v['area'] = $v['lid'];
                    $v['areaName'] = $l[$v['lid']]['title'];
                    if(!$v['area']){
                        $v['area'] = 0;$v['areaName'] = '';
                    }
                    $v['city'] = $l[$v['lid']]['pid'];
                    $v['cityName'] = $l[$v['city']]['title'];
                    if(!$v['city']){
                        $v['city'] = 0;$v['cityName'] = '';
                    }
                    $v['province'] = $l[$v['city']]['pid'];
                    $v['provinceName'] = $l[$v['province']]['title'];
                    if(!$v['province']){
                        $v['province'] = 0;$v['provinceName'] = '';
                    }
                }
                
        
            }
        }

        $q['list'] = array($data);
        $q['money'] = $data['money'];
        if($this->out)$this->success($q);
        return $data;
    }
    function order($cid){
        //验证登录
        $this->_check_login();

        //验证购物车
        $cid = post('cid',$cid);
        $z = model('cart')->find($cid);
        if(!$z)$this->errorCode(424);
        $tid = $z['tid'];

        if($z['uid']==$this->uid){
            $t = $this->_check_tid($tid,$this->aid);
            if(!$t)$this->errorCode(411);
            $data['aid'] = $this->aid;
            $data['uid'] = $this->uid;
            $data['tid'] = $z['tid'];
            $data['referee'] = $z['referee'];
            $data['status'] = 1;
            $data['num'] = $z['num'];
            $data['money'] = $data['num']*$t['price_act'];
            $data['price_act'] = $t['price_act'];
            $data['price'] = $t['price'];
            $data['thumb'] = $t['thumb'];
            $data['bean'] = $data['num']*$t['bean'];
            $data['coin'] = $data['num']*$t['coin'];
            $data['ctime'] = TIME_NOW;
            $zz = model('order')->data($data)->add();
            if(!$zz)$this->errorCode(421);
            $data['oid'] = $zz;
            $data['name'] = $t['name'];
            model('cart')->remove($cid);
            if($this->out){
                $q['user'] = model('user_address')->where(array('uid'=>$this->uid,'type'=>1))->find();
                if($q['user']){
                    $l = model('location')->limit(9999)->select('id');
                    $v = &$q['user'];
                    $v['area'] = $v['lid'];
                    $v['areaName'] = $l[$v['lid']]['title'];
                    if(!$v['area']){
                        $v['area'] = 0;$v['areaName'] = '';
                    }
                    $v['city'] = $l[$v['lid']]['pid'];
                    $v['cityName'] = $l[$v['city']]['title'];
                    if(!$v['city']){
                        $v['city'] = 0;$v['cityName'] = '';
                    }
                    $v['province'] = $l[$v['city']]['pid'];
                    $v['provinceName'] = $l[$v['province']]['title'];
                    if(!$v['province']){
                        $v['province'] = 0;$v['provinceName'] = '';
                    }
                }
            }
        }else $this->errorCode(700);

        $q['list'] = array($data);
        $q['money'] = $data['money'];
        if($this->out)$this->success($q);
        return $data;
    }
    function order_muti($cids=0){
        $this->out = false;
        $cids = post('cids',$cids);
        $cid = explode(',',$cids);
        $money = 0;
        foreach($cid as &$v){
            $v = $this->order($v);
            if($v['money'])$money+=$v['money'];
        }
        $q['user'] = model('user_address')->where(array('uid'=>$this->uid,'type'=>1))->find();
        if($q['user']){
            $l = model('location')->limit(9999)->select('id');
            $v = &$q['user'];
            $v['area'] = $v['lid'];
            $v['areaName'] = $l[$v['lid']]['title'];
            if(!$v['area']){
                $v['area'] = 0;$v['areaName'] = '';
            }
            $v['city'] = $l[$v['lid']]['pid'];
            $v['cityName'] = $l[$v['city']]['title'];
            if(!$v['city']){
                $v['city'] = 0;$v['cityName'] = '';
            }
            $v['province'] = $l[$v['city']]['pid'];
            $v['provinceName'] = $l[$v['province']]['title'];
            if(!$v['province']){
                $v['province'] = 0;$v['provinceName'] = '';
            }
        }
        $q['list'] = $cid;
        $q['money'] = $money;
        $this->success($q);

    }
    function unorder($oid){
        $this->_check_login();
        $oid = post('oid',$oid);
        $z = model('order')->find($oid);
        if($z['uid']==$this->uid)model('order')->remove($oid);
        $this->success();
    }
    function _pay(){
        $this->_check_login();
        if(!$oids = post('oids',''))$this->errorCode(425);
        $oids = explode(',',$oids);
        if(!$oids)$this->errorCode(425);
        $where['oid'] = array('contain',$oids,'IN');
        $where['status'] = 1;
        $where['aid'] = $this->aid;
        $o = model('order')->where($where)->limit(999)->select();
        $money = 0;
        if(!$o)$this->errorCode(425);
        foreach($o as $v)$money += $v['money'];
        $use_coin = post('use_coin',0);
        $coin_k = $this->userInfo['coin'];
        $coin = 0;
        if($use_coin && $coin_k){
            if($coin_k>=$money){
                $money = 0;$coin = $money;
            }else{
                $money -= $coin_k;$coin = $coin_k;
            }
        }
        $data['money'] = $money;
        $data['coin'] = $coin;
        $data['ctime'] = TIME_NOW;
        $data['oids'] = array('logic',$oids,'%s');
        $data['uid'] = $this->uid;
        $string = '1234567890';
        $data['pay_id']='98'.TIME_NOW;
        for($i=0;$i<10;$i++)$data['pay_id'] .=$i;
        model('pay_log')->data($data)->add();
        _pay_c($data['pay_id']);
        return $data;
    }
    function _pay_c($pay_id){
        $pay_id = post('pay_id','');
        $p = model('pay_log')->where(array('pay_id'=>$pay_id))->find();
        if(!$p)$this->errorCode(426);
        if($p['coin']){
            model('user')->data(array('coin'=>array('add',-1*$p['coin'])))->save($p['uid']);
            model('coin_log')->data(array('uid'=>$p['uid'],'coin'=>-1*$p['coin'],'info'=>'购买抵扣','ctime'=>TIME_NOW))->add();
        }
        $oids = unserialize($p['oids']);
        model('order')->where(array('oid'=>array('contain',$oids,'IN')))->data(array('status'=>2))->save();
        model('pay_log')->where(array('pay_id'=>$pay_id))->remove();
        
    }
    function _useCoin($money,$coin){

    }
    function alipay(){
        
        $this->success($orderInfo);
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