<?php
namespace plugin\article\model;
defined('IN_PLAY') || exit('Access Denied');
class article extends \model{
    protected $tableMap = array(
        'article'=>array(
                'aid',
                'atype',
                'athumb',
                'amedia',
                'actime',
                'atitle',
                'adescription'
        )
    );
    
   
}

?>