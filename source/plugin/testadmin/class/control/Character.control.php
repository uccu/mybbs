<?php
namespace plugin\testadmin\control;
defined('IN_PLAY') || exit('Access Denied');
class Character extends na\ba{
    function _get_subnav(){
        return array(
            'provs'=>'出处列表',
            'chars'=>'角色列表',
            
        );
    }

    protected function _beginning(){
        
    }
    function _get_defaultMethod(){
        return 'provs';
    }
    function provs($page=1,$type=0){
        $page = floor($page)?floor($page):1;
        $this->_init();
        $where = array();$limit=10;
        if($type)$where['type'] = $type;
        $maxRow = $this->g->tempalte['maxPage'] = model('provenance')->where($where)->get_field();
        $maxPage = floor(($maxRow-1)/$limit)+1;
        $this->g->template['maxRow'] = $maxRow;
        $this->g->template['maxPage'] = $maxPage;
        $this->g->template['currentPage'] = $page;
        $this->g->template['list'] = model('provenance')->where($where)->page($page,$limit)->order(array('pid'=>'DESC'))->select();
        T(CONTROL_NAME.'/'.__FUNCTION__);   
    }
    function chars($page=1,$pid=0){
        $page = floor($page)?floor($page):1;
        $this->_init();
        $where = array();$limit=10;
        if($pid)$where['pid'] = $pid;
        $maxRow = $this->g->tempalte['maxPage'] = model('character')->where($where)->get_field();
        $maxPage = floor(($maxRow-1)/$limit)+1;
        $this->g->template['maxRow'] = $maxRow;
        $this->g->template['maxPage'] = $maxPage;
        $this->g->template['currentPage'] = $page;
        $table = array(
            'provenance'=>array(
                '_on'=>'pid','name'=>'pname','_join'=>'LEFT JOIN'
            )
        );
        $this->g->template['list'] = model('character')->add_table($table)->where($where)->page($page,$limit)->order(array('cid'=>'DESC'))->select();
        T(CONTROL_NAME.'/'.__FUNCTION__);   
    }
    function save_provs_detail($id){
        $p = $this->_save('provenance',$id,true,true);
        $this->success($p);
    }
    function provs_detail($id){
        $this->subnav = array_merge($this->subnav,array(__FUNCTION__=>'添加出处'));
        $this->_init();
        $this->_detail('provs','provenance',$id);
        T(CONTROL_NAME.'/'.__FUNCTION__);
    }
    function del_provs($id){
        $p = $this->_del('provenance',$id);
        $this->success($p);
    }

    function save_chars_detail($id){
        $_POST['thumb'] = $this->_remove_suffix($_POST['thumb']);
        $p = $this->_save('character',$id,true,true);
        $this->success($p);
    }
    function get_chars_detail($id){
        $p = model('character')->find($id);
        if(!$p)$this->error(400,'no data');
        if($p['thumb'])$p['thumb'] .= '.medium.jpg';
        $this->success($p);
    }
    function chars_detail($id){
        $this->subnav = array_merge($this->subnav,array(__FUNCTION__=>'角色详情'));
        $this->_init();
        $this->_detail('chars','character',$id);
        T(CONTROL_NAME.'/'.__FUNCTION__);
    }
    function del_chars($id){
        $p = $this->_del('character',$id);
        $this->success($p);
    }
    

}