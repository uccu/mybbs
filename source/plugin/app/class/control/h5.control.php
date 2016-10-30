<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class h5 extends base\e{
    function _beginning(){
        //$this->_check_login();
    }

    function shuoming($id=0){
        $id = post('id',$id,'%d');
        $this->g->template['value'] = model('user_instruction')->where(array('type'=>$id))->get_field('instruction');
        T('tool:static');
    }

    function tequan($id=0){
        $id = post('id',$id,'%d');
        $this->g->template['value'] = model('user_instruction')->where(array('type'=>$id))->get_field('title');
        T('tool:static');
    }

    function banner($id=0){
        $id = post('id',$id,'%d');
        $this->g->template['value'] = model('banner')->find($id,false)->get_field('content');
        T('tool:static');
    }


    function top($id=0){
        $id = post('id',$id,'%d');
        $this->g->template['value'] = model('top_line')->find($id,false)->get_field('content');
        T('tool:static');
    }
    
    function vip($id=1){
        $id = post('id',$id,'%d');
        $this->g->template['value'] = model('member')->find($id,false)->get_field('content');
        T('tool:static');

    }

    function sale($id=0){
        $id = post('id',$id,'%d');
        $this->g->template['value'] = model('member')->find($id,false)->get_field('details');
        T('tool:static');
    }


    function index(){

        T('app:index');

    }

}
?>