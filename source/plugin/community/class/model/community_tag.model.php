<?php
namespace plugin\community\model;
defined('IN_PLAY') || exit('Access Denied');
class thread_link_tag extends \model{
    protected $tableMap = array(
        'community_tag'=>array(
                'tid',
                'tname',
                'torder',
        )
    );

   
}

?>