<?php
namespace plugin\tool\control;
defined('IN_PLAY') || exit('Access Denied');
class git extends \control\ajax{
    function _beginning(){
        
    }
    function pull(){
        $last_line = system('git pull',$retval);
        $array['last_line'] = $last_line;
        $array['retval'] = $retval;
        $this->success($array);
    }
    function ls(){
        $last_line = system('ls',$retval);
        $array['last_line'] = $last_line;
        $array['retval'] = $retval;
        $this->success($array);
    }
    function ping(){
        $last_line = system('ping baidu.com',$retval);
        $array['last_line'] = $last_line;
        $array['retval'] = $retval;
        $this->success($array);
    }
}
?>