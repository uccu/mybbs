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
    
    function save_provs_detail($id){
        $p = $this->_save('provenance',$id,true,true);
        $this->success($p);
    }
    function _detail($callback,$m,$id){
        if(is_null($id))$this->_header($callback);
        $info = model($m)->find($id);
        $this->g->template['id'] = $info ? reset($info) : 0;
    }
    function _del($m,$id){
        if(!$id)$this->error(400,'no data');
        return model($m)->remove($id);
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
    
    

}