<?php
namespace plugin\tool\model;
defined('IN_PLAY') || exit('Access Denied');
class qa extends \model{
    protected $tableMap = array(
        'qa'=>array(
                'qid',
                'title',
                'des'

        )
    );
    
   
}

?>