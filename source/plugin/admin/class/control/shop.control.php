<?php
namespace plugin\admin\control;
defined('IN_PLAY') || exit('Access Denied');
class shop extends \control\ajax{
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
    function _get_gift(){
        return model('user:gift');
    }
    function _get_work(){
        return model('tool:work_list');
    }


    function lists($page=1,$s=0){
        $where=array();
        if($s)$where['gname'] = $s;
        $maxRow= $this->gift->where($where)->limit(99999999)->get_field();
        $maxPage = floor(($maxRow-1)/10)+1;
        table('config')->template['maxRow'] = $maxRow;
        table('config')->template['maxPage'] = $maxPage;
        table('config')->template['currentPage'] = $page;
        $list = $this->gift->where($where)->page($page,10)->order(array('ctime'=>'DESC'))->select();
        foreach($list as &$p){
            $p['cdate'] = date('Y-m-d',$p['ctime']);
        }
        table('config')->template['list'] = $list;
        //table('config')->template['projects'] = $this->project->field(array('jid','jthumb','jname'))->limit(999)->order(array('jorder'))->select();
        T('admin:shop/lists');
        
    }

    function get_gift_detail($id){
        $d = $this->gift->find($id);
        
        if(!$d)$this->error(411,'获取失败');
        $this->success($d);
    }
    function change_gift(){
        $id = post('gid');
        $d = $this->gift->data($_POST)->save($id);
        
        $this->success($d);
    }
    function add_gift(){
        $data=array(

                'gthumb'=>'no_gift_thumb.png',
                'gpic'=>'no_gift_pic.png',
                'gname'=>'新建商品',
                'gtitle'=>'新建商品',
                'ctime'=>time(),
  
        );
        $d = $this->gift->data($data)->add();
        $this->success($d);
    }
    function del_gift($id){
        $d = $this->gift->remove($id);
        $this->success($d);
    }
    function _nomethod(){
        $this->lists();
    }

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>