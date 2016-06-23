<?php
namespace plugin\testadmin\control;
defined('IN_PLAY') || exit('Access Denied');
class Contest extends na\ba{
    function _get_subnav(){
        return array(
            'contests'=>'大赛列表',
            'videos'=>'视频列表',
            
        );
    }

    protected function _beginning(){
        
    }
    function _get_defaultMethod(){
        return 'contests';
    }
    function contests($page=1){
        $page = floor($page)?floor($page):1;
        $this->_init();
        $where = array();$limit=10;
        $maxRow = $this->g->tempalte['maxPage'] = model('contest')->get_field();
        $maxPage = floor(($maxRow-1)/$limit)+1;
        $this->g->template['maxRow'] = $maxRow;
        $this->g->template['maxPage'] = $maxPage;
        $this->g->template['currentPage'] = $page;
        $this->g->template['list'] = model('contest')->page($page,$limit)->order(array('cid'=>'DESC'))->select();
        T(CONTROL_NAME.'/'.__FUNCTION__);   
    }
    
    function save_contests_detail($id){
        $_POST['content'] = $this->_remove_suffix($_REQUEST['content']);
        $_POST['thumb'] = $this->_remove_suffix($_POST['thumb']);
        $p = $this->_save('contest',$id,true,true);
        $this->success($p);
    }
    function contests_detail($id){
        $this->subnav = array_merge($this->subnav,array(__FUNCTION__=>'大赛详情'));
        $this->_init();
        $this->_detail('contests','contest',$id);
        T(CONTROL_NAME.'/'.__FUNCTION__);
    }
    function del_contests($id){
        $p = $this->_del('contest',$id);
        $this->success($p);
    }

    function get_contests_detail($id){
        $p = model('contest')->find($id);
        //if(!$p)$this->error(400,'no data');
        if($p['thumb'])$p['thumb'] .= '.medium.jpg';
        if(!$p['content'])$p['content'] = '';
        $this->success($p);
    }

    

}