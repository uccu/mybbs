<?php
namespace plugin\weixin\model;
defined('IN_PLAY') || exit('Access Denied');
class weixin_pinpai_coverage extends \model{
    protected $tableMap = array(
        'weixin_pinpai_coverage'=>array(
                'aid',
                'athumb',
                'actime',
                'adescription',
                'atitle'
        )
    );

   
}

?>