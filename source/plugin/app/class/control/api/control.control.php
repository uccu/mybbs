<?php
namespace plugin\app\control\api;
defined('IN_PLAY') || exit('Access Denied');
class control extends \control{
    function __construct(){
        call_user_func_array(array(parent,'__construct'),func_get_args());
        $this->g->template['me'] = $this->user->me;
    }
    protected function _get_user(){
        return control('app:base','api');
    }
    protected function _get_coser(){
        return model('app:userInfo');
    }
    
}
?>