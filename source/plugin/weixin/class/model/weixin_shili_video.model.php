<?php
namespace plugin\weixin\model;
defined('IN_PLAY') || exit('Access Denied');
class weixin_shili_video extends \model{
    protected $tableMap = array(
        'weixin_shili_video'=>array(
                'aid',
                'athumb',
                'actime',
                'adescription',
                'atitle'
        )
    );

   
}

?>