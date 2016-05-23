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
                'sid',
                
        )
    );
    public $expertMap = array(
        'expert_info'=>array(
            'ename',
            '_on'=>'eid'
        )
    );
    public $storeMap = array(
        'store_info'=>array(
            'sname',
            'address',
            'phone'=>'sphone',
            '_on'=>'sid'
        ) 
    );
    public $userMap = array(
        'user_info'=>array(
            'adviser',
            '_on'=>'uid'
        ) 
    );
   
}

?>