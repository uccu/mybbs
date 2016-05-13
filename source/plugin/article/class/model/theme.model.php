<?php
namespace plugin\article\model;
defined('IN_PLAY') || exit('Access Denied');
class theme extends \model{
    protected $tableMap = array(
        'theme'=>array(
                'tid',
                'tname',
                'tctime',
                'torder'
        )
    );
    
   
}

?>