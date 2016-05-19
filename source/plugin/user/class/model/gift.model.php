<?php
namespace plugin\user\model;
defined('IN_PLAY') || exit('Access Denied');
class gift extends \model{
    protected $tableMap = array(
        'gift'=>array(
                'gid',
                'gname',
                'gtitle',
                'gscore',
                'introduce',
                'ctime',
                'gpic',
                'gthumb'
        )
    );

   
}

?>