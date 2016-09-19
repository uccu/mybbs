<?php
namespace plugin\project\model;
defined('IN_PLAY') || exit('Access Denied');
class expert_info extends \model{
    protected $tableMap = array(
        'expert_info'=>array(
                'eid',
                'sid',
                'ethumb',
                'ename',
                'desc',
                'good',
                
        )
    );
    
   
}

?>