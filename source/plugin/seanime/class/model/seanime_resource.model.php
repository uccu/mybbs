<?php
namespace plugin\seanime\model;
defined('IN_PLAY') || exit('Access Denied');
class seanime_resource extends \model{
    protected $tableMap = array(
        'seanime_sources'=>array(
                'sid',
                'aid',
                'subtitle',
                'sname',
                'sdes',
                'sloc',
                'sloc_type',
                'hash',
                'base32',
                'suid',
                'size',
                'whole',
                'pw',
                'stimeline',
                'order',
                'quality',
                'show',
                'sktimeline',
                'skuid',
                'sdtype',
                'sshowtimes',
                'sdowntimes',
                'outlink',
                'outstation'
        )
    );
    public $foreignTagTable = array(
         'seanime_sources'=>array('subtitle','sname','sloc_type','size','stimeline','sdtype','outstation','outlink','_on'=>'sid')
     );
    
   
}

?>