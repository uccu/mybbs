<?php
namespace plugin\community\model;
defined('IN_PLAY') || exit('Access Denied');
class thread_link_tag extends \model{
    protected $tableMap = array(
        'thread_link_tag'=>array(
                'hid',
                'tid',
        ),
    );
    public $threadMap = array(
        'thread_link_tag'=>array(
                'uid',
                'reply',
                'ctime',
                'title',
                'content',
                'pic',
                'last',
                'favo',
                'reply_num',
                '_on'=>'hid'
        ),
        
    );
   
}

?>