<?php
namespace plugin\my\control;
defined('IN_PLAY') || exit('Access Denied');
class page extends \control\ajax{
    function _beginning(){
        $this->g->config['AJAX_JSON_CONTENT']=0;
    }
    function _get_model(){
        return model('my:page');
    }
    function aid($aid){
        $m = $this->model;
        if(!$f = $m->find($aid))$this->error('401','no article');
        
    }
    function _nomethod(){
        $this->error('401','no article');
        
    }
}


?>