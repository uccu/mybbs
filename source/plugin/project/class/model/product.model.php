<?php
namespace plugin\project\model;
defined('IN_PLAY') || exit('Access Denied');
class product extends \model{
    protected $tableMap = array(
        'product'=>array(
                'did',
                'dthumb',
                'danme',
                'dpic',
                'introduction',
                'fealture',
                'effect',
                'purchase'
        )
    );
    
   
}

?>