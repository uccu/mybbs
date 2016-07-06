<?php
namespace plugin\testadmin\control;
defined('IN_PLAY') || exit('Access Denied');
class Album extends na\ba{
    function _get_subnav(){
        return array(
            'albums'=>'相册列表',

            
        );
    }

    protected function _beginning(){
        
    }
    function _get_defaultMethod(){
        return 'albums';
    }
    function albums($page=1,$uid=0){
        $page = floor($page)?floor($page):1;
        $this->_init();
        $where = array();$limit=10;
        if($type)$where['uid'] = $uid;
        $maxRow = $this->g->tempalte['maxPage'] = model('album')->where($where)->get_field();
        $maxPage = floor(($maxRow-1)/$limit)+1;
        $this->g->template['maxRow'] = $maxRow;
        $this->g->template['maxPage'] = $maxPage;
        $this->g->template['currentPage'] = $page;
        $this->g->template['list'] = model('album')->add_table(array('user_info'=>array('_on'=>'uid','nickname')))->where($where)->page($page,$limit)->order(array('aid'=>'DESC'))->select();
        T(CONTROL_NAME.'/'.__FUNCTION__);
    }
    
    function save_albums_detail($id){
        $p = $this->_save('album',$id,true,true);
        $this->success($p);
    }
    function albums_detail($id){
        $this->subnav = array_merge($this->subnav,array(__FUNCTION__=>'添加相册'));
        $this->_init();
        $this->_detail('albums','album',$id);
        T(CONTROL_NAME.'/'.__FUNCTION__);
    }
    function del_albums($id){
        $p = $this->_del('album',$id);
        $this->success($p);
    }

    
    function get_albums_detail($id){
        $p = model('album')->find($id);
        if(!$p)$this->error(400,'no data');
        $this->success($p);
    }
    

}