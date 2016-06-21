<?php
namespace plugin\testadmin\control;
defined('IN_PLAY') || exit('Access Denied');
class admin{
    function up_pic(){
        $a = control('tool:upload','picture')->_get_srcs();
        var_dump($a);
    }
    

}