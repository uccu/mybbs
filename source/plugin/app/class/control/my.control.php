<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class my extends base\basic{
    private $out = true;
    function _beginning(){
        
        $this->_check_login();


    }


    function info(){
        $q['myInfo'] = model('user')->field(array(
            "uid","username",
            //"password",
            "phone",
            "ctime",
            "qq",
            "wb",
            "wx",
            "avatar",
            "referee",
            "type",
            "coin",
            "sex",
            "score",
            //"pay_password",
            "push",
            'birth',
            'coin_all'
        ))->find($this->uid);
        $where['uid'] = $this->uid;
        $q['count']['pay_1'] = model('order')->where($where)->where(array('status'=>1))->get_field();
        $q['count']['pay_2'] = model('order')->where($where)->where(array('status'=>2))->get_field();
        $q['count']['pay_3'] = model('order')->where($where)->where(array('status'=>3))->get_field();
        $q['count']['pay_4'] = model('order')->where($where)->where(array('status'=>4))->get_field();
        $where2['uid'] = $this->uid;
        $where2['read'] = 0;
        $q['count']['message'] = model('message')->where($where)->get_field();
        $q['count']['fans'] = model('fans')->where(array('uid'=>$this->uid))->get_field();
        $this->success($q);
    }
    function has_message(){
        $where['uid'] = $this->uid;
        $where['read'] = 0;
        $z = model('message')->where($where)->find();
        $q['read'] = $z?'1':'0';
        $this->success($q);
    }

    function fans_order($uid){
        $this->_check_login();
        $data['uid'] = post('uid',$uid,'%d');

        if($status)$data['status'] = array('contain',array(2,3,4),'IN');
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
    
    function add_address(){
        $data['ctime'] = TIME_NOW;
        $data['uid'] = $this->uid;
        $data['addr'] = post('addr','');
        $data['name'] = post('name','');
        $data['phone'] = post('phone','');
        $data['type'] = post('type',0);
        $data['lid'] = post('lid',0);
        if(!$data['addr'])$this->errorCode(414);
        if($data['type']){
            $where['uid'] = $this->uid;
            $data2['type'] = 0;
            model('user_address')->where($where)->data($data2)->save();
        }
        model('user_address')->data($data)->add();
        $this->success();
    }
    function change_address(){
        $data['ctime'] = TIME_NOW;
        $data['uid'] = $this->uid;
        $data['addr'] = post('addr','');
        $data['name'] = post('name','');
        $data['phone'] = post('phone','');
        $data['type'] = post('type',0);
        $data['lid'] = post('lid',0);
        $where['uid'] = $this->uid;
        $where['id'] = post('id',0);
        if(!$data['addr'])$this->errorCode(414);
        if($data['type']){
            $where2['uid'] = $this->uid;
            $data2['type'] = 0;
            model('user_address')->where($where2)->data($data2)->save();
        }
        model('user_address')->where($where)->data($data)->save();
        $this->success();
    }
    function remove_address(){
        $where['uid'] = $this->uid;
        $where['id'] = post('id',0);
        model('user_address')->where($where)->remove();
        $this->success();
    }
    function location($pid=0){
        $where['pid'] = post('pid',$pid);
        $z['list'] = model('location')->where($where)->limit(999)->select();
        $this->success($z);
    }
    function default_address($id){
        $id = post('id',$id);
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
        $l = model('location')->limit(9999)->select('id');
        foreach($z['list'] as &$v){
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
        if(!$z['list'])$this->errorCode(427);
        $this->success($z);
    }
    
    function coin(){
        $z['coin'] = $this->userInfo['coin'];
        $where['uid'] = $this->uid;
        $z['list'] = model('coin_log')->where($where)->order(array('ctime'=>'DESC'))->limit(999)->select();
        $g = model('cash_apply')->where(array('uid'=>$this->uid,'status'=>0))->find();
        $z['status'] = $g?1:0;
        $this->success($z);
    }
    function coin_custom(){//获取余额明细
        $where['uid'] = $this->uid;
        $z['list'] = model('coin_log')->where($where)->order(array('ctime'=>'DESC'))->limit(5)->select();
        if(!$z['list'])$this->errorCode(427);
        $this->success($z);

    }
    function cash(){
        $_POST['uid'] = $this->uid;
        if(model('cash_apply')->where(array('uid'=>$this->uid,'status'=>0))->find())$this->errorCode(428);
        $_POST['money'] = post('money',0,'%d');
        if($_POST['money']>$this->userInfo['coin'])$this->errorCode(429);
        model('user')->data(array('coin'=>array('add',-1*$_POST['money'])))->save($this->uid);
        model('coin_log')->data(array('uid'=>$this->uid,'coin'=>-1*$_POST['money'],'info'=>'申请提现','ctime'=>TIME_NOW))->add();
        unset($_POST['id']);
        $_POST['ctime'] = TIME_NOW;
        $z['id'] = model('cash_apply')->data($_POST)->add();
        $this->success($z);
    }
    function my_cash(){
        $data['uid'] = $this->uid;
        $z['info'] = model('cash_apply')->where($where)->order(array('ctime'=>'DESC'))->limit(999)->find();
        if(!$z['info'])$this->errorCode(427);        
        $this->success($z);
    }
    function score_shop(){
        $z['score'] = $this->userInfo['score'];
        $where['score'] = array('logic',0,'!=');
        $z['list'] = model('goods')->where($where)->order(array('ctime'=>'DESC'))->limit(999)->select();
        if(!$z['list'])$this->errorCode(427);
        $this->success($z);
    }
    function exchange_list(){
        $where['uid'] = $this->uid;
        $z['list'] = model('exchange')->where($where)->order(array('ctime'=>"DESC"))->limit(999)->select();
        if(!$z['list'])$this->errorCode(427);
        $this->success($z);
    }
    function score_custom(){
        $where['uid'] = $this->uid;
        $z['list'] = model('score_log')->where($where)->order(array('ctime'=>"DESC"))->limit(999)->select();
        if(!$z['list'])$this->errorCode(427);
        $this->success($z);
    }
    function get_message(){
        $where['uid'] = $this->uid;
        $z['list'] =model('message')->where($where)->order(array('ctime'=>'DESC'))->limit(999)->select();
        if(!$z['list'])$this->errorCode(427);
        model('message')->where($where)->data(array('read'=>1))->save();
        $this->success($z);

    }
    


    function avatar($avatar){
        if($avatar = post('avatar',$avatar)){
            model('user')->data(array('avatar'=>$avatar))->save($this->uid);
        }else{
            $this->errorCode(416);
        }
        $this->success();
    }

    function username($username){
        if($username = post('username',$username)){
            model('user')->data(array('username'=>$username))->save($this->uid);
        }else{
            $this->errorCode(416);
        }
        $this->success();
    }
    function sex($sex){
        if($sex = post('sex',$sex)){
            model('user')->data(array('sex'=>$sex))->save($this->uid);
        }else{
            $this->errorCode(416);
        }
        $this->success();
    }

    function birth($z){
        $z = post('birth',$z);
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
            $z['signed'] = '0';
        }
        else{
            $la = strtotime(date('Y-m-d',$z['time']));
            if($la<$this->yesterday){
                $z['times'] = '0';
                $z['signed'] = '0';
            }elseif($la<$this->today){
                $z['signed'] = '0';
            }else{
                $z['signed'] = '1';
            }
        }
        $f['info'] = $z;
        $f['rule'] = model('sign_rule')->limit(999)->order(array('day'))->select();
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
                if($data['times']>30)$data['times'] = 1;
            }else{
                $this->errorCode(417);
            }
        }
        $data['uid'] = $this->uid;
        $data['time'] = TIME_NOW;
        $z2 = model('sign')->data($data)->add(true);
        $rule = model('sign_rule')->limit(999)->order(array('day'))->select('day');
        $score = $rule[$data['times']]['score'];
        if($score){
            model('user')->data(array('score'=>array('add',$score)))->save($this->uid);
            model('score_log')->data(array('score'=>'+'.$score,'uid'=>$this->uid,'info'=>'签到','ctime'=>TIME_NOW))->add();
        }
        $this->success();
    }

    
    function my_collect(){
        $where['uid'] = $this->uid;
        $z['list'] = model('goods')->add_table(array(
            'collect'=>array(
                'uid','_on'=>'tid'
            )
        ))->where($where)->order(array('ctime'=>'DESC'))->limit(999)->select();
        if(!$z['list'])$this->errorCode(427);
        $this->success($z);
    }
    
    function set_pay_password(){
        $p = post('pay_password','');
        if($this->userInfo['pay_password'])$this->errorCode(436);
        if(!$p)$this->errorCode(438);
        $data['pay_password'] = $p?md5($p):'';
        model('user')->data($data)->save($this->uid);
        $this->success();
    }
    function change_pay_password(){
        $p = post('pay_password','');
        $_POST['phone'] = $this->userInfo['phone'];
        if(!$_POST['phone'])$this->errorCode(418);
        if(!$this->userInfo['pay_password'])$this->errorCode(437);
        control('tool:captcha')->_check_captcha();
        $data['pay_password'] = $p?md5($p):'';
        model('user')->data($data)->save($this->uid);
        $this->success();
    }






    function exchange($tid,$addr_id){
        $tid = post('tid',$tid);
        $addr_id = post('addr_id',$addr_id);
        $t = model('goods')->find($tid);
        if(!$t)$this->errorCode(411);
        if(!$t['score'])$this->errorCode(422);
        $data['uid'] = $this->uid;
        $data['tid'] = $tid;
        $data['addr_id'] = $addr_id;
        $data['status'] = 2;
        $data['num'] = 1;
        $data['ctime'] = TIME_NOW;
        $data['score'] = $t['score'];
        $z = model('order')->data($data)->add();
        if(!$z)$this->errorCode(421);
        $q['oid'] = $z;
        model('exchange')->data(array('uid'=>$this->uid,'ctime'=>TIME_NOW,'score'=>$t['score'],'info'=>'兑换商品'))->add();
        $this->success($q);
    }



    function my_fans($aid){
        //$where['aid'] = post('aid',$aid);
        $where['uid'] = $this->uid;
        $z['act'] = model('activity')->find($aid);

        $where2['referer'] = $this->uid;
        $where2['status'] = array('contain',array(2,3,4),'IN');
        $where2['score'] = 0;
        $z['count'] = model('order')->where($where2)->get_field();
        $z['list'] = model('fans')->add_table(array(
            'activity'=>array(
                '_on'=>'aid','title','stime'
            ),
            'user'=>array(
                'username','avatar','_mapping'=>'u','_on'=>'tuan_fans.fans_id=u.uid'
            )
        ))->where($where)->order(array('stime'=>'DESC','ctime'=>'DESC'))->limit(999)->select();
        if(!$z['list'])$this->errorCode(427);
        foreach($z['list'] as $v)$z['alist'][$v['aid']][] = $v;
        $z['alist'] = array_values($z['alist']);
        $zf = model('user')->find($this->userInfo['referee']);
        $z['referee'] = $zf?$zf['username']:'';
        $this->success($z);
    }
    function get_my_fans_reward($num){
        $num = post('num',$num,'%d');
        $data['fans_num'] = model('fans')->where(array('uid'=>$this->uid,'buy'=>1))->get_field("count(distinct fans_id)");
        if($data['fans_num']<$num)$this->errorCode(434);
        $score = model('fans_rule')->where(array('num'=>$num))->get_field('score');
        if(!$score)$this->errorCode(430);
        if(model('fans_record')->where(array('num'=>$num,'uid'=>$this->uid))->find())$this->errorCode(431);
        
        $z = model('fans_record')->data(array('num'=>$num,'uid'=>$this->uid,'ctime'=>TIME_NOW,'score'=>$score))->add();
        if(!$z)$this->errorCode(432);
        model('user')->data(array('score'=>array('add',$score)))->save($this->uid);
        $this->success();
    }
    function my_fans_reward_detail(){
        $data['fans_num'] = model('fans')->where(array('uid'=>$this->uid,'buy'=>1))->get_field("count(distinct fans_id)");
        $data['reward_gotton'] = model('fans_record')->where(array('uid'=>$this->uid))->limit(999)->select();
        $data['reward_rule'] = model('fans_rule')->limit(999)->select();
        $this->success($data);
    }

    function add_fans($uid){
        $uid = post('uid',$uid,'%d');
        if($uid==$this->uid)$this->errorCode(441);
        $data['fans_id'] = $this->uid;
        if(!model('user')->find($uid))$this->errorCode(440);
        $data['uid'] = $uid;
        $data['aid'] = $this->aid;
        if(!model('fans')->where($data)->find()){
            $data['ctime'] = TIME_NOW;
            $data['buy'] = 0; 
            model('fans')->data($data)->add();
        }
        $this->success();
    }



    function draw_list(){
        $data['list'] = model('draw_score')->limit(8)->select();
        $this->success($data);
    }
    function draw(){
        //查询余额是否充足
        if($this->userInfo['score']<100)$this->errorCode(442);
        //扣除余额
        model('user')->data(array('score'=>array('add',-100)))->save($this->uid);

        //获取奖励轮回次数
        $draw_round_id = model('cache')->get('draw_round_id');

        //获取当期轮回已经参与人数
        $count = model('draw_log')->where(array('draw_round_id'=>$draw_round_id))->get_field();

        //如果超过1000人，轮回次数+1
        if($count>=1000){
            $draw_round_id++;
            model('cache')->plus('draw_round_id');
        }

        //设定公共的参数
        $data['uid'] = $this->uid;
        $data['draw_round_id'] = $draw_round_id;
        $data['ctime'] = TIME_NOW;

        //获取奖励内容与规则
        $rawList = $list = model('draw_score')->limit(8)->select();

        //去除num为0或-1的商品
        $ec = array();
        foreach($list as $k=>$v){
            if($v['num']==-1)$ec = $v;
            if($v['num']<1)unset($list[$k]);
        }
        //抽奖兑换
        model('exchange')->data(array('uid'=>$this->uid,'ctime'=>TIME_NOW,'score'=>100,'info'=>'兑换抽奖'))->add();
        //开始抽奖
        foreach($list as $k=>$v){
            $countz = model('draw_log')->where(array('draw_round_id'=>$draw_round_id,'did'=>$v['did']))->get_field();
            if($countz>=$v['num'])continue;
            $rand = rand(1,1000-$count);
            if($rand>$v['num']-$countz)continue;
            $data['did'] = $v['did'];
            $data['score'] = $v['score'];
            model('draw_log')->data($data)->add();
            model('user')->data(array('score'=>array('add',$v['score'])))->save($this->uid);
            model('score_log')->data(array('uid'=>$this->uid,'ctime'=>TIME_NOW,'score'=>$v['score'],'info'=>'抽奖奖励'))->add();
            $this->success(array('info'=>$v));
        }
        //都没有抽中时候抽取num为-1的商品
        if($ec){
            $data['did'] = $ec['did'];
            $data['score'] = $ec['score'];
            model('draw_log')->data($data)->add();
            model('user')->data(array('score'=>array('add',$ec['score'])))->save($this->uid);
            model('score_log')->data(array('uid'=>$this->uid,'ctime'=>TIME_NOW,'score'=>$ec['score'],'info'=>'抽奖奖励'))->add();
            $this->success(array('info'=>$ec));
        }
        //没有设置num为-1的商品时候

        $this->success(array('info'=>array(
            'did'=>'0',
            'name'=>'',
            'score'=>'0',
            'thumb'=>'',
            'num'=>'0'
        )));
    }

    function draw_log(){
        $data['list'] = model('draw_log')->where(array('uid'=>$this->uid))->order(array('ctime'=>'DESC'))->limit(999)->select();
        if(!$data['list'])$this->errorCode(427);
        $this->success($data);
    }
    function draw_logs(){
        $data['list'] = model('draw_log')->limit(10)->select();
        if(!$data['list'])$this->errorCode(427);
        $this->success($data);
    }

    function colonel(){
        $t = model('colonel')->where(array('uid'=>$this->uid))->find();
        if(!$t){
            $t['name'] = '';
            $t['sex'] = '';
            $t['birth'] = '';
            $t['phone'] = '';
            $t['location'] = '';
            $t['profession'] = '';
            
        }
        unset($_POST['user_token']);
        if(!$_POST){
            $t['type'] = '-1';
            $data['info'] = $t;
            $this->success($data);
        }else{
            unset($_POST['uid']);
            $_POST['type'] = 0;
            
            $z = model('colonel')->data($_POST)->add(true);
            $this->success($z);
        }
    }
    function stationmaster(){
        $t = model('stationmaster')->where(array('uid'=>$this->uid))->find();
        if(!$t){
            $t['name'] = '';
            $t['sex'] = '';
            $t['birth'] = '';
            $t['phone'] = '';
            $t['location'] = '';
            $t['profession'] = '';
            
        }
        unset($_POST['user_token']);
        if(!$_POST){
            $t['type'] = '-1';
            $data['info'] = $t;
            $this->success($data);
        }else{
            unset($_POST['uid']);
            $_POST['type'] = 0;
            
            $z = model('stationmaster')->data($_POST)->add(true);
            $this->success($z);
        }
    }
}
?>