<?php
namespace plugin\user\model;
defined('IN_PLAY') || exit('Access Denied');
class user_info extends \model{
    protected $tableMap = array(
        'user_info'=>array(
                'uid',
                'uanme',
                'lname',
                'password',
                'lasttime',
                'ip',
                'right',
                'avatar',
                'salt',
                'email',
                'createtime',
                'mark',
        )
    );

   
}

?>