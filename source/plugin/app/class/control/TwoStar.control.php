<?php
namespace plugin\app\control;
defined('IN_PLAY') || die('Access Denied');
class TwoStar extends api\ajax{
    function _beginning(){
        
    }
    function _cosers(){
        return model('app:UserInfo')->safe_info()->add_count()->order('(c.fans+c.extend) desc')->limit(8)->select();
    }
    
    function _teams(){
        return model('team')->order(array('fans'=>'DESC'))->limit(4)->select();
    }
    
    function _nomethod(){
        $this->g->template['title'] = '二次元明星';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        $this->g->template['cosers'] = $this->_cosers();
        $this->g->template['team'] = $this->_teams();
        T();
    }
}




?>