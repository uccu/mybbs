<?php
namespace plugin\tool\control;
defined('IN_PLAY') || exit('Access Denied');
class other extends \control\ajax{
    function _beginning(){

    }
    function _get_area(){
        return model('tool:area');
    }
    function get_area(){
        $province = post('province');
        $city = post('city');
        $gg = array();$ge = array();$r = 0;
        if($province){
            $m = $this->area->field('DISTINCT city')->where(array('province'=>$province))->order(array('province','city','district'))->limit(9999)->select();
            foreach($m as &$v)$v = $v['city'];
        }
        elseif($city){
            $m = $this->area->field(array('district'))->where(array('city'=>$city))->order(array('province','city','district'))->limit(9999)->select();
            foreach($m as &$v)$v = $v['district'];
        }else{
            $m = $this->area->field('DISTINCT province')->order(array('province','city','district'))->limit(9999)->select();
            foreach($m as &$v)$v = $v['province'];
        }
        $this->success($m);
    }
    
}
?>