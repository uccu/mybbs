<?php
namespace plugin\app\model;
defined('IN_PLAY') || die('Access Denied');
class Picture extends \model{
    protected $tableMap = array(
        'picture'=>array(
            'pid','aid','uid','src','cid','des','tag'
        ),
    );

    function _beginning(){
        
    }



}
?>