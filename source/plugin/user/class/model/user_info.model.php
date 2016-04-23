<?php
namespace plugin\user\model;
defined('IN_PLAY') || exit('Access Denied');
class user_info extends \model{
    protected $tableMap = array(
        'user_info'=>array(
                'uid',
                'username'=>'uname',
                'loginname'=>'lname',
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
    public $tableMap_hash = array(
        'user_info'=>array(
                'username'=>'uname',
                'right',
                '_on'=>'uid'
        )
        
    );
   
}

?>