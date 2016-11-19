<?php
namespace plugin\h5\control;
use plugin\app\control\base\e;
defined('IN_PLAY') || exit('Access Denied');
class bussiness extends e{
    

    function _beginning(){

        
        $this->g->template['title'] = '商务合作';

        T('bussiness');

    }


}
?>