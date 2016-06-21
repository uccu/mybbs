<?php
namespace plugin\app\control;
defined('IN_PLAY') || die('Access Denied');
class Coser extends api\ajax{
    function _beginning(){
        
    }
    function _cosers($page,$order){
        $key = $order?'uid':'fans';
        return model('app:UserInfo')->safe_info()->add_count()->order(array($key=>'DESC'))->page($page,16)->select();
    }
    function _cosersCount(){
        return model('app:UserInfo')->get_field();
    }
    
    
    function index($page=1,$order=0){
        $page = floor($page)?floor($page):1;
        $this->g->template['title'] = '明星列表';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        $this->g->template['cosers'] = $this->_cosers($page,$order);
        $c = $this->g->template['cosersCount'] = $this->_cosersCount();
        $maxPage = $this->g->template['maxPage'] =floor(($c-1)/16)+1;
        $this->g->template['thisPage'] = $page;
        T();
    }
}




?>