<?php
namespace plugin\admin\control;
defined('IN_PLAY') || exit('Access Denied');
class product extends \control\ajax{
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
    function _get_work(){
        return model('tool:work_list');
    }


    function lists($page=1,$jid=0){
        $where=array();
        if($jid){
            $where['jid'] = $jid;
            $this->productView->add_table($this->productView->productMap);
        }
        if($jid)$maxRow= $this->productView->where($where)->limit(99999999)->get_field();
        else $maxRow= $this->product->where($where)->limit(99999999)->get_field();
        $maxPage = floor(($maxRow-1)/10)+1;
        table('config')->template['maxRow'] = $maxRow;
        table('config')->template['maxPage'] = $maxPage;
        table('config')->template['currentPage'] = $page;
        if($jid)$list = $this->productView->where($where)->page($page,10)->order(array('dctime'=>'DESC'))->select();
        else $list = $this->product->where($where)->page($page,10)->order(array('dctime'=>'DESC'))->select();
        foreach($list as &$p){
            $p['cdate'] = date('Y-m-d',$p['dctime']);
        }
        table('config')->template['list'] = $list;
        table('config')->template['projects'] = $this->project->field(array('jid','jthumb','jname'))->limit(999)->order(array('jorder'))->select();
        T('admin:product/lists');
        
    }

    function get_product_detail($id){
        $d = $this->product->find($id);
        $e = $this->productView->where(array('did'=>$id))->limit(99999)->select();
        foreach($e as &$v){
            $v = $v['jid'];
        }
        $d['interest'] = $e;
        if(!$d)$this->error(411,'获取失败');
        $this->success($d);
    }
    function change_product(){
        $_POST['introduction'] = str_ireplace(array('&lt;','&gt;','&quot;','&#39;'),array('<','>','"',"'"),$_POST['introduction']);
        $_POST['fealture'] = str_ireplace(array('&lt;','&gt;','&quot;','&#39;'),array('<','>','"',"'"),$_POST['fealture']);
        $_POST['effect'] = str_ireplace(array('&lt;','&gt;','&quot;','&#39;'),array('<','>','"',"'"),$_POST['effect']);
        $_POST['purchase'] = str_ireplace(array('&lt;','&gt;','&quot;','&#39;'),array('<','>','"',"'"),$_POST['purchase']);
        $id = post('did');
        $d = $this->product->data($_POST)->save($id);
        $this->productView->where(array('did'=>$id))->remove();
        foreach(post('interest') as $v){
            $data = array('did'=>$id,'jid'=>$v);
            $this->productView->data($data)->add(true);
        }
        $this->success($d);
    }
    function add_product(){
        $data=array(

                'dthumb'=>'no_product_thumb.png',
                'dname'=>'产品',
                'dpic'=>'no_product_pic.png',
                'dctime'=>time(),
                'introduction'=>'',
                'fealture'=>'',
                'effect'=>'',
                'purchase'=>''
  
        );
        $d = $this->product->data($data)->add();
        $this->success($d);
    }
    function del_product($id){
        $d = $this->product->remove($id);
        $this->productView->where(array('did'=>$id))->remove();
        $this->success($d);
    }
    function _nomethod(){
        $this->lists();
    }

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>