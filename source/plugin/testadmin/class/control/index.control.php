<?php
namespace plugin\testadmin\control;
use plugin\adminloader\control\lib\base;
defined('IN_PLAY') || exit('Access Denied');
class index extends base{
    protected function _get_subnav(){
        return array(
            'lists'=>'案例列表',
            //'search'=>'案例搜索',
            'upnav'=>'上传案例'
        );
    }
    protected function _get_nav(){
        return array(
            'index'=>'主页',
            //'list'=>'列表'
        );
    }
    protected function _get_name(){
        return '涵予';
    }
    protected function _get_subname(){
        return '后台';
    }
    protected function _beginning(){
        
    }
    function _nomethod(){
        $first = array_keys($this->subnav);
        $first = reset($first);
        header('Location:/'.PLUGIN_NAME.'/'.CONTROL_NAME.'/'.$first);
    }
    function search(){
        $this->_init();
        T(METHOD_NAME);
    }
    function lists($type,$page){
        $this->_init();
        $limit = 10;
        $page = floor($page)>0?floor($page):1;
        $this->g->template['list'] = $list = model('anli')->add_table(array(
            'subnav'=>array('_on'=>'tid','name'=>'typename')
        ))->page($page,$limit)->order(array('ctime'=>'desc'))->select();
        $maxRow = $this->g->tempalte['maxPage'] = model('anli')->get_field();
        $maxPage = floor(($maxRow-1)/$limit)+1;
        $this->g->template['maxRow'] = $maxRow;
        $this->g->template['maxPage'] = $maxPage;
        $this->g->template['currentPage'] = $page;
        T(METHOD_NAME);
    }
    function upnav(){
        $this->subnav = array_merge($this->subnav,array('upnav'=>'选择分类'));
        $this->_init();
        $this->g->template['list'] = $list = model('subnav')->where(array('sid'=>0))->limit(9999)->select();
        var_dump($list);
        T(METHOD_NAME);
    }
    function upsubnav($sid){
        $this->subnav = array_merge($this->subnav,array('upsubnav'=>'选择子分类'));
        $this->_init();
        if(!$sid)$this->error(400,'没有找到分类');
        $this->g->template['list'] = $list = model('subnav')->where(array('sid'=>$sid))->limit(9999)->select();
        if(!$list)header('Location:/'.PLUGIN_NAME.'/'.CONTROL_NAME.'/upanli/'.$sid);
        var_dump($list);
        T(METHOD_NAME);
    }
    function upanli($sid){
        $this->subnav = array_merge($this->subnav,array('upanli'=>'完善资料'));
        $this->_init();
        
        T(METHOD_NAME);
    }

}