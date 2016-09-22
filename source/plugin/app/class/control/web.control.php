<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class web extends \control{
    
    function _beginning(){
        $rand = model('anli')->where(array('tid'=>3))->limit(3)->order('rand()')->select();
        if(count($rand)<3){
            $rand2 = model('anli')->limit(3-count($rand))->order('rand()')->select();
            $rand = array_merge($rand,$rand2);
        }
        $this->g->template['rand'] = $rand;
        T();
    }

    


}