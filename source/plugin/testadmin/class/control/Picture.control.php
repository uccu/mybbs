<?php
namespace plugin\testadmin\control;
defined('IN_PLAY') || exit('Access Denied');
class Picture extends na\ba{
    function _get_subnav(){
        return array(
            'pictures'=>'照片列表',
            'tag'=>'标签'
            
        );
    }

    protected function _beginning(){
        
    }
    function _get_defaultMethod(){
        return 'pictures';
    }
    function pictures($page=1,$aid=0){
        $page = floor($page)?floor($page):1;
        $this->_init();
        $where = array();$limit=10;
        if($type)$where['aid'] = $aid;
        $maxRow = $this->g->tempalte['maxPage'] = model('picture')->where($where)->get_field();
        $maxPage = floor(($maxRow-1)/$limit)+1;
        $this->g->template['maxRow'] = $maxRow;
        $this->g->template['maxPage'] = $maxPage;
        $this->g->template['currentPage'] = $page;
        $this->g->template['list'] = model('picture')->add_table(array('album'=>array('_on'=>'aid','title')))->where($where)->page($page,$limit)->order(array('pid'=>'DESC'))->select();
        T(CONTROL_NAME.'/'.__FUNCTION__);   
    }
    
    function save_pictures_detail($id){
        $p = $this->_save('picture',$id,true,true);
        $this->success($p);
    }
    function pictures_detail($id){
        $this->subnav = array_merge($this->subnav,array(__FUNCTION__=>'添加相册'));
        $this->_init();
        $this->_detail('pictures','picture',$id);
        T(CONTROL_NAME.'/'.__FUNCTION__);
    }
    function del_pictures($id){
        $p = $this->_del('picture',$id);
        $this->success($p);
    }
    function get_pictures_detail($id){
        $p = model('picture')->find($id);
        if(!$p)$this->error(400,'no data');
        $this->success($p);
    }

    function tag($page=1){
        $page = floor($page)?floor($page):1;
        $this->_init();
        $where = array();$limit=10;
        $maxRow = $this->g->tempalte['maxPage'] = model('tag')->where($where)->get_field();
        $maxPage = floor(($maxRow-1)/$limit)+1;
        $this->g->template['maxRow'] = $maxRow;
        $this->g->template['maxPage'] = $maxPage;
        $this->g->template['currentPage'] = $page;
        $this->g->template['list'] = model('tag')->page($page,$limit)->order(array('tid'=>'DESC'))->select();
        T(CONTROL_NAME.'/'.__FUNCTION__);   
    }
    function save_tag_detail($id){
        $p = $this->_save('tag',$id,true,true);
        $this->success($p);
    }
    function tag_detail($id){
        $this->subnav = array_merge($this->subnav,array(__FUNCTION__=>'添加标签'));
        $this->_init();
        $this->_detail('tag','tag',$id);
        T(CONTROL_NAME.'/'.__FUNCTION__);
    }
    function del_tag($id){
        $p = $this->_del('tag',$id);
        $this->success($p);
    }
    function get_tag_detail($id){
        $p = model('tag')->find($id);
        if(!$p)$this->error(400,'no data');
        $this->success($p);
    }

}