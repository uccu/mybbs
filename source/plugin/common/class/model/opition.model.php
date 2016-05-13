<?php
namespace plugin\common\model;
defined('IN_PLAY') || exit('Access Denied');
class opition extends \model{
    protected $tableMap = array(
        'common_opition'=>array(
                'name',
                'content',
        )
    );
    
   
}

?>