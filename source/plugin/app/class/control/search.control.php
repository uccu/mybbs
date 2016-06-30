<?php
namespace plugin\app\control;
defined('IN_PLAY') || die('Access Denied');
class search extends api\ajax{
    function _beginning(){
        
    }
    
    function album($key,$page){
        //var_dump($_SERVER);die();
        $page = floor($page);
        if(!$page)$page = 1;$limit = 16;
        $where['title'] = array('contain','%'.$key.'%','LIKE');
        $this->g->template['title'] = '搜索-相册';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        $maxRow = model('album')->where($where)->get_field();
        if(!preg_match('#/app/search#',$_SERVER['HTTP_REFERER']) && !$maxRow)header('Location:/app/search/user/'.$key);
        $maxPage = floor(($maxRow-1)/$limit)+1;
        $this->g->template['maxRow'] = $maxRow;
        $this->g->template['maxPage'] = $maxPage;
        $this->g->template['currentPage'] = $page;

        $table = array(
            'user_info'=>array('_on'=>'uid','thumb','nickname','avatar'),
            'user_count'=>array('_on'=>'uid','fans')
        );
        $list = $this->g->template['list'] = model('album')->add_table($table)->where($where)->page($page,$limit)->order(array('ctime'=>'DESC'))->select();
        T('search/album');
    }
    function user($key,$page){
        $page = floor($page);
        if(!$page)$page = 1;$limit = 16;
        $where['nickname'] = array('contain','%'.$key.'%','LIKE');
        $this->g->template['title'] = '搜索-用户';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        $maxRow = $this->coser->where($where)->get_field();
        $maxPage = floor(($maxRow-1)/$limit)+1;
        $this->g->template['maxRow'] = $maxRow;
        $this->g->template['maxPage'] = $maxPage;
        $this->g->template['currentPage'] = $page;
        $list = $this->g->template['list'] = $this->coser->add_count()->where($where)->page($page,$limit)->order(array('ctime'=>'DESC'))->select();
        T('search/user');
    }
    
}




?>