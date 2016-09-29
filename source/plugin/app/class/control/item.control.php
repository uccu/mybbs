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
        if(!$aid)$aid = $this->lastAid;
        $where['aid'] = $aid;
        $q['list'] = model('goods')->add_table(array(
            'activity_list'=>array('aid','_on'=>'tid','id')
        ))->where($where)->order(array('id'=>'DESC'))->limit(999)->select();
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
        $q['info'] = model('goods')->add_table(array(
            'goods_attribute'=>array(
                'attribute_name','_on'=>'lid'
            )
        ))->where($where)->find($tid);
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
        if(!$t['stock'])$this->errorCode(435);
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
        $data['uid'] = $this->uid;
        $q['list'] = model('cart')->add_table(
            array(
                'collect'=>array(
                    '_on'=>'tuan_cart.uid=c.uid AND tuan_cart.tid=c.tid','id'=>'collected','_mapping'=>'c','_join'=>'LEFT JOIN'
                ),
                'goods'=>array(
                    'name','thumb','bean','price_act','var','price','_on'=>'tuan_cart.tid=g.tid','_mapping'=>'g'
                ),
                'goods_attribute'=>array(
                    'attribute_name','_on'=>'lid'
                )
            )
        )->where($data)->limit(999)->select();
        if(!$q['list'])$this->errorCode(427);
        foreach($q['list'] as &$v)$v['collected']=$v['collected']?'1':'0';
        $this->success($q);
    }
    function cart_count(){
        $data['uid'] = $this->uid;
        $this->_check_login();
        
        $q['count'] = model('cart')->where($data)->get_field();
        $this->success($q);
    }
    
    function change_cart($cid,$num=1){
        $this->_check_login();
        $cid = post('cid',$cid);
        $z = model('cart')->find($cid);
        if(!$z)$this->errorCode(424);
        $this->aid;
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
        $data['uid'] = $this->uid;
        $status = post('status',$status);
        if($status)$data['status'] = $status;
        $q['list'] = model('order')->add_table(array(
            'goods'=>array(
                'name','thumb','bean','price_act','var','price','_on'=>'tid'
            ),
            'goods_attribute'=>array(
                'attribute_name','_on'=>'lid'
            )
        ))->where($data)->limit(999)->select();
        if(!$q['list'])$this->errorCode(427);
        $this->success($q);
    }
    function order_list_c($status){

        $status = post('status',$status);
        if($status<5)$this->errorCode(427);
        if($status)$data['status'] = $status;
        $q['list'] = model('order')->add_table(array(
            'goods'=>array(
                'name','thumb','bean','price_act','var','price','_on'=>'tid'
            ),
            'goods_attribute'=>array(
                'attribute_name','_on'=>'lid'
            )
        ))->where($data)->limit(999)->select();
        if(!$q['list'])$this->errorCode(427);
        $this->success($q);
    }
    function order_info($oid){
        $this->_check_login();
        $data['uid'] = $this->uid;
        $oid = post('oid',$oid);
        if(!$oid)$this->errorCode(425);
        $q['info'] = model('order')->add_table(array(
            'goods'=>array(
                'name','thumb','bean','price_act','var','price','_on'=>'tid'
            ),
            'goods_attribute'=>array(
                'attribute_name','_on'=>'lid'
            )
        ))->where($data)->find($oid);
        if(!$q['info'])$this->errorCode(427);
        if(!$q['info']['addr_id'])$q['info']['addr_id'] = model('user_address')->where(array('uid'=>$this->uid,'type'=>1))->get_field('id');
        $q['addr'] = model('user_address')->find($q['info']['addr_id']);
        $l = model('location')->limit(9999)->select('id');
            $v = &$q['addr'];
            $v['area'] = $v['lid'];
            if(!$v){
                $v['id'] = '';
                $v['uid'] = '';
                $v['addr'] = '';
                $v['type'] = '';
                $v['ctime'] = '';
                $v['name'] = '';
                $v['phone'] = '';
                $v['lid'] = '';
                $v['area'] = '';
            }
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
        

        
        $this->success($q);
    }
    function money($oids){
        $oids = post('oids',$oids);
        $oids = explode(',',$oids);
        $c = model('order')->where(array('oid'=>array('contain',$oids,'IN')))->get_field('SUM(`money`)');
        if(!$c)$c = "0";
        $data['money'] = $c; 
        $this->success($data);
    }
    function torder($tid){
        //验证登录
        $this->_check_login();
        $tid = post('tid',$tid);
        $t = $this->_check_tid($tid,$this->aid);
        //验证库存
        if(!$t['stock'])$this->errorCode(435);

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
            $data['attribute_name'] = $t['attribute_name'];
            $data['var'] = $t['var'];
            model('cart')->remove($cid);
            if($this->out){
                $q['user'] = model('user_address')->where(array('uid'=>$this->uid,'type'=>1))->limit(1)->select();
                if($q['user'][0]){
                    $l = model('location')->limit(9999)->select('id');
                    $v = &$q['user'][0];
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
            //验证库存
            if($t['stock']<$z['num'])$this->errorCode(435);
            model('goods')->data(array(
                'stock'=>array('add',-1*$z['num']),
                'sale'=>array('add',$z['num'])
            ))->save($tid);
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
            $data['oid'] = (string)$zz;
            $data['name'] = $t['name'];
            $data['attribute_name'] = $t['attribute_name'];
            $data['var'] = $t['var'];
            model('cart')->remove($cid);
            if($this->out){
                $q['user'] = model('user_address')->where(array('uid'=>$this->uid,'type'=>1))->limit(1)->select();
                if($q['user']){
                    $l = model('location')->limit(9999)->select('id');
                    $v = &$q['user'][0];
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
        $this->_check_login();
        $this->out = false;
        $cids = post('cids',$cids);
        $cid = explode(',',$cids);
        $money = 0;
        foreach($cid as &$v){
            $v = $this->order($v);
            if($v['money'])$money+=$v['money'];
        }
        $q['user'] = model('user_address')->where(array('uid'=>$this->uid,'type'=>1))->limit(1)->select();
        if($q['user']){
            $l = model('location')->limit(9999)->select('id');
            $v = &$q['user'][0];
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
    function order_change($addr_id,$oid){
        $this->_check_login();
        $addr_id = post('addr_id',$addr_id,'%d');
        $oid = post('oid',$oid);
        $oid = explode(',',$oid);
        if(!$o = model('user_address')->find($addr_id))$this->errorCode(433);
        foreach($oid as $v){
            model('order')->where(array('oid'=>$v,'uid'=>$this->uid))->data(array('addr_id'=>$addr_id))->save();
        }
        $this->success();
    }
    function unorder($oid){
        $this->_check_login();
        $oid = post('oid',$oid);
        $z = model('order')->find($oid);
        if(!$z)$this->errorCode(425);
        model('goods')->data(array(
            'stock'=>array('add',$z['num']),
            'sale'=>array('add',-1*$z['num'])
        ))->save($oid);
        if($z['uid']==$this->uid)model('order')->remove($oid);
        $this->success();
    }
    function get_item($oid){
        $this->_check_login();
        $oid = post('oid',$oid);
        $z = model('order')->find($oid);
        if(!$z)$this->errorCode(425);
        if($z['status']!=3)$this->errorCode(439);
        model('user')->data(array('score'=>array('add',100)))->save($z['uid']);
        model('score_log')->data(array(
            'uid'=>$z['uid'],
            'score'=>100,
            'info'=>'确认订单',
            'ctime'=>TIME_NOW
        ))->add();
        $z = model('order')->data(array('status'=>4))->save($oid);
        if(!$z)$this->errorCode(439);
        $this->success();
    }
    function _pay($oids,$use_coin){
        $this->_check_login();
        if(!$oids = post('oids',$oids))$this->errorCode(425);
        $oids = explode(',',$oids);
        if(!$oids)$this->errorCode(425);
        $where['oid'] = array('contain',$oids,'IN');
        $where['status'] = 1;
        $where['aid'] = $this->aid;
        $o = model('order')->where($where)->limit(999)->select();
        $money = 0;
        if(!$o)$this->errorCode(425);
        foreach($o as $v)$money += $v['money'];
        $use_coin = post('use_coin',$use_coin,'%d');
        $coin_k = $this->userInfo['coin'];
        $coin = 0;
        if($use_coin && $coin_k){
            if($coin_k>=$money){
                $coin = $money;
                $money = 0;
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
        for($i=0;$i<10;$i++)$data['pay_id'] .=$string[rand(0,9)];
        $id = model('pay_log')->data($data)->add();
        if(!$data['money'])$this->_pay_c($data['pay_id'],$id);
        return $data;
    }
    function _pay_c($pay_id,$id){
        file_put_contents ( 't3.txt', $pay_id );
        //获取支付单详情
        $pay_id = post('pay_id',$pay_id);
        if($id)$where['id'] = $id;
        else $where['pay_id'] = $pay_id;
        $p = model('pay_log')->where($where)->find();
        if(!$p)$this->errorCode(426);

        //删除其他支付单
        $where = array();
        $where['uid'] = $p['uid'];
        $where['pay_id'] = array('logic',$pay_id,'!=');
        model('pay_log')->where($where)->remove();

        if($p['score'])$this->_pay_score_c($p);


        //获取最近的一期活动ID与操作用户
        $aid = $this->lastAid;
        $uid = $p['uid'];

        //余额抵扣
        if($p['coin']){
            $userInfo = model('user')->find($uid);
            if($userInfo['coin']<$p['coin'])$this->errorCode(429);
            model('user')->data(array('coin'=>array('add',-1*$p['coin'])))->save($p['uid']);

            $this->_pusher('余额发生变动：购买抵扣',$uid);
            //余额明细调整
            model('coin_log')->data(array('uid'=>$p['uid'],'coin'=>-1*$p['coin'],'info'=>'购买抵扣','ctime'=>TIME_NOW))->add();
            model('message')->data(array('uid'=>$p['uid'],'content'=>'购买抵扣扣除'.$p['coin'].'余额','ctime'=>TIME_NOW))->add();
        }

        //操作订单列表
        $oids = unserialize($p['oids']);
        $where = array();
        $where['oid'] = array('contain',$oids,'IN');
        $orders = model('order')->where($where)->limit(999)->select();
        
        



        //粉丝调整
        $data = array();
        $data['fans_id'] = $uid;
        $data['ctime'] = TIME_NOW;
        $data['aid'] = $aid;
        $data['buy'] = 1; 
        foreach($orders as $o)if($o['referee']){
            $data['uid'] = $o['referee'];
            model('fans')->data($data)->add(true);
        }


        
        //是否为自己的第一张订单
        $where = array();
        $where['aid'] = $aid;
        $where['uid'] = $uid;
        $where['status'] = array('contain',array(2,3,4),'IN');
        if(!model('order')->where($where)->find()){
            $CONFIG_FIRST = 1;
        }

        $CONFIG_SHARE_FIRST = array();
        $CONFIG_REFEREE_FIRST = array();
        foreach($orders as $o){
            $data = array();
            $where = array();
            if($o['referee']){
                //是否为好友的下线的第一张订单
                $where['aid'] = $aid;
                $where['referee'] = $o['referee'];
                $hwere['share_first'] = 1;
                $where['status'] = array('contain',array(2,3,4),'IN');
                if(!$CONFIG_SHARE_FIRST[$o['referee']] && !model('order')->where($where)->find()){
                    $data['share_first'] = 1;$CONFIG_SHARE_FIRST[$o['referee']] = 1;
                }

                //是否为好友的第一张订单
                $where = array();
                $where['aid'] = $aid;
                $where['referee'] = $o['referee'];
                $hwere['referee_first'] = 1;
                $where['status'] = array('contain',array(2,3,4),'IN');
                if(!$CONFIG_REFEREE_FIRST[$o['referee']] && !model('order')->where($where)->find()){
                    $data['referee_first'] = 1;$CONFIG_REFEREE_FIRST[$o['referee']]=1;
                }else{
                    //调整乐帮排名
                    $data2['num'] = model('order')->where($where)->get_field();
                    if($data2['num']==5){
                        $data2['aid'] = $aid;
                        $data2['uid'] = $o['referee'];
                        $data2['time'] = $this->microtime;
                        model('rank_bang')->data($data2)->add();
                    }elseif($data2['num']>5){
                        model('rank_bang')->where(array('uid'=>$o['referee'],'aid'=>$aid))->data($data2)->save();
                    }
                }
            }

            if($o['bean']){
                //调整我的乐豆排名
                $where = array();
                $where['uid'] = $uid;
                $where['aid'] = $aid;
                if(!model('rank_bean')->where($where)->data(array('bean'=>array('add',$o['bean'])))->save()){
                    $where['bean'] = $o['bean'];
                    model('rank_bean')->data($where)->add();
                }
                if($o['referee']){
                    //调整上一级乐豆排名
                    $where = array();
                    $where['uid'] = $o['referee'];
                    $where['aid'] = $aid;
                    if(!model('rank_bean')->where($where)->data(array('bean'=>array('add',$o['bean'])))->save()){
                        $where['bean'] = $o['bean'];
                        model('rank_bean')->data($where)->add();
                    }


                    //调整上上一级乐豆排名


                }
            }
            //订单设置为状态2
            if($CONFIG_FIRST)$data['first'] = 1;
            $data['status'] = 2;
            $data['pay_time'] = $this->microtime;
            model('order')->data($data)->save($o['oid']);
            $CONFIG_FIRST = 0;
        }


        //删除支付单
        model('pay_log')->where(array('pay_id'=>$pay_id))->remove();
        
    }
    function _pay_score_c($p){
        model('user')->data(array('score'=>array('add',$p['score'])))->save($p['uid']);
        model('score_log')->data(array(
            'uid'=>$p['uid'],
            'score'=>$p['score'],
            'info'=>'充值积分',
            'ctime'=>TIME_NOW
        ))->add();
        $this->success();
    }
    function _useCoin($money,$coin){

    }
    function alipay($oids,$use_coin=1){
        $data['c'] = $dat = $this->_pay($oids,$use_coin);
        $data['p'] = control('tool:pay')->_alipay($dat);
        $this->success($data);
    }
    function wxpay($oids,$use_coin=1){
        $data['c'] = $dat = $this->_pay($oids,$use_coin);
        $data['p'] = control('tool:pay')->_wcpay($dat);
        $this->success($data);
    }
    function alipayx($money){
        $this->_check_login();
        $money = post('money',$money,'%d'); 
        $string = '1234567890';
        $data['pay_id']='98'.TIME_NOW;
        for($i=0;$i<10;$i++)$data['pay_id'] .=$string[rand(0,9)];
        $data['uid'] = $this->uid;
        $data['money'] = $money;
        $data['score'] = $money*100;
        $data['ctime'] = TIME_NOW;
        model('pay_log')->data($data)->add();
        $dat['p'] = control('tool:pay')->_alipay($data);
        $this->success($dat);
    }
    function wxpayx($money){
        $this->_check_login();
        $money = post('money',$money,'%d'); 
        $string = '1234567890';
        $data['pay_id']='98'.TIME_NOW;
        for($i=0;$i<10;$i++)$data['pay_id'] .=$string[rand(0,9)];
        $data['uid'] = $this->uid;
        $data['money'] = $money;
        $data['score'] = $money*100;
        $data['ctime'] = TIME_NOW;
        model('pay_log')->data($data)->add();
        $dat['p'] = control('tool:pay')->_wcpay($data);
        $this->success($dat);
    }
    function coinx($money){
        $this->_check_login();
        $money = post('money',$money,'%d'); 
        if($this->userInfo['coin']<$money)$this->errorCode(429);
        model('user')->data(array('coin'=>array('add',-1*$money),'score'=>array('add',$money*100)))->save($this->uid);
        $this->_pusher('余额发生变动：充值积分',$this->uid);
        model('coin_log')->data(array('uid'=>$this->uid,'coin'=>-1*$money,'info'=>'充值积分','ctime'=>TIME_NOW))->add();
        model('message')->data(array('uid'=>$this->uid,'content'=>'充值积分扣除'.$money.'余额','ctime'=>TIME_NOW))->add();
        model('score_log')->data(array(
            'uid'=>$this->uid,
            'score'=>$money*100,
            'info'=>'充值积分',
            'ctime'=>TIME_NOW
        ))->add();
        $this->success();
    }
    function stime(){
        $this->success($this->microtime);
    }

    function pay_c($out_trade_no){
        $pay_id = post('out_trade_no',$out_trade_no);
        model('cache')->replace('pay_id_00001',$pay_id);
        $this->_pay_c($pay_id);
        $this->success();
    }
    function alipay_c(){
        //file_put_contents ('ALIPAY_SERVER.txt' ,json_encode($_POST) );
        $out_trade_no = $_POST ['out_trade_no'];
        if(post('trade_status')=='TRADE_SUCCESS')$this->_pay_c($out_trade_no.'');
        // require "/alipay/alipay.config.php";
        // require "/alipay/lib/alipay_notify.class.php";
        // $alipayNotify = new \AlipayNotify ( $alipay_config );
        // $verify_result = $alipayNotify->verifyNotify ();
        //file_put_contents ('ALIPAY_SERVER2.txt' ,json_encode($verify_result) );
        echo "SUCCESS";die();
    }
    function wcpay_c(){
        $postStr = file_get_contents ( 'php://input' );
        // file_put_contents ( 't1.txt', $postStr );
        // preg_match('#(98\d{20})#',$postStr,$zk);
        // file_put_contents ( 't2.txt', $zk[0] );
        // 
        $a =  simplexml_load_string ( $postStr );
        if($a->result_code.'' == 'SUCCESS'){
            $h = 'appid='.$a->appid;
            $h .= '&bank_type='.$a->bank_type;
            $h .= '&cash_fee='.$a->cash_fee;
            $h .= '&fee_type='.$a->fee_type;
            $h .= '&is_subscribe='.$a->is_subscribe;
            $h .= '&mch_id='.$a->mch_id;
            $h .= '&nonce_str='.$a->nonce_str;
            $h .= '&openid='.$a->openid;
            $h .= '&out_trade_no='.$a->out_trade_no;
            $h .= '&result_code='.$a->result_code;
            $h .= '&return_code='.$a->return_code;
            $h .= '&time_end='.$a->time_end;
            $h .= '&total_fee='.$a->total_fee;
            $h .= '&trade_type='.$a->trade_type;
            $h .= '&transaction_id='.$a->transaction_id;
            $h .= '&key=7EA97FA5C1534CD91FE666690A60E927';
            if($a->sign.'' === strtoupper ( md5 ( $h ) )){
                $this->_pay_c($a->out_trade_no.'');
                echo "SUCCESS";die();
            }
        }
        echo "FAIL";
    }
    function test(){
        $z = '<xml><appid><![CDATA[wx6257377cf020d6e7]]></appid>
        <bank_type><![CDATA[CFT]]></bank_type>
        <cash_fee><![CDATA[1]]></cash_fee>
        <fee_type><![CDATA[CNY]]></fee_type>
        <is_subscribe><![CDATA[N]]></is_subscribe>
        <mch_id><![CDATA[1392240002]]></mch_id>
        <nonce_str><![CDATA[93b793a8b2fe3b6b98b9e567fff97ef3]]></nonce_str>
        <openid><![CDATA[o_8NWwi5NJiKaYqAtIjqTg8V0D1U]]></openid>
        <out_trade_no><![CDATA[9814745391722102072082]]></out_trade_no>
        <result_code><![CDATA[SUCCESS]]></result_code>
        <return_code><![CDATA[SUCCESS]]></return_code>
        <sign><![CDATA[01C9FAE619E53496F74B0E5D854EA1A8]]></sign>
        <time_end><![CDATA[20160922181258]]></time_end>
        <total_fee>1</total_fee>
        <trade_type><![CDATA[APP]]></trade_type>
        <transaction_id><![CDATA[4004552001201609224638440667]]></transaction_id>
        </xml>';
        $a =  simplexml_load_string ( $z );
        $h = 'appid='.$a->appid;
        $h .= '&bank_type='.$a->bank_type;
        $h .= '&cash_fee='.$a->cash_fee;
        $h .= '&fee_type='.$a->fee_type;
        $h .= '&is_subscribe='.$a->is_subscribe;
        $h .= '&mch_id='.$a->mch_id;
        $h .= '&nonce_str='.$a->nonce_str;
        $h .= '&openid='.$a->openid;
        $h .= '&out_trade_no='.$a->out_trade_no;
        $h .= '&result_code='.$a->result_code;
        $h .= '&return_code='.$a->return_code;
        $h .= '&time_end='.$a->time_end;
        $h .= '&total_fee='.$a->total_fee;
        $h .= '&trade_type='.$a->trade_type;
        $h .= '&transaction_id='.$a->transaction_id;
        $h .= '&key=7EA97FA5C1534CD91FE666690A60E927';
        // echo $h.'<br>';
        // echo $a->sign.'<br>';
        // echo strtoupper ( md5 ( $h ) ).'<br>';
        if($a->sign.'' === strtoupper ( md5 ( $h ) ))echo 'SUCCESS';
        else echo 'FAIL';

    }
    function test2(){
        $data = '{
            "discount": "0.00",
            "payment_type": "1",
            "subject": "购买乐商部落商品",
            "trade_no": "2016092321001004350290564849",
            "buyer_email": "627024472@qq.com",
            "gmt_create": "2016-09-23 13:35:28",
            "notify_type": "trade_status_sync",
            "quantity": "1",
            "out_trade_no": "9814746089245152175040",
            "seller_id": "2088421747319415",
            "notify_time": "2016-09-23 15:00:20",
            "body": "乐商部落商品",
            "trade_status": "TRADE_SUCCESS",
            "is_total_fee_adjust": "N",
            "total_fee": "0.01",
            "gmt_payment": "2016-09-23 13:35:29",
            "seller_email": "leshangbuluo@sina.com",
            "price": "0.01",
            "buyer_id": "2088502824880353",
            "notify_id": "a1924b1809dbff8ab70fd5f73414803ipa",
            "use_coupon": "N",
            "sign_type": "RSA",
            "sign": "fnSyNU55oIZIQ34A7MublIMwNrBR4XcuvMZMLTNvJq+yYcDcLB9/KW8n0ZIQTS53lYLWq+MoODVqYD0tSxGPWf37+wv/zdNCbQTFmvgaLVEo7shldugYQK3uV2N4BTO48Q3OACyuclXQScrALTJSohSaao4BJtcFt4cUqKpUj7k="
        }';
        $dataj = $data = json_decode($data,true);
        require "/alipay/alipay.config.php";
        require "/alipay/lib/alipay_notify.class.php";

        $_POST = $_GET = $dataj;
        $alipayNotify = new \AlipayNotify ( $alipay_config );
        $verify_result = $alipayNotify->verifyNotify ();
        var_dump($verify_result);
    }
    function test3(){
        $z = $this->_pusher('测试',1);
        var_dump($z);
    }

}
?>