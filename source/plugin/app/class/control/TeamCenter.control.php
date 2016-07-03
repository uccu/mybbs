<?php
namespace plugin\app\control;
defined('IN_PLAY') || die('Access Denied');
class TeamCenter extends api\ajax{
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
        return model('app:UserTeam')->add_table($table)->where($where)->order(array('zid'))->limit(9999)->select();
    }
    function _rank($fans){
        $where['fans'] = array('logic',$fans,'>');
        return model('app:UserCount')->where($where)->get_field()+1;
    }
    function _live($uid){
        return model('user_live')->find($uid);
    }
    function _activity($tid,$limit=1){
        return model('activity')->where(array('tid'=>$tid))->limit($limit)->order(array('ctime'=>'DESC'))->select();
    }
    function index($tid=0){

        $team = $this->g->template['team'] = model('team')->find($tid);
        if(!$team)header('Location:/404.html');
        $rank = $this->g->template['rank'] = model('team')->where(array('fans'=>array('logic',$team['fans'],'>')))->get_field()+1;
        $this->g->template['album'] = $this->_album(0,$tid,4);
        $this->g->template['video'] = $this->_video(0,$tid,4);
        $this->g->template['activity'] = $this->_activity($tid,4);
        $captain = $this->g->template['captain'] = model('app:UserTeam')->add_table(array('user_info'=>array('_on'=>'uid','avatar','nickname')))->where(array('tid'=>$tid,'captain'=>1))->find();
        $this->g->template['member'] = model('app:UserTeam')->where(array('tid'=>$tid,'captain'=>0))->limit(999)->select();
        $this->g->template['title'] = $team['name'];
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = $team['description'];
        $this->g->template['followed'] = model('team_follow')->where(array('tid'=>$tid,'uid'=>$this->user->uid))->get_field();
        T('TeamCenter');
    }
}




?>