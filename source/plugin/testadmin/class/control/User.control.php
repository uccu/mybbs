<?php
namespace plugin\testadmin\control;
defined('IN_PLAY') || exit('Access Denied');
class user extends na\ba{
    function _get_subnav(){
        return array(
            'search'=>'用户搜索',
            'lists'=>'用户列表',
            
        );
    }

    protected function _beginning(){
        
    }
    function _get_defaultMethod(){
        return 'search';
    }
    function search($a){
        $this->_init();
        T(CONTROL_NAME.'/'.__FUNCTION__);   
    }
    
    function lists($page = 1){
        $where = array();$limit = 10;
        if($uid = post('uid'))$where['uid'] = $uid;
        if($nickname = post('nickname'))$where['nickname'] = $nickname;
        if($phone = post('phone'))$where['phone'] = $phone;
        if($tid = post('tid'))$where['tid'] = $tid;
        $this->_init();
        $maxRow = $this->g->tempalte['maxPage'] = $this->userInfo->where($where)->get_field();
        $maxPage = floor(($maxRow-1)/$limit)+1;
        $this->g->template['maxRow'] = $maxRow;
        $this->g->template['maxPage'] = $maxPage;
        $this->g->template['currentPage'] = $page;
        $this->g->template['list'] = $this->userInfo->where($where)->page($page,$limit)->order(array('uid'=>desc))->select();
        
        T('user/lists');
    }
    function detail($uid = 0){
        $this->subnav = array_merge($this->subnav,array('detail'=>'用户信息'));
        if(!$uid)$this->_header('lists');
        if(!$userInfo = $this->userInfo->find($uid))$this->_header('lists');
        $this->_init();
        $this->g->template['uid'] = $userInfo['uid'];
        T('user/detail');
    }
    function get_detail($uid){
        $userInfo = $this->userInfo->safe_info()->find($uid);
        if(!$userInfo)$this->error(400,'no user');
        $this->success($userInfo);
    }
    function save_detail($uid){
        if(!$uid)$this->error(400,'no user');
        if(!$_POST['password'])unset($_POST['password']);
        $p = $this->userInfo->data($_POST)->save($uid);
        $this->success($p);
    }
    function del_lists(){


        $this->error('500','不允许删除用户');
    }


}