<?php
namespace plugin\common\control;
defined('IN_PLAY') || exit('Access Denied');
class opition extends \control\ajax{
    function _beginning(){
        //$this->user->_safe_login();
    }
    function _get_user(){
        return control('user:base','api');
    }
    function _get_model(){
        return model('common:opition');
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
                "pic"=>"sy_33.png"
            ),
            array(
                "type"=>"article",
                "value"=>"1",
                "pic"=>"sy_33.png"
            )
        );
        $data['content'] = array('logic',$f,'%s');
        $m = $this->model->data($data)->save('logo_pic');
        $this->success($m);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>