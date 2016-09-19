<?php
namespace plugin\admin\control;
defined('IN_PLAY') || exit('Access Denied');
class store extends \control\ajax{
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
    function _get_area(){
        return model('tool:area');
    }
    function _get_work(){
        return model('tool:work_list');
    }


    function lists($page=1,$area=0,$s=0){
        $where=array();
        if($s)$where['sid'] = $s;
        if($area)$where['area'] = $area;
        $maxRow= $this->store->where($where)->limit(99999999)->get_field();
        $maxPage = floor(($maxRow-1)/10)+1;
        table('config')->template['maxRow'] = $maxRow;
        table('config')->template['maxPage'] = $maxPage;
        table('config')->template['currentPage'] = $page;
        $list = $this->store->where($where)->page($page,10)->order(array('sid'=>'DESC'))->select();

        table('config')->template['list'] = $list;
        table('config')->template['store_areas'] = $this->store->field('DISTINCT `area`')->order('area')->limit(9999)->select();
        table('config')->template['areas'] = $this->area->field("concat(province,' ',city,' ',district) as name")->order(array('province','city','district'))->limit(9999)->select();
        table('config')->template['projects'] = $this->project->field(array('jid','jthumb','jname'))->limit(999)->order(array('jorder'))->select();
        T('admin:store/lists');
        
    }

    function get_store_detail($id){
        $d = $this->store->find($id);
        $e = $this->storeView->where(array('sid'=>$id))->limit(99999)->select();
        foreach($e as &$v){
            $v = $v['jid'];
        }
        $d['interest'] = $e;
        if(!$d)$this->error(411,'获取失败');
        $this->success($d);
    }
    function change_store(){
        $id = post('sid');
        $d = $this->store->data($_POST)->save($id);
        $this->storeView->where(array('sid'=>$id))->remove();
        foreach(post('interest') as $v){
            $data = array('sid'=>$id,'jid'=>$v);
            $this->storeView->data($data)->add(true);
        }
        $this->success($d);
    }
    function add_store(){
        $data=array(

                'sthumb'=>'no_store_thumb.png',
                'sname'=>'医院',
                'address'=>'',
                'area'=>'',
                'phone'=>'',
  
        );
        $d = $this->store->data($data)->add();
        $this->success($d);
    }
    function del_store($id){
        $d = $this->store->remove($id);
        $this->storeView->where(array('sid'=>$id))->remove();
        $this->success($d);
    }
    function _nomethod(){
        $this->lists();
    }

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>