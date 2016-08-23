<?php
namespace plugin\testadmin\control;
use plugin\adminloader\control\lib\base;
defined('IN_PLAY') || exit('Access Denied');
class index extends base{
    protected function _get_subnav(){
        return array(
            'selnav'=>'案例分类',
            'lists'=>'案例列表',
            //'search'=>'案例搜索',
            //'upnav'=>'上传案例'
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
    function nav(){

    }
    function lists($tid,$page,$aid){
        $this->_init();
        $limit = 10;
        $where = array();
        if($tid)$where['tid'] = $tid;
        $page = floor($page)>0?floor($page):1;
        $subnav = model('subnav')->limit(9999)->select('tid');
        $list = model('anli')->add_table(array(
            'subnav'=>array('_on'=>'tid','name'=>'typename','_mapping'=>'s1'),
        ))->where($where)->page($page,$limit)->order(array('pos','ctime'=>'desc'))->select();
        foreach($list as &$v){
            if($subnav[$v['tid']]['sid']){
                $v['typename'] = $subnav[$subnav[$v['tid']]['sid']]['name'].'-'.$v['typename'];
            }
            $v['date'] = date('m-d H:i',$v['ctime']);
        }
        $this->g->template['list'] = $list;
        $maxRow = $this->g->tempalte['maxPage'] = model('anli')->where($where)->get_field();
        $maxPage = floor(($maxRow-1)/$limit)+1;
        $this->g->template['maxRow'] = $maxRow;
        $this->g->template['maxPage'] = $maxPage;
        $this->g->template['currentPage'] = $page;
        $this->g->template['tid'] = $tid?$tid:0;
        T(METHOD_NAME);
    }
    function selnav($sid){
        if($sid){
            $this->_init();
            if(!$sid)$this->error(400,'没有找到分类');
            $this->g->template['list'] = $list = model('subnav')->where(array('sid'=>$sid))->limit(9999)->order(array('pos','tid'=>'DESC'))->select();
            if(!$list)header('Location:/'.PLUGIN_NAME.'/'.CONTROL_NAME.'/lists/'.$sid);
            $this->g->template['sid'] = $sid;
            T(METHOD_NAME);
        }else{
            $this->_init();
            $this->g->template['sid'] = 0;
            $this->g->template['list'] = $list = model('subnav')->where(array('sid'=>0))->limit(9999)->select();
            //var_dump($list);
            T(METHOD_NAME);
        }
        
    }
    function upnav(){
        $this->subnav = array_merge($this->subnav,array('upnav'=>'选择分类'));
        $this->_init();
        $this->g->template['list'] = $list = model('subnav')->where(array('sid'=>0))->limit(9999)->select();
        //var_dump($list);
        T(METHOD_NAME);
    }
    function upsubnav($sid){
        $this->subnav = array_merge($this->subnav,array('upsubnav'=>'选择子分类'));
        $this->_init();
        if(!$sid)header('Location:/'.PLUGIN_NAME.'/'.CONTROL_NAME.'/upnav');
        $this->g->template['list'] = $list = model('subnav')->where(array('sid'=>$sid))->limit(9999)->select();
        if(!$list)header('Location:/'.PLUGIN_NAME.'/'.CONTROL_NAME.'/upanli/'.$sid);
        //var_dump($list);
        T(METHOD_NAME);
    }
    function upanli($tid){
        if(!$tid)header('Location:/'.PLUGIN_NAME.'/'.CONTROL_NAME.'/'.$first);
        $this->subnav = array_merge($this->subnav,array('upanli'=>'完善资料'));
        $this->_init();
        $this->g->template['id'] = 0;
        $this->g->template['tid'] = $tid;
        T(METHOD_NAME);
    }
    function updanli($id){
        $this->subnav = array_merge($this->subnav,array('updanli'=>'修改案例资料'));
        $this->_init();
        if(!model('anli')->find($id))header('Location:/'.PLUGIN_NAME.'/'.CONTROL_NAME.'/'.$first);
        $this->g->template['id'] = $id;
        T('upanli');
    }
    function updanli_pc($id){
        $this->subnav = array_merge($this->subnav,array('updanli_pc'=>'PC模板资料'));
        $this->_init();
        if(!model('anli')->find($id))header('Location:/'.PLUGIN_NAME.'/'.CONTROL_NAME.'/'.$first);
        $this->g->template['id'] = $id;
        T(METHOD_NAME);
    }
    function updanli_app($id){
        $this->subnav = array_merge($this->subnav,array('updanli_app'=>'APP模板资料'));
        $this->_init();
        if(!model('anli')->find($id))header('Location:/'.PLUGIN_NAME.'/'.CONTROL_NAME.'/'.$first);
        $this->g->template['id'] = $id;
        T(METHOD_NAME);
    }
    function updanli_wx($id){
        $this->subnav = array_merge($this->subnav,array('updanli_wx'=>'微信模板资料'));
        $this->_init();
        if(!model('anli')->find($id))header('Location:/'.PLUGIN_NAME.'/'.CONTROL_NAME.'/'.$first);
        $this->g->template['id'] = $id;
        T(METHOD_NAME);
    }
    function piclists($aid,$page){
        $this->subnav = array_merge($this->subnav,array('piclists'=>'案例图片'));
        $this->subnav = array_merge($this->subnav,array('uppic/'.$aid=>'上传图片'));
        $this->_init();
        $limit = 10;
        $page = floor($page)>0?floor($page):1;

        $where = array('aid'=>$aid);
        $this->g->template['list'] = $list = model('anli_pic')->where($where)->page($page,$limit)->order(array('priority'=>'DESC','pid'))->select();
        $maxRow = $this->g->tempalte['maxPage'] = model('anli_pic')->where($where)->get_field();
        $maxPage = floor(($maxRow-1)/$limit)+1;
        $this->g->template['maxRow'] = $maxRow;
        $this->g->template['maxPage'] = $maxPage;
        $this->g->template['currentPage'] = $page;
        T(METHOD_NAME);
    }
    function uppic($aid){
        $this->subnav = array_merge($this->subnav,array('piclists/'.$aid=>'案例图片'));
        $this->subnav = array_merge($this->subnav,array('uppic'=>'上传图片'));
        $this->_init();
        if(!model('anli')->find($aid))header('Location:/'.PLUGIN_NAME.'/'.CONTROL_NAME.'/'.$first);
        $this->g->template['aid'] = $aid;
        T(METHOD_NAME);
    }
    function updpic($pid){
        if(!$p = model('anli_pic')->find($pid))header('Location:/'.PLUGIN_NAME.'/'.CONTROL_NAME.'/'.$first);
        $aid = $p['aid'];
        $this->subnav = array_merge($this->subnav,array('piclists/'.$aid=>'案例图片'));
        $this->subnav = array_merge($this->subnav,array('uppic/'.$aid=>'上传图片'));
        $this->subnav = array_merge($this->subnav,array('updpic'=>'修改图片'));
        $this->_init();
        $this->g->template['id'] = $pid;
        T('uppic');
    }
    function up_navs($sid){
        $this->_init();
        $this->g->template['sid'] = $sid;
        T('up_navc');
    }
    function up_navt($tid){
        $this->_init();
        if(!$n = model('subnav')->find($tid))header('Location:/'.PLUGIN_NAME.'/'.CONTROL_NAME.'/'.$first);
        $this->g->template['id'] = $tid;
        T('up_navc');
    }
}