<?php
namespace plugin\admin\control;
defined('IN_PLAY') || exit('Access Denied');
class community extends \control\ajax{
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
    function _get_thread(){
        return model('community:thread');
    }
    function _get_work(){
        return model('tool:work_list');
    }


    function lists($page=1,$nickname=0,$hid=0){
        if($hid)$where['hid'] = $hid;
        if($nickname)$where['nickname'] = $nickname;
        $where['reply'] = 0;
        $this->thread->add_table($this->thread->userMap);
        $maxRow= $this->thread->where($where)->limit(99999999)->get_field();
        $maxPage = floor(($maxRow-1)/10)+1;
        table('config')->template['maxRow'] = $maxRow;
        table('config')->template['maxPage'] = $maxPage;
        table('config')->template['currentPage'] = $page;
        $list = $this->thread->where($where)->page($page,10)->order(array('ctime'=>'DESC'))->select();
        foreach($list as &$p)$p['cdate'] = date('Y-m-d',$p['ctime']);
        table('config')->template['list'] = $list;
        T('admin:community/lists');
        
    }
    function replys($page=1,$reply=0){
        if($reply)$where['reply'] = $reply;
        else $where['reply'] = array('logic',0,'!=');
        $this->thread->add_table($this->thread->userMap);
        $maxRow= $this->thread->where($where)->limit(99999999)->get_field();
        $maxPage = floor(($maxRow-1)/10)+1;
        table('config')->template['maxRow'] = $maxRow;
        table('config')->template['maxPage'] = $maxPage;
        table('config')->template['currentPage'] = $page;
        $list = $this->thread->where($where)->page($page,10)->order(array('ctime'=>'DESC'))->select();
        foreach($list as &$p){
            $p['cdate'] = date('Y-m-d',$p['ctime']);
            
        }
        table('config')->template['list'] = $list;
        T('admin:community/replys');
        
    }
    function get_thread_detail($id){
        $d = $this->thread->find($id);
        $d['pic'] = unserialize($d['pic']);
            if($d['pic']){
                foreach($d['pic'] as $k=>$pic){
                    $key = 'pic'.$k;
                    $d[$key] = $pic;
                }
            }
            if(!$d['pic0'])$d['pic0']='';
            if(!$d['pic1'])$d['pic1']='';
            if(!$d['pic2'])$d['pic2']='';
        if(!$d)$this->error(411,'获取失败');
        $this->success($d);
    }
    function change_thread(){
        $id = post('hid');
        $_POST['pic'] = array();
        if($_POST['pic0'])$_POST['pic'][] = $_POST['pic0'];
        if($_POST['pic1'])$_POST['pic'][] = $_POST['pic1'];
        if($_POST['pic2'])$_POST['pic'][] = $_POST['pic2'];
        $_POST['pic'] = array('logic',$_POST['pic'],'%s');
        $d = $this->thread->data($_POST)->save($id);
        $this->success($d);
    }

    function del_thread($id){
        $r = $this->thread->find($id);
        $d = $this->thread->remove($id);
        if($id){
            $where['reply'] = $id;
            $d = $this->thread->where($where)->remove();
        }
        if($r){
            $data['reply_num'] = array('add',-1);
            $this->model->data($data)->save($r['reply']);
        }
        $this->success($d);
    }
    function _nomethod(){
        $this->lists();
    }

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>