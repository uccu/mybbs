<?php
namespace plugin\tool\control;
defined('IN_PLAY') || exit('Access Denied');
class picture extends \control\ajax{
    function _beginning(){
        $this->checkAJAX = 0;
        //var_dump($this->uid);die();
    }
    function upload(){
        $s = control('upload','picture')->_get_srcs();
        $this->success($s);
    }
    
}
?>