<?php
namespace plugin\tool\model;
defined('IN_PLAY') || exit('Access Denied');
class area extends \model{
    protected $tableMap = array(
        'area'=>array(
                'id',
                'province',
                'city',
                'district',
        )
    );
    
   
}

?>