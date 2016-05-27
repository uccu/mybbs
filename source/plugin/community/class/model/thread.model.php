<?php
namespace plugin\community\model;
defined('IN_PLAY') || exit('Access Denied');
class thread extends \model{
    protected $tableMap = array(
        'thread'=>array(
                'hid',
                'uid',
                'reply',
                'ctime',
                'title',
                'content',
                'pic',
                'last',
                'favo',
                'reply_num',
        )
    );
    public $userMap = array(
        'user_info'=>array(
            'nickname','avatar','_on'=>'uid','phone'
            
            
        )
        
        
    );
   
}

?>