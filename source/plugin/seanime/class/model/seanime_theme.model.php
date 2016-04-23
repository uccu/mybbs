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
                'matchs'
        )
    );
    
}

?>