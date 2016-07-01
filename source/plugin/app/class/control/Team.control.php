<?php
namespace plugin\app\control;
defined('IN_PLAY') || die('Access Denied');
class Team extends api\ajax{
    function _beginning(){
        
    }
    function _teams($page,$order){
        $key = $order?'tid':'fans';
        return model('team')->order(array('fans'=>'DESC'))->page($page,8)->order(array($key=>'DESC'))->select();
    }
    function _teamsCount(){
        return model('team')->get_field();
    }
    function index($page=1,$order=0){
        if($order)
        $page = floor($page)?floor($page):1;
        $this->g->template['title'] = '团队列表';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        $this->g->template['teams'] = $this->_teams($page,$order);
        $c = $this->g->template['teamsCount'] = $this->_teamsCount();
        $maxPage = $this->g->template['maxPage'] =floor(($c-1)/16)+1;
        $this->g->template['thisPage'] = $page;
        T();

    }
    function change_avatar(){
        $this->user->_safe_login();
        $team = model('user_team')->where(array('captain'=>1,'uid'=>$this->user->uid))->find();
        if(!$team)$this->error(400,'没有担任组长职位的团队');
        $data['thumb'] = post('avatar');
        model('team')->data($data)->save($team['tid']);
        $this->success();
    }
    function change_pic(){
        $this->user->_safe_login();
        $team = model('user_team')->where(array('captain'=>1,'uid'=>$this->user->uid))->find();
        if(!$team)$this->error(400,'没有担任组长职位的团队');
        $data['pic'] = post('pic');
        model('team')->data($data)->save($team['tid']);
        $this->success();
    }
    function change_info(){
        $this->user->_safe_login();
        $team = model('user_team')->where(array('captain'=>1,'uid'=>$this->user->uid))->find();
        if(!$team)$this->error(400,'没有担任组长职位的团队');
        $data['name'] = post('name',$team['name']);
        $data['desc'] = post('desc',$team['desc']);
        model('team')->data($data)->save($team['tid']);
        $this->success();
    }
    function del_member(){
        $this->user->_safe_login();
        $team = model('user_team')->where(array('captain'=>1,'uid'=>$this->user->uid))->find();
        if(!$team)$this->error(400,'没有担任组长职位的团队');
        $data['uid'] = post('uid',0);
        $data['tid'] = $team['tid'];
        $data['captain'] = 0;
        $s = model('user_team')->where($data)->remove();
        $this->success($s);
    }
    function mybasis(){
        $this->user->_safe_login();
        $team = model('user_team')->where(array('captain'=>1,'uid'=>$this->user->uid))->find();
        if(!$team)$this->error(400,'没有担任组长职位的团队');
        $this->g->template['team'] = model('team')->find($team['tid']);
        $this->g->template['cosers'] = $cosers = model('user_team')->add_table(array(
            'user_info'=>array('_on'=>'uid','nickname','avatar')
        ))->where(array('captain'=>0,'tid'=>$team['tid']))->limit(999)->select();
        $this->g->template['title'] = '我管理的团队-基本信息';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        T('team/mybasis');

    }
    function myphoto(){
        $this->user->_safe_login();
        $team = model('user_team')->where(array('captain'=>1,'uid'=>$this->user->uid))->find();
        if(!$team)$this->error(400,'没有担任组长职位的团队');
        $this->g->template['team'] = model('team')->find($team['tid']);
        $where['tid'] = $team['tid'];
        $this->g->template['list'] = model('album')->where($where)->limit(9999)->select();
        $this->g->template['thisuid'] = -1;
        $this->g->template['title'] = '我管理的团队-相册';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        T('team/myphoto');
    }
    function myvideo(){
        $this->user->_safe_login();
        $team = model('user_team')->where(array('captain'=>1,'uid'=>$this->user->uid))->find();
        if(!$team)$this->error(400,'没有担任组长职位的团队');
        $where['tid'] = $team['tid'];
        $this->g->template['list'] = model('video')->where($where)->limit(9999)->select();
        $this->g->template['thisuid'] = -1;
        $this->g->template['title'] = '我管理的团队-视频';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        T('team/myvideo');
    }
    function myactivity(){
        $this->user->_safe_login();
        $team = model('user_team')->where(array('captain'=>1,'uid'=>$this->user->uid))->find();
        if(!$team)$this->error(400,'没有担任组长职位的团队');
        $this->g->template['team'] = model('team')->find($team['tid']);
        $where['tid'] = $team['tid'];
        $this->g->template['list'] = model('activity')->where($where)->limit(999)->order(array('ctime'=>'DESC'))->select();
        $this->g->template['thisuid'] = -1;
        $this->g->template['title'] = '我管理的团队-活动';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        T('team/myactivity');
    }
    function myrole(){
        $this->user->_safe_login();
        $team = model('user_team')->where(array('captain'=>1,'uid'=>$this->user->uid))->find();
        if(!$team)$this->error(400,'没有担任组长职位的团队');
        $this->g->template['team'] = model('team')->find($team['tid']);
        $where['tid'] = $team['tid'];

        $cosers = model('user_team')->field(array('uid'))->where($where)->limit(999)->select();
        foreach($cosers as &$v){
            $v = $v['uid'];
        }
        $where = array();
        $where['uid'] = array('contain',$cosers,'IN');
        $cids = model('picture')->field('DISTINCT `cid`')->where($where)->limit(999)->select();
        foreach($cids as &$v){
            $v = $v['cid'];
        }
        $where = array();
        $where['cid'] = array('contain',$cids,'IN');
        $table = array(
            'provenance'=>array(
                '_on'=>'pid','name'=>'pname'
            )
        );
        $this->g->template['list'] = $chars = model('character')->add_table($table)->where($where)->limit(999)->select();
        $this->g->template['thisuid'] = -1;
        $this->g->template['title'] = '我管理的团队-角色';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        T('team/myrole');
    }
    function fabuhuodong(){
        $this->user->_safe_login();
        $team = model('user_team')->where(array('captain'=>1,'uid'=>$this->user->uid))->find();
        if(!$team)$this->error(400,'没有担任组长职位的团队');
        $this->g->template['team'] = model('team')->find($team['tid']);
        $this->g->template['title'] = '我管理的团队-发布活动';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        T('team/fabuhuodong');
    }
    function new_activity(){
        $this->user->_safe_login();
        $data['content'] = post('content','');
        $data['title'] = post('title','');
        if(!$data['title'] || !$data['content'])$this->error(401,'参数不正确');
        $team = model('user_team')->where(array('captain'=>1,'uid'=>$this->user->uid))->find();
        if(!$team)$this->error(400,'没有担任组长职位的团队');
        $data['tid'] = $team['tid'];
        $img = control('tool:upload','picture')->_get_srcs();
        if($img)$data['pic'] = $img['e'];
        else $data['pic'] = 'no_activity_pic';
        $data['ctime'] = TIME_NOW;
        $z = model('activity')->data($data)->add();
        $this->success($z);
    }
    function myapply(){
        $this->user->_safe_login();
        $team = model('user_team')->where(array('captain'=>1,'uid'=>$this->user->uid))->find();
        if(!$team)$this->error(400,'没有担任组长职位的团队');
        $this->g->template['team'] = model('team')->find($team['tid']);
        $this->g->template['list'] = model('request')->add_table(array(
            'user_info'=>array('avatar','nickname','_on'=>'uid')
        ))->where(array('tid'=>$team['tid']))->order(array('ctime'=>'DESC'))->limit(99)->select();
        $this->g->template['title'] = '我管理的团队-申请通知';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        T('team/myapply');
    }
    function accept(){
        $this->user->_safe_login();
        $team = model('user_team')->where(array('captain'=>1,'uid'=>$this->user->uid))->find();
        if(!$team)$this->error(400,'没有担任组长职位的团队');
        $uid = post('uid');
        $acc = post('accept');
        if(!$uid || !$acc)$this->error(401,'参数不正确');
        $data['tid'] = $team['tid'];
        $data['uid'] = $uid;
        model('request')->where($data)->remove();
        if($acc==1){
            $t = model('user_team');
            if($t->where($data)->find())$this->error(404,'该用户已经加入一个团队');
            else $t->data($data)->add();
        }
        $this->success();
        
    }
    function accept_all(){
        $this->user->_safe_login();
        $team = model('user_team')->where(array('captain'=>1,'uid'=>$this->user->uid))->find();
        if(!$team)$this->error(400,'没有担任组长职位的团队');
        $data['tid'] = $team['tid'];
        $cosers = model('request')->where($data)->limit(999)->select();
        model('request')->where($data)->remove();
        $t = model('user_team');
        foreach($cosers as $cos){
            $data['uid'] = $cos['uid'];
            if(!$t->where($data)->find())$t->data($data)->add();
        }
        $this->success();

    }
    function apply($tid){
        $this->user->_safe_login();
        if($this->user->tid)$this->error('300','已加入团队！');
        $data['uid'] = $this->user->uid;
        $data['tid'] = $tid;
        $data['ctime'] = TIME_NOW;
        if(!model('team')->find($tid))$this->error(400,'没有该团队！');
        model('request')->data($data)->add(true);
        $this->success();
    }
    
}




?>