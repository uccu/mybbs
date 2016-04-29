<?php
namespace plugin\seanime\model;
defined('IN_PLAY') || exit('Access Denied');
class seanime_resource_tag extends \model{
    protected $tableMap = array(
        'seanime_resource_name_tag'=>array(
                'sid',
                'tag',

        )
    );
    public $tableMapx = array('seanime_sources'=>array('aid','_on'=>'sid'));
    

    
    
    
    
}

?>