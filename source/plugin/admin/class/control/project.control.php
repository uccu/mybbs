<?php
namespace plugin\admin\control;
defined('IN_PLAY') || exit('Access Denied');
class project extends \control\ajax{
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
    function _get_area(){
        return model('tool:area');
    }
    function _get_work(){
        return model('tool:work_list');
    }


    function lists(){

        $list = $this->project->limit(9999)->order(array('jctime'=>'DESC'))->select();
        foreach($list as &$p){
            $p['cdate'] = date('Y-m-d',$p['jctime']);
        }
        table('config')->template['list'] = $list;
        T('admin:project/lists');
        
    }

    function get_detail($jid){
        $tt = post('jid',0,'%d');
        if($tt)$jid = $tt;
        $d = $this->project->find($jid);
        if(!$d)$this->error(411,'获取失败');
        $this->success($d);
    }
    function change_project(){
        $_POST['introduction'] = str_ireplace(array('&lt;','&gt;','&quot;','&#39;'),array('<','>','"',"'"),$_POST['introduction']);
        $_POST['fealture'] = str_ireplace(array('&lt;','&gt;','&quot;','&#39;'),array('<','>','"',"'"),$_POST['fealture']);
        $_POST['expert'] = str_ireplace(array('&lt;','&gt;','&quot;','&#39;'),array('<','>','"',"'"),$_POST['expert']);
        $_POST['attention'] = str_ireplace(array('&lt;','&gt;','&quot;','&#39;'),array('<','>','"',"'"),$_POST['attention']);
        $d = $this->project->data($_POST)->save(post('jid'));
        $this->success($d);
    }
    function add_project(){
        $data=array(
                
                "jthumb"=>'nopic.png',
                "jname"=>'未知项目',
                "jpic"=>'nopic.png',
                "introduction"=>'',
                "expert"=>'',
                "fealture"=>'',
                "attention"=>'',
                "jctime"=>time(),
  
        );
        $d = $this->project->data($data)->add();
        $this->success($d);
    }
    function del_project(){
        $d = $this->project->remove(post('jid'));
        $this->success($d);
    }
    function _nomethod(){
        $this->lists();
    }

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>