<?php
namespace plugin\seanime\model;
defined('IN_PLAY') || exit('Access Denied');
class seanime_theme extends \model{
    protected $tableMap = array(
        'seanime_theme'=>array(
                'aid',
                'name',
                'newname',
                'remark',
                'ctime',
                'show',
                'lastnum',
                'utime',
                'matchs',
                'zh_tag',
                'en_tag',
                'loma_tag',
                'jp_tag'
        )
    );
    
}

?>