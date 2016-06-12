<?php
namespace plugin\app\model;
defined('IN_PLAY') || die('Access Denied');
class Video extends \model{
    protected $tableMap = array(
        'video'=>array(
            'vid','thumb','iframe','title','uid','tid','ctime'
        ),
    );

    function _beginning(){
        
    }



}
?>