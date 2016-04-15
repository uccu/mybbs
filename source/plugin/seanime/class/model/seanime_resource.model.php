<?php
namespace plugin\seanime\model;
defined('IN_PLAY') || exit('Access Denied');
class seanime_resource extends \model{
    protected $tableMap = array(
        'seanime_resource'=>array(
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
    protected $tableMap2 = array(
         'seanime_resource'=>array(
                'sid',
                'aid',
                'subtitle',
                'sname',
                'sloc',
                'sloc_type',
                'size',
                'pw',
                'stimeline',
                'show',
                'sdtype',
                'outlink',
                'outstation'
         )
     );
    
   
}

?>