<?php
namespace plugin\seanime\model;
defined('IN_PLAY') || exit('Access Denied');
class seanime_sort extends \model{
    protected $tableMap = array(
        'seanime_sort'=>array(
                'id',
                'name',
                'code',
                'type'
        )
    );
    function _get_sdtype(){
        return $this->where(array('type'=>1))->limit(888)->select('code');
    }
    function _get_ltype(){
        return $this->limit(888)->select('code');
    }
    
}

?>