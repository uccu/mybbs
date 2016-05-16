<?php
namespace plugin\tool\control;
defined('IN_PLAY') || exit('Access Denied');
class other extends \control\ajax{
    function _beginning(){

    }
    function _get_area(){
        return model('tool:area');
    }
    function get_area(){
        $m = $this->area->field(array('province','city','district'))->order(array('province','city','district'))->limit(9999)->select();
        $this->success($m);
    }
    
}
?>