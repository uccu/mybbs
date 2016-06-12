<?php
namespace plugin\user\model;
defined('IN_PLAY') || exit('Access Denied');
class favourite extends \model{
    protected $tableMap = array(
        'favourite'=>array(
                'fid',
                'uid',
                'type',
                'jid',
                'did',
                'ftime',
                'hid',
                'aid'
        )
    );
    public $productMap = array(
        'product'=>array('_on'=>'did','dthumb','dname','dctime')
    );
    public $projectMap = array(
        'project'=>array('_on'=>'jid','jthumb','jname')
    );
    public $articleMap = array(
        'article'=>array('_on'=>'aid','athumb','atitle','actime')
    );
    public $threadMap = array(
        'thread'=>array('_on'=>'hid','title','pic','ctime','uid','last','favo','reply_num')
    );
}

?>