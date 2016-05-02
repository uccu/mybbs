<?php
namespace plugin\seanime\control;
defined('IN_PLAY') || exit('Access Denied');
class playbill extends \control{
    function _beginning(){
        if(stripos($_SERVER["HTTP_REFERER"], $this->g->config['BASE_URL'])!==0)$this->error();
        $time =time();$today = strtotime(date('Y-m-d'));
        $where2['utime'] = array('logic',$time-3600*24*14,'>');
        $playbill = $this->theme->where($where2)->order('utime')->limit(999)->select();
        $playbill_14 = $playbill_7 = $playbill_24 = array(array(),array(),array(),array(),array(),array(),array());
        $na = array("日","一","二","三","四","五","六");
        foreach ($playbill as $v){
            
            $w = date('w',$v['utime']);
            if($v['utime']<$today-3600*24*7){
                $playbill_14[$w][] = $v;
                
            }elseif($v['utime']<$time-3600*24){
                $playbill_7[$w][] = $v;
            }
            else $playbill_24[$w][] = $v;
        }
        $w = date('w');
        $t = template();
        $g = (array)table('config');
        include $t;
        
        
        
        
        
    }
    protected function _get_g(){
        return table('config');
    }
    protected function _get_theme(){
        return model('seanime:seanime_theme');
    }
    
}

?>