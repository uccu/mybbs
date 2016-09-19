<?php
namespace plugin\project\model;
defined('IN_PLAY') || exit('Access Denied');
class store_info extends \model{
    protected $tableMap = array(
        'store_info'=>array(
                'sid',
                'sthumb',
                'sname',
                'address',
                'area',
                'phone',
                
        )
    );
    
   
}

?>