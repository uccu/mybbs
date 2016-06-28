<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class picture extends api\ajax{
    function _beginning(){
        $this->user->_safe_login();
    }
    function upload(){
        $s = control('tool:upload','picture')->_get_srcs();
        $this->success($s);
    }
    
}
?>