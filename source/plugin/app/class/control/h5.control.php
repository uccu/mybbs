<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class h5 extends base\e{
    function _beginning(){
        //$this->_check_login();
    }

    function shuoming($z=0){
        $this->g->template['value'] = model('user_instruction')->where(array('type'=>$z))->get_field('instruction');
        T('tool:static');
    }

    function tequan($z=0){
        $this->g->template['value'] = model('user_instruction')->where(array('type'=>$z))->get_field('title');
        T('tool:static');
    }

    function banner($id=0){
        $this->g->template['value'] = model('banner')->find($id,false)->get_field('content');
        T('tool:static');
    }


    function top($id=0){
        $this->g->template['value'] = model('top_line')->find($id,false)->get_field('content');
        T('tool:static');
    }
    
    function vip($id=1){
        $this->g->template['value'] = model('member')->find($id,false)->get_field('content');
        T('tool:static');

    }

    function sale($id=0){
        $this->g->template['value'] = model('member')->find($id,false)->get_field('details');
        T('tool:static');
    }


}
?>