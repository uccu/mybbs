<?php
namespace plugin\user\model;
defined('IN_PLAY') || exit('Access Denied');
class score_setting extends \model{
    protected $tableMap = array(
        'score_setting'=>array(
                'name',
                'score',
                'type',
                'stimes',
                'desc'
        )
    );
    function score($name){
        return $this->where(array('name'=>$name))->get_field('score');
    }
   
}

?>