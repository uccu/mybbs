<?php
namespace plugin\app\control;
defined('IN_PLAY') || die('Access Denied');
class UserCenter extends \control{
    function _beginning(){
        
    }
    function _coser($uid){
        return model('UserInfo')->safe_info()->add_count()->find($uid);
    }
    function _blog_list(){

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
        return model('Video')->where($where)->order(array('ctime'=>'DESC'))->limit($limit)->select();
    }
    function _userTeam($uid=0,$team=0,$captain=null){
        $where = array();
        if(!is_null($captain))$where['captain'] = $captain;
        if($uid)$where['uid'] = $uid;
        if($tid)$where['tid'] = $tid;
        return model('UserTeam')->where($where)->order(array('zid'))->limit(9999)->select();
    }
    function _rank(){
        $where['fans'] = array('logic',$fans,'>');
        return model('UserCount')->where($where)->get_field()+1;
    }
    function _my_live(){

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
        T('UserCenter');
    }
}




?>