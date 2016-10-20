<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class user extends base\e{
    function _beginning(){
        $this->_check_login();
    }
    function fans($uid){
        $uid = post('uid',$uid,'%d');
        $user = $this->_check_uid($uid);
        model('fans')->mapping('f');
        $t['fans'] = model('fans')->add_table(array(
            'user'=>array('_on'=>'f.fans_id=u.uid','uid'=>'fuid','_mapping'=>'u','type','nickname','label','thumb'),
            '_table'=>array('_join'=>'LEFT JOIN','_on'=>'f.fans_id=f2.uid AND f2.fans_id='."'{$this->uid}'",'_mapping'=>'f2','fans_id'=>'follow')
        ))->where(array('uid'=>$uid))->limit(999)->select();
        foreach($t['fans'] as &$v)$v['follow'] = $v['follow']?'1':'0';
        $this->success($t);
    }
    function follow($uid){
        $uid = post('uid',$uid,'%d');
        $user = $this->_check_uid($uid);
        model('fans')->mapping('f');
        $t['follow'] = model('fans')->add_table(array(
            'user'=>array('_on'=>'uid','_mapping'=>'u','uid'=>'fuid','nickname','type','label','thumb'),
            '_table'=>array('_join'=>'LEFT JOIN','_on'=>'f.uid=f2.uid AND f2.fans_id='."'{$this->uid}'",'_mapping'=>'f2','fans_id'=>'follow')
        ))->where(array('fans_id'=>$uid))->limit(999)->select();
        foreach($t['follow'] as &$v)$v['follow'] = $v['follow']?'1':'0';
        $this->success($t);
    }
    function info_1($uid){
        $uid = post('uid',$uid,'%d');
        $u = $this->_check_uid($uid);
        $t['info'] = model('user')->field(array('uid','nickname','type','label','thumb','sex','experience'))->find($uid);
        $t['fans'] = model('fans')->where(array('uid'=>$uid))->get_field();
        $t['follow'] = model('fans')->where(array('follow'=>$uid))->get_field();
        $t['followed'] = $this->_check_follow($uid);
        $t['inquiry'] = model('inquiry')->where(array('uid'=>$uid))->get_field();
        $t['answer'] = model('inquiry_list')->where(array('uid'=>$uid))->get_field();

        $t['list'] = model('inquiry')->distinct()->mapping('i')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname'),
            'inquiry_list'=>array('_on'=>'r.bid=i.id','uid'=>'ruid','_mapping'=>'r'),
            'collect'=>array('_join'=>'LEFT JOIN','_mapping'=>'c','_on'=>'i.id=c.id AND c.type=\'w\' AND c.uid='."'{$this->uid}'",'uid'=>'collected')
        ))->where(array('ruid'=>$uid))->order(array('ctime'=>'DESC'))->limit(10)->select();
        foreach($t['list'] as &$v)$v['collected'] = $v['collected']?'1':'0';

        
        $this->success($t);
    }
    function info_0($uid){
        $uid = post('uid',$uid,'%d');
        $u = $this->_check_uid($uid);
        $t['info'] = model('user')->field(array('uid','nickname','type','label','thumb','sex','experience'))->find($uid);
        $t['fans'] = model('fans')->where(array('uid'=>$uid))->get_field();
        $t['follow'] = model('fans')->where(array('follow'=>$uid))->get_field();
        $t['followed'] = $this->_check_follow($uid);
        $t['inquiry'] = model('inquiry')->where(array('uid'=>$uid))->get_field();
        $t['answer'] = model('inquiry_list')->where(array('uid'=>$uid))->get_field();

        $t['list'] = model('inquiry')->mapping('i')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname'),
            'collect'=>array('_join'=>'LEFT JOIN','_mapping'=>'c','_on'=>'i.id=c.id AND c.type=\'w\' AND c.uid='.$this->uid,'uid'=>'collected')
        ))->where(array('uid'=>$uid))->order(array('ctime'=>'DESC'))->limit(10)->select();
        foreach($t['list'] as &$v)$v['collected'] = $v['collected']?'1':'0';

        
        $this->success($t);
    }
    function answer($uid){
        $uid = post('uid',$uid,'%d');
        $u = $this->_check_uid($uid);
        $page = post('page',1);
        $limit = post('limit',10);

        $t['list'] = model('inquiry')->distinct()->mapping('i')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname'),
            'inquiry_list'=>array('_on'=>'r.bid=i.id','uid'=>'ruid','_mapping'=>'r'),
            'collect'=>array('_join'=>'LEFT JOIN','_mapping'=>'c','_on'=>'i.id=c.id AND c.type=\'w\' AND c.uid='."'{$this->uid}'",'uid'=>'collected')
        ))->where(array('ruid'=>$uid))->order(array('ctime'=>'DESC'))->page($page,$limit)->select();
        foreach($t['list'] as &$v)$v['collected'] = $v['collected']?'1':'0';

        $this->success($t);
    }
    function publish(){
        $uid = post('uid',$uid,'%d');
        $u = $this->_check_uid($uid);
        $page = post('page',1);
        $limit = post('limit',10);
        $t['list'] = model('inquiry')->mapping('i')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname'),
            'collect'=>array('_join'=>'LEFT JOIN','_mapping'=>'c','_on'=>'i.id=c.id AND c.type=\'w\' AND c.uid='.$this->uid,'uid'=>'collected')
        ))->where(array('uid'=>$uid))->order(array('ctime'=>'DESC'))->page($page,$limit)->select();
        foreach($t['list'] as &$v)$v['collected'] = $v['collected']?'1':'0';
        $this->success($t);

    }

    function collect($uid){
        $this->_check_login();
        $uid = post('uid',$uid,'%d');
        $data['fans_id'] = $this->uid;
        $user = model('user')->find($uid);
        if(!$user)$this->errorCode(414);
        $data['uid'] = $uid;

        $f = model('fans')->where($data)->find();
        if($f){
            model('fans')->where($data)->remove();
            $z['followed'] = '0';
        }else{
            model('fans')->data($data)->add();
            $z['followed'] = '1';
        }
        $this->success($z);
    }

}
?>