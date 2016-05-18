<?php
namespace plugin\project\model;
defined('IN_PLAY') || exit('Access Denied');
class project extends \model{
    protected $tableMap = array(
        'project'=>array(
                "jid",
                "jthumb",
                "jname",
                "jpic",
                "introduction",
                "expert",
                "fealture",
                "attention",
                "jctime"
        )
    );
    
   
}

?>