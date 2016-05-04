<?php
namespace plugin\seanime\control;
defined('IN_PLAY') || exit('Access Denied');
class upload extends \control{
    private $listField;
    function _beginning(){
        $sd = $this->sort->sdtype;
        $this->user->uid;
        $user = (array)$this->user;
        $t = template();
        $g = (array)table('config');
        include $t;
        
    }
    function _get_sort(){
        return model('seanime:seanime_sort');
    }
    function _get_user(){
        return control('user:base','api');
    }
}

?>