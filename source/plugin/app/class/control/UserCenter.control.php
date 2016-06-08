<?php
namespace plugin\app\control;
defined('IN_PLAY') || die('Access Denied');
class UserCenter extends \control{
    function _beginning(){
        
    }
    function _user_info(){

    }
    function _blog_list(){

    }
    function _album_list(){

    }
    function _video_list(){

    }
    function _user_team(){

    }
    function _my_live(){

    }
    function index($uid=0){

        $this->g->template['user'] = model('UserInfo')->find($uid);
        T('userCenter');
    }
}




?>