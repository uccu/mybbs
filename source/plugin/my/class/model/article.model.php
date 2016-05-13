<?php
namespace plugin\my\model;
defined('IN_PLAY') || exit('Access Denied');
class article extends \model{
    protected $tableMap = array(
        'article'=>array(
            'aid',
            'title',
            'summary',
            'description',
            'ctime',
            'display',
            'type'
        )
    );
    
}


?>