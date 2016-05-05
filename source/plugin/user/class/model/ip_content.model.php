<?php
namespace plugin\user\model;
defined('IN_PLAY') || exit('Access Denied');
class ip_content extends \model{
    protected $tableMap = array(
        'ip_content'=>array(
                'id',
                'ip',
                'type',
                'time'
        )
    );
    
   
}

?>