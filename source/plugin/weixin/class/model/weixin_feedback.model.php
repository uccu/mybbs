<?php
namespace plugin\weixin\model;
defined('IN_PLAY') || exit('Access Denied');
class weixin_feedback extends \model{
    protected $tableMap = array(
        'weixin_feedback'=>array(
                'fid',
                'name',
                'phone',
                'age',
                'sex',
                'content',
                'ftime'
        )
    );

   
}

?>