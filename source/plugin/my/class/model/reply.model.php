<?php
namespace plugin\my\model;
defined('IN_PLAY') || exit('Access Denied');
class reply extends \model{
    protected $tableMap = array(
        'reply'=>array(
            'rid',
            'aid',
            'email',
            'nickname',
            'website',
            'rctime',
            'rdisplay',
            'content'
        )
    );
    protected $auto = array(
        'rid'=>false,
        'rctime'=>TIME_NOW
    );
    function add_articleMap(){
        return $this->add_table(array(
            'article'=>array(
                'title',
                'summary',
                'description',
                'ctime',
                'display',
                'type',
                'reply_count',
                '_on'=>'aid'       
            )
        ));
    }
}


?>