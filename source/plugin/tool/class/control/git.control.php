<?php
namespace plugin\tool\control;
defined('IN_PLAY') || exit('Access Denied');
class git extends \control\ajax{
    function _beginning(){
        
    }
    function pull(){
        $last_line = system('d:\wamp\www\git_pull.bat',$retval);
        $array['last_line'] = $last_line;
        $array['retval'] = $retval;
        $this->success($array);
    }
    function ls(){
        system('ls',$out);
        $this->success($out);
    }

}
?>