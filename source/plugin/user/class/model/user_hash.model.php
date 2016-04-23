<?php
namespace plugin\user\model;
defined('IN_PLAY') || exit('Access Denied');
class user_hash extends \model{
    protected $tableMap = array(
        'user_hash'=>array(
                'uid',
                'hash'
        )
    );
    
   
}

?>