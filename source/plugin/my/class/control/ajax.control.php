<?php
namespace plugin\my\control;
defined('IN_PLAY') || exit('Access Denied');
class ajax extends \control{
    function _beginning(){
        
    }
    function release(){
        $title = post('title');
        $content = post('content');
        $content = preg_replace('/\n/i','<br />',$content);
        echo $content;
    }
    
    
}


?>