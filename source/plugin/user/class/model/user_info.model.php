<?php
namespace plugin\user\model;
defined('IN_PLAY') || exit('Access Denied');
class user_info extends \model{
    protected $tableMap = array(
        'user_info'=>array(
                'uid',
                'avatar',
                'nickname',
                'name',
                'sex',
                'age',
                'area',
                'marry',
                'child',
                'plastic',
                'email',
                'work',
                'phone',
                'interest',
                'score',
                'ctime',
                'user_type',
                'salt',
                'last_time',
                'ip',
                'password',
                'invate',
                'invate_num',
                'adviser',
                'diary'
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