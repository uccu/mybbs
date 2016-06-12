<?php
namespace plugin\app\control\api;
defined('IN_PLAY') || exit('Access Denied');
class ajax extends \control\ajax{
    function _beginning(){
        
    }
    protected function _get_user(){
        return control('app:base','api');
    }
    protected function _get_coser(){
        return model('app:user_info');
    }
    
}
?>