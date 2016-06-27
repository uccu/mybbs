<?php
namespace plugin\app\control;
defined('IN_PLAY') || die('Access Denied');
class Character extends api\ajax{
    function _beginning(){
        
    }
    function _chars($page,$order){
        $key = $order?'fans':'cid';
        $table = array(
            'provenance'=>array(
                '_on'=>'pid','name'=>'pname'
            )
        );
        return model('character')->add_table($table)->page($page,12)->order(array($key=>'DESC'))->select();
    }
    function _count(){
        return model('character')->get_field();
    }
    
    function ajax($page=2,$order=0){
        $page = post('page',$page);
        $order = post('order',$order);
        $page = floor($page)?floor($page):2;
        $t = $this->_chars($page,$order);
        $this->success($t);
    }
    function index($page=1,$order=0){
        $page = floor($page)?floor($page):1;
        $this->g->template['title'] = 'COS角色';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        $this->g->template['characters'] = $this->_chars($page,$order);
        T();
    }

    function lists($page,$order){
        $page = floor($page);
        if(!$page)$page = 1;
        $this->g->template['title'] = 'COS角色';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        $this->g->template['list'] = $this->_chars($page,$order);
        $maxRow = $this->_count();
        $limit = 12;
        $maxPage = floor(($maxRow-1)/$limit)+1;
        $this->g->template['maxRow'] = $maxRow;
        $this->g->template['maxPage'] = $maxPage;
        $this->g->template['currentPage'] = $page;
        T('character/lists');
    }
    function _nomethod(){
        header('Location:/app/character/lists');
    }
}




?>