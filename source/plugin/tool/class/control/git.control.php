<?php
namespace plugin\tool\control;
defined('IN_PLAY') || exit('Access Denied');
class git extends \control\ajax{
    function _beginning(){
        
    }
    function pull(){
        system('d:\wamp\www\git_pull.bat',$out);
        $this->success($out);
    }
    function ls(){
        system('ls',$out);
        $this->success($out);
    }

}
?>