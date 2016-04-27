<?php
namespace plugin\seanime\control;
defined('IN_PLAY') || exit('Access Denied');
class page extends \control{
    function _beginning(){
        
    }
    protected function _get_model(){
        return model('seanime:seanime_resource');
    }
    function sid($sid,$time){
        $table = array('seanime_theme'=>array('name','_on'=>'aid'));
        $table2 = array('user_info'=>array('username'=>'uname','_on'=>'seanime_sources.suid = user_info.uid'));
        $r = $this->model->add_table($table)->add_table($table2)->find($sid);
        //echo $r ;die();
        if(!$r||$time!=$r['stimeline'])$this->error();
        $r['date'] = date('Y-m-d H:i:s',$r['stimeline']);
        include template();
    }
}

?>