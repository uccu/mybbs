<?php
namespace plugin\app\control;
defined('IN_PLAY') || die('Access Denied');
class Video extends api\ajax{
    function _beginning(){
        
    }

    function _video($vid){
        return model('app:Video')->find($vid);
    }
    function index($vid){
        $video = $this->g->template['video'] = $this->_video($vid);
        if(!$video)$this->error(401,'视频不存在');
        T('Video');
    }
}




?>