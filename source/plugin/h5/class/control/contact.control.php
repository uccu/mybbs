<?php
namespace plugin\h5\control;
use plugin\app\control\base\e;
defined('IN_PLAY') || exit('Access Denied');
class contact extends e{
    

    function _beginning(){

        
        $this->g->template['title'] = '联系我们';

        T('contact');

    }



}
?>