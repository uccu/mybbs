<?php
namespace plugin\project\model;
defined('IN_PLAY') || exit('Access Denied');
class project_link_product extends \model{
    protected $tableMap = array(
        'project_link_product'=>array(
                
                'did',
                'jid',

                
        )
    );
    public $productMap = array(
        'product'=>array(
                'dthumb',
                'dname',
                'dpic',
                'dctime',
                'introduction',
                'fealture',
                'effect',
                'purchase',
                '_on'=>'did'
        )
    );
    
   
}

?>