<?php
namespace plugin\app\control;
defined('IN_PLAY') || die('Access Denied');
class Index extends api\ajax{
    function _beginning(){
        
    }
    function _banner(){

    }
    function _character(){
        //4个
    }
    function _star(){
        //4个
    }
    function _video(){
       $where['uid'] = array('logic',0,'>');
        return model('app:Video')->where($where)->order(array('ctime'=>'DESC'))->limit(4)->select();
    }
    function _contestVideo(){
        $where['uid'] = 0;
        return model('app:Video')->where($where)->order(array('ctime'=>'DESC'))->limit(4)->select();
    }
    function _cosers(){
        return model('app:UserInfo')->safe_info()->add_count()->order(array('fans'=>'DESC'))->limit(7)->select();
    }
    function _teams(){
        return model('team')->order(array('fans'=>'DESC'))->limit(7)->select();
    }
    function _contest(){
        //4个
    }
    function _nomethod(){
        $this->g->template['banner'] = $this->_banner();
        $this->g->template['title'] = '首页';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        $this->g->template['character'] = $this->_character();
        $this->g->template['star'] = $this->_star();
        $this->g->template['video'] = $this->_video();
        $this->g->template['contestVideo'] = $this->_contestVideo();
        $this->g->template['cosers'] = $this->_cosers();
        $this->g->template['team'] = $this->_teams();
        $this->g->template['contest'] = $this->_contest();
        T();
    }
}




?>