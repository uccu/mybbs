<?php
namespace plugin\testadmin\control;
defined('IN_PLAY') || exit('Access Denied');
class Team extends na\ba{
    function _get_subnav(){
        return array(
            'teams'=>'团队列表',
            //'videos'=>'视频列表',
            
        );
    }

    protected function _beginning(){
        
    }
    function _get_defaultMethod(){
        return 'teams';
    }
    function teams($page=1){
        $page = floor($page)?floor($page):1;
        $this->_init();
        $where = array();$limit=10;
        $maxRow = $this->g->tempalte['maxPage'] = model('team')->get_field();
        $maxPage = floor(($maxRow-1)/$limit)+1;
        $this->g->template['maxRow'] = $maxRow;
        $this->g->template['maxPage'] = $maxPage;
        $this->g->template['currentPage'] = $page;
        $this->g->template['list'] = model('team')->page($page,$limit)->order(array('tid'=>'DESC'))->select();
        T(CONTROL_NAME.'/'.__FUNCTION__);   
    }
    
    function save_teams_detail($id){
        $_POST['pic'] = $this->_remove_suffix($_POST['pic']);
        $_POST['thumb'] = $this->_remove_suffix($_POST['thumb']);
        $p = $this->_save('team',$id,true,true);
        $this->success($p);
    }
    function teams_detail($id){
        $this->subnav = array_merge($this->subnav,array(__FUNCTION__=>'团队详情'));
        $this->_init();
        $this->_detail('teams','team',$id);
        T(CONTROL_NAME.'/'.__FUNCTION__);
    }
    function del_teams($id){
        $p = $this->_del('team',$id);
        $this->userInfo->data(array('tid'=>0))->where(array('tid'=>$id))->save();
        model('user_team')->data(array('tid'=>$id))->remove();
        $this->success($p);
    }

    function get_teams_detail($id){
        $p = model('team')->find($id);
        if(!$p)$this->error(400,'no data');
        if($p['thumb'])$p['thumb'] .= '.avatar.jpg';
        if($p['pic'])$p['pic'] .= '.medium.jpg';
        $this->success($p);
    }
   
    

}