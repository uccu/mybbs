<?php
namespace plugin\app\model;
defined('IN_PLAY') || die('Access Denied');
class UserTeam extends \model{
    protected $tableMap = array(
        'user_team'=>array(
            'zid','captain','uid','tid'
        ),
    );

    function _beginning(){
        
    }



}
?>