<?php
namespace plugin\h5\control;
use plugin\app\control\base\e;
defined('IN_PLAY') || exit('Access Denied');
class expert extends e{
    

    function lists(){







    }


    function info($id = 0){

        $user = model('user')->find($id);

        if(!$user)return;

        $user['thumb'] = $this->imgDir.$user['thumb'];

        $this->g->template['info'] = $user;

        T('expert/info');

    }


}
?>