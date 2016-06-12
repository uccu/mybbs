<?php
namespace plugin\app\model;
defined('IN_PLAY') || die('Access Denied');
class Follow extends \model{
    protected $tableMap = array(
        'follow'=>array(
            'fid','uid','following'
        ),
    );
    


}
?>