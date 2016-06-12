<?php
namespace plugin\app\model;
defined('IN_PLAY') || die('Access Denied');
class UserCount extends \model{
    protected $tableMap = array(
        'user_count'=>array(
            'uid','follow','sign','fans'
        ),
    );
    

}
?>