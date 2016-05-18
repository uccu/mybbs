<?php
namespace plugin\project\model;
defined('IN_PLAY') || exit('Access Denied');
class reservation extends \model{
    protected $tableMap = array(
        'reservation'=>array(
                'rid',
                'uid',
                'eid',
                'name',
                'phone',
                'time',
                
        )
    );
    
   
}

?>