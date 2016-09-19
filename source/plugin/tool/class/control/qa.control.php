<?php
namespace plugin\tool\control;
defined('IN_PLAY') || exit('Access Denied');
class qa extends \control\ajax{
    function _beginning(){

    }
    function _nomethod(){
        $this->g->template['qa'] = model('qa')->limit(9999)->select();
        T();
    }
    
}
?>