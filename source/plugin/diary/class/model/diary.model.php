<?php
namespace plugin\diary\model;
defined('IN_PLAY') || exit('Access Denied');
class diary extends \model{
    protected $tableMap = array(
        'diary'=>array(
                'did',
                'uid',
                'type',
                'reply',
                'ctime',
                'otime',
                'title',
                'content',
                'pic',
                'last_pic',
                'suggest',
                'new',
        )
    );
    public $userMap = array(
        'user_info'=>array(
            '_on'=>'uid',
            'nickname',
            'phone'
        )
    );
   
}

?>