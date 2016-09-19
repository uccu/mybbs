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
        foreach($m as &$v){
            if($v['type']=='product'){
                $v['name'] = model('project:product')->find($v['value'],0)->get_field('dname');
            }elseif($v['type']=='project'){
                $v['name'] = model('project:project')->find($v['value'],0)->get_field('jname');
            }else{
                $v['name']='';
            }
        }
        $this->success($m);
        
    }
    function get_ad(){
        $m = $this->model->find('logo_ad');
        if(!$m)$m = array();
        else $m = unserialize($m['content']);
        $this->success($m);
        
    }
    function get_shop_pic(){
        $m = $this->model->find('shop_pic');
        if(!$m)$m = array();
        else $m = unserialize($m['content']);
        
        foreach($m as &$v){
            if($v['type']=='product'){
                $v['name'] = model('project:product')->find($v['value'],0)->get_field('dname');
            }elseif($v['type']=='project'){
                $v['name'] = model('project:project')->find($v['value'],0)->get_field('jname');
            }else{
                $v['name']='';
            }
        }
        $this->success($m);
        
    }
   
    function get_project(){
        $this->user->_safe_login();
        //$this->user->uid = 194;
        $interest = $this->userModel->find($this->user->uid,false)->get_field('interest');
        $interest = unserialize($interest);$pro = array();
        foreach($interest as $k=>$i){
            if($k>3)break;
            $pro[] = $this->project->field(array('jid','jthumb','jname'))->find($i);
        }
        if(count($pro)<4){
            $n = 4-count($pro);
            $where = array();
            if($interest)$where['jid'] = array('contain',$interest,'NOT IN');
            $pro2 = $this->project->where($where)->field(array('jid','jthumb','jname'))->order(array('jctime'=>'DESC'))->limit($n)->select();
            $pro = array_merge($pro,$pro2);
        }
        $this->success($pro);
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>