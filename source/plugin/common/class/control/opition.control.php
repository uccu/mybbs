<?php
namespace plugin\common\control;
defined('IN_PLAY') || exit('Access Denied');
class opition extends \control\ajax{
    function _beginning(){
        
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
    function get_logo_pic(){
        $m = $this->model->find('logo_pic');
        if(!$m)$m = array();
        else $m = unserialize($m['content']);
        $this->success($m);
        
    }
    function set_logo_pic(){
        $f = array(
            array(
                "type"=>"none",
                "value"=>"",
                "pic"=>"sq_23.png"
            ),
            array(
                "type"=>"article",
                "value"=>"1",
                "pic"=>"sq_23.png"
            ),array(
                "type"=>"article",
                "value"=>"1",
                "pic"=>"sq_23.png"
            ),array(
                "type"=>"article",
                "value"=>"1",
                "pic"=>"sq_23.png"
            )
        );
        $data['content'] = array('logic',$f,'%s');
        $m = $this->model->data($data)->save('logo_pic');
        $this->success($m);
    }
    function get_project(){
        $this->user->_safe_login();
        $interest = $this->userModel->find($this->user->uid,false)->get_field('interest');
        $interest = unserialize($interest);$pro = array();
        foreach($interest as $k=>$i){
            if($k>3)break;
            $pro[] = $this->project->field(array('jid','jthumb','jname'))->find($i);
        }
        if(count($pro)<4){
            $n = 4-count($pro);
            $where['jid'] = array('contain',$interest,'NOT IN');
            $pro2 = $this->project->field(array('jid','jthumb','jname'))->limit($n)->select();
            $pro = array_merge($pro,$pro2);
        }
        $this->success($pro);
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>