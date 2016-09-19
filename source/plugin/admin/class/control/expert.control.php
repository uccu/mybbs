<?php
namespace plugin\admin\control;
defined('IN_PLAY') || exit('Access Denied');
class expert extends \control\ajax{
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
    function _get_store(){
        return model('project:store_info');
    }
    function _get_storeView(){
        return model('project:project_link_store');
    }
    function _get_productView(){
        return model('project:project_link_product');
    }
    function _get_expert(){
        return model('project:expert_info');
    }
    function _get_area(){
        return model('tool:area');
    }
    function _get_work(){
        return model('tool:work_list');
    }


    function lists($page=1,$s=0,$n=0){
        $where=array();
        if($s)$where['sid'] = $s;
        if($n)$where['ename'] = $n;
        $maxRow= $this->expert->where($where)->limit(99999999)->get_field();
        $maxPage = floor(($maxRow-1)/10)+1;
        table('config')->template['maxRow'] = $maxRow;
        table('config')->template['maxPage'] = $maxPage;
        table('config')->template['currentPage'] = $page;
        $list = $this->expert->where($where)->page($page,10)->order(array('eid'=>'DESC'))->select();

        table('config')->template['list'] = $list;
        //table('config')->template['store_areas'] = $this->store->field('DISTINCT `area`')->order('area')->limit(9999)->select();
        //table('config')->template['areas'] = $this->area->field("concat(province,' ',city,' ',district) as name")->order(array('province','city','district'))->limit(9999)->select();
        //table('config')->template['projects'] = $this->project->field(array('jid','jthumb','jname'))->limit(999)->order(array('jorder'))->select();
        T('admin:expert/lists');
        
    }

    function get_expert_detail($id){
        $d = $this->expert->find($id);
        if(!$d)$this->error(411,'获取失败');
        $this->success($d);
    }
    function change_expert(){
        $id = post('eid');
        $d = $this->expert->data($_POST)->save($id);
        $this->expertView->where(array('sid'=>$id))->remove();
        foreach(post('interest') as $v){
            $data = array('sid'=>$id,'jid'=>$v);
            $this->expertView->data($data)->add(true);
        }
        $this->success($d);
    }
    function add_expert(){
        $data=array(
                'ethumb'=>'no_expert_thumb.png',
        );
        $d = $this->expert->data($data)->add();
        $this->success($d);
    }
    function del_expert($id){
        $d = $this->expert->remove($id);
        $this->success($d);
    }
    function _nomethod(){
        $this->lists();
    }

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>