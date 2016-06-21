<?php
namespace plugin\app\control;
defined('IN_PLAY') || die('Access Denied');
class Character extends api\ajax{
    function _beginning(){
        
    }
    function _chars($page,$order){
        $key = $order?'cid':'fans';
        return model('character')->page($page,12)->order(array($key=>'DESC'))->select();
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
}




?>