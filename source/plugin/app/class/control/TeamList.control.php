<?php
namespace plugin\app\control;
defined('IN_PLAY') || die('Access Denied');
class TeamList extends api\ajax{
    function _beginning(){
        
    }
    function _teams($page,$order){
        $order = $order?'fans':'tid';
        return model('team')->order(array('fans'=>'DESC'))->page($page,8)->order(array($order=>'DESC'))->select();
    }
    function _count(){
        return model('team')->get_field();
    }
    
    function index($page,$order){
        $page = floor($page);
        if(!$page)$page = 1;
        $this->g->template['title'] = '团队列表';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        $this->g->template['list'] = $this->_teams($page,$order);
        $maxRow = $this->_count();
        $limit = 8;
        $maxPage = floor(($maxRow-1)/$limit)+1;
        $this->g->template['maxRow'] = $maxRow;
        $this->g->template['maxPage'] = $maxPage;
        $this->g->template['currentPage'] = $page;
        T();
    }
    
    function _nomethod(){
        header('Location:/app/teamlist/index');
    }
}




?>