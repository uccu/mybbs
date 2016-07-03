<?php
namespace plugin\app\model;
defined('IN_PLAY') || die('Access Denied');
class Album extends \model{
    protected $tableMap = array(
        'album'=>array(
            'aid','thumb','count','title','uid','tid','ctime','view'
        ),
    );

    function _beginning(){
        
    }



}
?>