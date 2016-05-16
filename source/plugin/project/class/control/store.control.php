<?php
namespace plugin\project\control;
defined('IN_PLAY') || exit('Access Denied');
class store extends \control\ajax{
    function _beginning(){
        //$this->user->_safe_login();
    }
    function _get_user(){
        return control('user:base','api');
    }
    function _get_store(){
        return model('project:store_info');
    }
    function _get_expert(){
        return model('project:expert_info');
    }
    function _get_pls(){
        $m = model('project:project_link_store');
        return $m->add_table($m->store);
    }
    function get_store_list(){
        $where['jid'] = post('jid');
        $where['area'] = post('area');
        $m = $this->pls->where($where)->limit(9999)->select();
        $this->success($m);
    }
    function get_expert_list(){
        $where['sid'] = post('sid');
        $m = $this->expert->where($where)->limit(9999)->select();
        $this->success($m);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>