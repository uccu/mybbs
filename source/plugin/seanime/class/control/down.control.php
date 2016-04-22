<?php
namespace plugin\seanime\control;
defined('IN_PLAY') || exit('Access Denied');
class down extends \control{
    function _beginning(){
        
        
        
    }
    function thunder($sid=0,$time){
        $m = model('seanime_resource');
        $where['sid'] = $sid;
        $where['stimeline'] = $time;
        $hash = $m->where($where)->get_field('hash');
        $hash = strtoupper($hash);
        $r1 = substr($hash,0,2);
		$r2 = substr($hash,38,2);
		header("Location: http://bt.box.n0808.com/".$r1."/".$r2."/".$hash.".torrent");
    }
    function straight($sid=0,$time){
        $m = model('seanime_resource');
        $where['sid'] = $sid;
        $where['stimeline'] = $time;
        $t = $m->where($where)->get_field('sloc');
		header("Location: ".$t);
    }
    
    
    function nomethod(){
        
        
    }
}

?>