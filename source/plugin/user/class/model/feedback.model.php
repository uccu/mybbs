<?php
namespace plugin\user\model;
defined('IN_PLAY') || exit('Access Denied');
class feedback extends \model{
    protected $tableMap = array(
        'feedback'=>array(
                'id',
                'uid',
                'content',

        )
    );

   
}

?>