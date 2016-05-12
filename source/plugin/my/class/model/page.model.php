<?php
namespace plugin\my\model;
defined('IN_PLAY') || exit('Access Denied');
class page extends \model{
    protected $tableMap = array(
        'aid'=>'a',
        'title'=>'h',
        'summary'=>'u',
        'description'=>'d',
        'ctime'=>'c',
        'display'=>'s',
        'type'=>'t'
    );
    
}


?>