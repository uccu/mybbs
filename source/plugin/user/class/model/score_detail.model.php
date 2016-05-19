<?php
namespace plugin\user\model;
defined('IN_PLAY') || exit('Access Denied');
class score_detail extends \model{
    protected $tableMap = array(
        'score_detail'=>array(
                'id',
                'uid',
                'type',
                'desc',
                'stime',
                'score',
        )
    );

   
}

?>