<?php
namespace plugin\project\model;
defined('IN_PLAY') || exit('Access Denied');
class project_link_store extends \model{
    protected $tableMap = array(
        'project_link_store'=>array(
                '_mapping'=>'pls',
                'sid',
                'jid',

                
        )
    );
    public $store = array(
        'store_info'=>array(
                '_mapping'=>'s',
                'sthumb',
                'sname',
                'address',
                'area',
                'phone',
                '_on'=>'sid'
        )
    );
    
   
}

?>