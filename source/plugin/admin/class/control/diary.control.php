<?php
namespace plugin\admin\control;
defined('IN_PLAY') || exit('Access Denied');
class diary extends \control\ajax{
    function _beginning(){
        if($this->user->type<2)header('Location:/admin/login');
        table('config')->template['userType'] = $this->user->type;
    }
    function _get_user(){
        return control('user:base','api');
    }
    function _get_model(){
        return model('common:opition');
    }
    function _get_userModel(){
        return model('user:user_info');
    }
    function _get_project(){
        return model('project:project');
    }
    function _get_product(){
        return model('project:product');
    }
    function _get_productView(){
        return model('project:project_link_product');
    }
    function _get_area(){
        return model('tool:area');
    }
    function _get_diary(){
        return model('diary:diary');
    }
    function _get_work(){
        return model('tool:work_list');
    }


    function lists($page=1,$nickname=0,$did=0){
        if($did)$where['did'] = $did;
        if($nickname)$where['nickname'] = $nickname;
        $where['reply'] = 0;
        $this->diary->add_table($this->diary->userMap);
        $maxRow= $this->diary->where($where)->limit(99999999)->get_field();
        $maxPage = floor(($maxRow-1)/10)+1;
        table('config')->template['maxRow'] = $maxRow;
        table('config')->template['maxPage'] = $maxPage;
        table('config')->template['currentPage'] = $page;
        $list = $this->diary->where($where)->page($page,10)->order(array('ctime'=>'DESC'))->select();
        foreach($list as &$p)$p['cdate'] = date('Y-m-d',$p['otime']);
        table('config')->template['list'] = $list;
        T('admin:diary/lists');
        
    }
    function replys($page=1,$reply=0){
        if($reply)$where['reply'] = $reply;
        else $where['reply'] = array('logic',0,'!=');
        $this->diary->add_table($this->diary->userMap);
        $maxRow= $this->diary->where($where)->limit(99999999)->get_field();
        $maxPage = floor(($maxRow-1)/10)+1;
        table('config')->template['maxRow'] = $maxRow;
        table('config')->template['maxPage'] = $maxPage;
        table('config')->template['currentPage'] = $page;
        $list = $this->diary->where($where)->page($page,10)->order(array('ctime'=>'DESC'))->select();
        foreach($list as &$p){
            $p['cdate'] = date('Y-m-d',$p['ctime']);
            $p['has_suggest'] = $p['suggest']?'有':'无';
        }
        table('config')->template['list'] = $list;
        T('admin:diary/replys');
        
    }
    function get_diary_detail($id){
        $d = $this->diary->find($id);
        if(!$d)$this->error(411,'获取失败');
        $this->success($d);
    }
    function change_diary(){
        $id = post('did');
        $d = $this->diary->data($_POST)->save($id);
        $this->success($d);
    }

    function del_diary($id){
        $d = $this->diary->remove($id);
        $this->success($d);
    }
    function _nomethod(){
        $this->lists();
    }

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>