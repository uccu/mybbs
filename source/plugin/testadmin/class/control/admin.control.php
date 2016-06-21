<?php
namespace plugin\testadmin\control;
defined('IN_PLAY') || exit('Access Denied');
class admin extends \control\ajax{
    function up_pic(){
        $a = control('tool:upload','picture')->_get_srcs();
        $this->success($a);
    }
    

}