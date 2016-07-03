<?php
namespace plugin\app\control;
defined('IN_PLAY') || die('Access Denied');
class UserCenter extends api\ajax{
    function _beginning(){
        
    }
    function _coser($uid){
        return model('app:UserInfo')->safe_info()->add_count()->find($uid);
    }
    function _blog_list(){
        //二期
    }
    function _album($uid=0,$tid=0,$limit=1){
        $where = array();
        if($uid)$where['uid'] = $uid;
        if($tid)$where['tid'] = $tid;
        return model('Album')->where($where)->order(array('ctime'=>'DESC'))->limit($limit)->select();
    }
    
    function _video($uid=0,$tid=0,$limit=1){
        $where = array();
        if($uid)$where['uid'] = $uid;
        if($tid)$where['tid'] = $tid;
        return model('app:Video')->where($where)->order(array('ctime'=>'DESC'))->limit($limit)->select();
    }
    function _userTeam($uid=0,$team=0,$captain=null){
        $where = array();
        if(!is_null($captain))$where['captain'] = $captain;
        if($uid)$where['uid'] = $uid;
        if($tid)$where['tid'] = $tid;
        $table = array(
            'team'=>array(
                '_on'=>'tid','name','thumb'
            )
        );
        return model('app:UserTeam')->add_table($table)->where($where)->order(array('zid'))->limit(9999)->find();
    }
    function _rank($fans){
        $where['fans'] = array('logic',$fans,'>');
        return model('app:UserCount')->where($where)->get_field()+1;
    }
    function _live($uid){
        return model('user_live')->find($uid);
    }
    function index($uid=0){
        $user = $this->g->template['coser'] = $this->_coser($uid);
        if(!$user)$this->error();
        $this->g->template['rank'] = $this->_rank($user['fans']);
        $this->g->template['title'] = '个人中心';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        $this->g->template['album'] = $this->_album($uid,0,4);
        $this->g->template['video'] = $this->_video($uid,0,4);
        $this->g->template['team'] = $this->_userTeam($uid);
        $this->g->template['captainTeam'] = $this->_userTeam($uid,0,1);
        $this->g->template['live'] = $this->_live($uid);
        $this->g->template['followed'] = model('user_follow')->where(array('uid'=>$this->user->uid,'following'=>$uid))->get_field();
        T('UserCenter');
    }
    function change_cover(){
        $this->user->_safe_login();
        $cover = post('cover','');
        if(!$cover)$this->error('400','无参数');
        model('app:UserInfo')->data(array('cover'=>$cover))->save($this->user->uid);
        $this->success();
    }
    function follow($uid){
        $this->user->_safe_login();
        $uid = post('uid',$uid,'%d');
        if(!$uid)$this->error(400,'参数错误');
        if($uid==$this->user->uid)$this->error(402,'不能关注自己');
        if(!model('user_info')->find($uid))$this->error(403,'该用户不存在');
        $data['uid'] = $this->user->uid;
        $data['following'] = $uid;
        $z = model('user_follow')->where($data)->find();
        if($z)$this->error(300,'已经关注');
        $data2['uid'] = $uid;
        $data2['following'] = $this->user->uid;
        $r = model('user_follow')->where($data2)->data(array('doub'=>1))->save();
        if($r)$data['doub'] = 1;
        $data['ctime'] = TIME_NOW;
        model('user_follow')->data($data)->add();
        $this->_correntCount($uid);
        $this->_correntCount($this->user->uid);
        $this->success();
    }
    function _correntCount($uid){
        $data['fans'] = model('user_follow')->where(array('following'=>$uid))->get_field();
        $data['follow'] = model('user_follow')->where(array('uid'=>$uid))->get_field();
        model('user_count')->data($data)->save($uid);
    }
    function unfollow($uid){
        $this->user->_safe_login();
        $uid = post('uid',$uid,'%d');
        if(!$uid)$this->error(400,'参数错误');
        if($uid==$this->user->uid)$this->error(402,'不能关注自己');
        if(!model('user_info')->find($uid))$this->error(403,'该用户不存在');
        $data['uid'] = $this->user->uid;
        $data['following'] = $uid;
        $z = model('user_follow')->where($data)->find();
        if(!$z)$this->error(301,'未关注');
        $data2['uid'] = $uid;
        $data2['following'] = $this->user->uid;
        $r = model('user_follow')->where($data2)->find();
        if($r)model('user_follow')->where($data2)->data(array('doub'=>0))->save();
        model('user_follow')->where($data)->remove();
        $this->_correntCount($uid);
        $this->_correntCount($this->user->uid);
        $this->success();
    }
    function myfans(){
        $this->user->_safe_login();
        $this->g->template['title'] = '个人中心-我的粉丝';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        $list = $this->g->template['list'] = model('user_follow')->add_table(array(
            'user_info'=>array('avatar','_on'=>'uid','nickname','interest')
        ))->where(array('following'=>$this->user->uid))->limit(999)->select();
        //var_dump($list);die();
        T('user/myfans');
    }
    function myfollow(){
        $this->user->_safe_login();
        $this->g->template['title'] = '个人中心-我的关注';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        $list = $this->g->template['list'] = model('user_follow')->add_table(array(
            'user_info'=>array('avatar','_on'=>$this->g->config['prefix'].'user_follow.following=i.uid','_mapping'=>'i','nickname','interest')
        ))->where(array('uid'=>$this->user->uid))->limit(999)->select();
        //var_dump($list);die();
        T('user/myfollow');
    }
    function zhibo(){
        $this->user->_safe_login();
        $this->g->template['title'] = '个人中心-直播管理';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        $this->g->template['z'] = model('user_live')->find($this->user->uid);
        T('user/zhibo');
    }
    function change_live(){
        $this->user->_safe_login();
        $data['yy'] = post('y');
        $data['bilibili'] = post('b');
        $data['yahu'] = post('h');
        model('user_live')->data($data)->save($this->user->uid);
        $this->success();
    }
    function change_avatar(){
        $this->user->_safe_login();
        $data['avatar'] = post('avatar');
        model('user_info')->data($data)->save($this->user->uid);
        $this->success();
    }
    function change_info(){
        $this->user->_safe_login();
        $this->coser->data($_POST)->save($this->user->uid);
        $this->success();
    }
    function centerupdate(){
        $this->user->_safe_login();
        $this->g->template['title'] = '个人中心-修改我的信息';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        T('user/centerupdate');
    }
    function centerupdatepwd(){
        $this->user->_safe_login();
        $this->g->template['title'] = '个人中心-修改密码';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        T('user/centerupdatepwd');
    }
    function change_password(){
        $this->user->_safe_login();
        $c = model('user_info')->find($this->user->uid);
        $old = post('old');
        if(md5(md5($old).$c['salt'])!=$c['password'])$this->error('570','旧密码错误');
        $new = post('new');
        if(!preg_match('/^.{6,16}$/',$new))$this->error(403,'密码长度不正确');
        model('user_info')->data(array('password'=>md5(md5($new).$c['salt'])))->save($this->user->uid);
        $this->success();
    }
}




?>