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
    function _user_team(){

    }
    function _my_live(){

    }
    function index($uid=0){
        $user = $this->g->template['coser'] = $this->_coser($uid);
        if(!$user)$this->error();
        $this->g->template['title'] = '个人中心';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        $this->g->template['album'] = $this->_album($uid,0,4);
        $this->g->template['video'] = $this->_video($uid,0,4);
        T('UserCenter');
    }
}




?>