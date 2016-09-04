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
        $where['status'] = array('contain',array(2,3,4,5),'IN');
        $where2 = '(`balance` != 0 OR `coin` != 0)';
        $z['list'] = model('order')->where($where)->where($where2)->limit(999)->select();
        $this->success($z);

    }
    function cash(){
        $_POST['uid'] = $this->uid;
        unset($_POST['id']);
        $_POST['ctime'] = TIME_NOW;
        $z['id'] = model('cash_apply')->data($_POST)->add();
        $this->success($z);
    }
    function my_cash(){
        $data['uid'] = $this->uid;
        $z['list'] = model('cash_apply')->where($where)->order(array('ctime'=>'DESC'))->limit(999)->select();
        $this->success($z);
    }
    function score_shop(){
        $where['score'] = array('logic',0,'!=');
        $z['list'] = model('goods')->where($where)->order(array('ctime'=>'DESC'))->limit(999)->select();
        $this->success($z);
    }
    function score_custom(){
        $where['score'] = array('logic',0,'!=');
        $z['list'] = model('order')->add_table(array(
            'goods'=>array('name','_on'=>'tid')
        ))->where($where)->order(array('ctime'=>'DESC'))->limit(999)->select();
        $this->success($z);
    }
    function get_message(){
        $where['uid'] = $this->uid;
        $z['list'] =model('message')->where($where)->order(array('ctime'=>'DESC'))->select();
        $this->success($z);

    }
    


    function avatar($avatar){
        if($avatar = post('avatar','',$avatar)){
            model('user')->data(array('avatar'=>$avatar))->save($this->uid);
        }else{
            $this->errorCode(416);
        }
        $this->success();
    }

    function username($username){
        if($username = post('username','',$username)){
            model('user')->data(array('username'=>$username))->save($this->uid);
        }else{
            $this->errorCode(416);
        }
        $this->success();
    }
    function sex($sex){
        if($sex = post('sex','',$sex)){
            model('user')->data(array('sex'=>$sex))->save($this->uid);
        }else{
            $this->errorCode(416);
        }
        $this->success();
    }

    function birth($z){
        $z = post('birth','',$z);
        if($z!=''){
            model('user')->data(array('birth'=>$z))->save($this->uid);
        }else{
            $this->errorCode(416);
        }
        $this->success();
    }

    function sign_detail(){
        $z = model('sign')->where(array('uid'=>$this->uid))->find();
        if(!$z){
            $z['times'] = '0';
            $z['signed'] = '1';
        }
        else{
            $la = strtotime(date('Y-m-d',$z['time']));
            if($la<$this->yesterday){
                $z['times'] = '0';
                $z['signed'] = '1';
            }elseif($la<$this->today){
                $z['signed'] = '0';
            }else{
                $z['signed'] = '1';
            }
        }
        $f['info'] = $z;
        $f['rule'] = model('sign_rule')->limit(999)->order(array('day'))->select('day');
        $this->success($f);
    }

    function sign(){
        $z = model('sign')->where(array('uid'=>$this->uid))->find();
        if(!$z){
            $data['times'] = 1;
        }
        else{
            $la = strtotime(date('Y-m-d',$z['time']));
            if($la<$this->yesterday){
                $data['times'] = 1;
            }elseif($la<$this->today){
                $data['times'] = $z['times'] + 1;
            }else{
                $this->errorCode(417);
            }
        }
        $data['uid'] = $this->uid;
        $data['time'] = TIME_NOW;
        $z = model('sign')->data($data)->add(true);
        $this->success();
    }

    
    function my_collect(){
        $where['uid'] = $this->uid;
        $z['list'] = model('collect')->add_table(array(
            'goods'=>array(
                'name','thumb','bean','_on'=>'tid'
            )
        ))->where($where)->order(array('ctime'=>'DESC'))->limit(999)->select();
        $this->success($z);
    }
    function my_fans(){
        $where['uid'] = $this->uid;
        $z['list'] = model('fans')->add_table(array(
            'user'=>array(
                'username','avatar','bean','_mapping'=>'u','_on'=>'tuan_fans.fans_id=u.uid'
            )
        ))->where($where)->order(array('ctime'=>'DESC'))->limit(999)->select();
        $this->success($z);
    }
    function set_pay_password(){
        $p = post('pay_password','');
        $_POST['phone'] = $this->userInfo['phone'];
        if(!$_POST['phone'])$this->errorCode(418);
        control('tool:captcha')->_check_captcha();
        $data['pay_password'] = $p?md5($p):'';
        model('user')->data($data)->save($this->uid);
        $this->success();
    }

    function close_push(){
        $this->success();
    }
    
    function open_push(){
        $this->success();
    }

    function remind(){
        $this->success();
    }


    function exchange($tid){
        $tid = post('tid',0,$tid);
        $t = model('goods')->find($tid);
        if(!$t)$this->errorCode(411);
        if(!$t['score'])$this->errorCode(422);
        $data['uid'] = $this->uid;
        $data['tid'] = $z['tid'];
        $data['status'] = 1;
        $data['num'] = 1;
        $data['score'] = $t['score'];
        $z = model('order')->data($data)->add();
        if(!$z)$this->errorCode(421);
        $q['oid'] = $z;
        $this->success($q);
    }
}
?>