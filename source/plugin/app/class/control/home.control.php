<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class home extends base\basic{
    
    function _beginning(){
        


    }

    function get_c($rank,$c,$k){
        $a = $k*0.1;
        $b = array(0.1,0.2,0.3,0.4);
        if($k==4)$b = array(0.1,0.2,0.3,0.3,0.1);
        $rank = floor($rank);
        if($rank==1)return ($c*$a*$b[0]);
        $rankz = $rank;
        for($i=0;$i<4;$i++){
            $rankz -= pow(10,$i);
            if($rankz>pow(10,$i+1))continue;
            if($rankz<=pow(10,$i+1)*0.1){
                return floor($c*$a*$b[$i+1]*0.2/(pow(10,$i+1)*0.1));
            }elseif($rankz<=pow(10,$i+1)*0.3){
                return floor($c*$a*$b[$i+1]*0.3/(pow(10,$i+1)*0.2));
            }elseif($rankz<=pow(10,$i+1)*0.6){
                return floor($c*$a*$b[$i+1]*0.3/(pow(10,$i+1)*0.3));
            }else{
                return floor($c*$a*$b[$i+1]*0.2/(pow(10,$i+1)*0.4));
            }
        }
        return 0;
    }
    function get($rank,$c){
        echo $this->get_c($rank,$c,4);
    }
    
}
?>