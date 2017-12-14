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
            'user'=>array('_on'=>'f.fans_id=u.uid','uid'=>'fuid','_mapping'=>'u','nametrue','gid','bid','type','nickname','label','thumb'),
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
            'user'=>array('_on'=>'uid','_mapping'=>'u','uid'=>'fuid','nickname','nametrue','gid','bid','type','label','thumb'),
            '_table'=>array('_join'=>'LEFT JOIN','_on'=>'f.uid=f2.uid AND f2.fans_id='."'{$this->uid}'",'_mapping'=>'f2','fans_id'=>'follow')
        ))->where(array('fans_id'=>$uid))->limit(999)->select();
        foreach($t['follow'] as &$v)$v['follow'] = $v['follow']?'1':'0';
        $this->success($t);
    }
    function info_1($uid){
        $uid = post('uid',$uid,'%d');
        $u = $this->_check_uid($uid);
        $t['info'] = model('user')->field(array('uid','nickname','type','gid','bid','label','thumb','sex','experience','has_warning'))->find($uid);
        $t['fans'] = model('fans')->where(array('uid'=>$uid))->get_field();
        $t['follow'] = model('fans')->where(array('fans_id'=>$uid))->get_field();
        $t['followed'] = $this->_check_follow($uid);
        $t['inquiry'] = model('inquiry')->where(array('uid'=>$uid))->get_field();
        $t['answer'] = model('inquiry_list')->where(array('uid'=>$uid))->get_field();

        $t['list'] = model('inquiry')->distinct()->mapping('i')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname'),
            'inquiry_list'=>array('_on'=>'r.bid=i.id','uid'=>'ruid','_mapping'=>'r'),
            'collect'=>array('_join'=>'LEFT JOIN','_mapping'=>'c','_on'=>'i.id=c.id AND c.type=\'w\' AND c.uid='."'{$this->uid}'",'uid'=>'collected')
        ))->where(array('ruid'=>$uid))->order(array('ctime'=>'DESC'))->limit(10)->select();
        foreach($t['list'] as &$v){
            $v['collected'] = $v['collected']?'1':'0';
            $v['answer'] = model('inquiry_list')->where(array('bid'=>$v['id']))->get_field().'';
        }

        
        $this->success($t);
    }
    function info_2($uid){
        $uid = post('uid',$uid,'%d');
        $u = $this->_check_uid($uid);
        $t['info'] = model('user')->field(array('uid','nickname','type','gid','bid','label','thumb','sex','experience','describe','nametrue','has_warning'))->find($uid);
        $t['fans'] = model('fans')->where(array('uid'=>$uid))->get_field();
        $t['follow'] = model('fans')->where(array('fans_id'=>$uid))->get_field();
        $t['followed'] = $this->_check_follow($uid);
        $t['inquiry'] = model('inquiry')->where(array('uid'=>$uid))->get_field();
        $t['answer'] = model('inquiry_list')->where(array('uid'=>$uid))->get_field();

        $t['info']['content'] = $t['info']['describe'] ? $t['info']['describe'] : '';
 

        
        $this->success($t);
    }
    function info_0($uid){
        $uid = post('uid',$uid,'%d');
        $u = $this->_check_uid($uid);
        $t['info'] = model('user')->field(array('uid','nickname','type','gid','bid','label','thumb','sex','experience','has_warning'))->find($uid);
        $t['fans'] = model('fans')->where(array('uid'=>$uid))->get_field();
        $t['follow'] = model('fans')->where(array('fans_id'=>$uid))->get_field();
        $t['followed'] = $this->_check_follow($uid);
        $t['inquiry'] = model('inquiry')->where(array('uid'=>$uid))->get_field();
        $t['answer'] = model('inquiry_list')->where(array('uid'=>$uid))->get_field();

        $t['list'] = model('inquiry')->mapping('i')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname'),
            'collect'=>array('_join'=>'LEFT JOIN','_mapping'=>'c','_on'=>'i.id=c.id AND c.type=\'w\' AND c.uid='.$this->uid,'uid'=>'collected')
        ))->where(array('uid'=>$uid))->order(array('ctime'=>'DESC'))->limit(10)->select();
        foreach($t['list'] as &$v){
            $v['collected'] = $v['collected']?'1':'0';
            $v['answer'] = model('inquiry_list')->where(array('bid'=>$v['id']))->get_field().'';
        }

        
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
        foreach($t['list'] as &$v){
            $v['collected'] = $v['collected']?'1':'0';
            $v['answer'] = model('inquiry_list')->where(array('bid'=>$v['id']))->get_field().'';
        }

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
        foreach($t['list'] as &$v){
            $v['collected'] = $v['collected']?'1':'0';
            $v['answer'] = model('inquiry_list')->where(array('bid'=>$v['id']))->get_field().'';
        }
        $this->success($t);

    }

    function collect($uid){
        $this->_check_phone();
        $uid = post('uid',$uid,'%d');
        $data['fans_id'] = $this->uid;
        $user = model('user')->find($uid);
        if(!$user)$this->errorCode(414);
        $data['uid'] = $uid;
        if($this->uid == $uid)$this->errorCode(425);
        $f = model('fans')->where($data)->find();
        if($f){
            if($user['fans'])model('user')->data(array('fans'=>array('add',-1)))->save($uid);
            if($userInfo['follow'])model('user')->data(array('follow'=>array('add',-1)))->save($this->uid);
            model('fans')->where($data)->remove();
            $z['followed'] = '0';
        }else{
            model('user')->data(array('fans'=>array('add',1)))->save($uid);
            model('user')->data(array('follow'=>array('add',1)))->save($this->uid);
            model('fans')->data($data)->add();
            $z['followed'] = '1';
        }
        $this->success($z);
    }


    function get_cloud_token($uid = 0){
        $this->_check_phone();
        $uid = post('uid',$uid,'%d');
        if(!$uid)$this->errorCode(416);
        $data['info'] = model('user')->field(array('gid','uid','nametrue','type','nickname','label','thumb','is_free'))->find($uid);
        if(!$data['info'])$this->errorCode(440);

        if($this->userInfo['qust']>0 && !$data['info']['is_free'])model('user')->data(array('qust'=>array('add',-1)))->save($this->uid);

        $data['qust'] = $this->userInfo['qust'];

        if($data['info']['is_free']){
            
            $data['paid'] = '1';
            $this->success($data);
        }
        $pay = model('expert_paid')->where(array('uid'=>$this->uid,'id'=>$uid))->order(array('ctime'=>'DESC'))->find();

        $data['paid'] = $pay && $pay['ctime']>TIME_NOW-24*3600 ? '1' : '0';

        // $o = $this->_getCloudToken($uid);

        // if(!$data)$this->errorCode(429);
        // if(!$data)$this->error(429,$o);
        //$data['uuid'] = $o['entities'][0]['uuid']?$o['entities'][0]['uuid']:'';

        $this->success($data);
    }

}
?>