<?php
namespace plugin\tool\control;
defined('IN_PLAY') || exit('Access Denied');
class html extends \control\ajax{
    function hid($hid){
        $hid = post('hid',$hid,'%d');
        $info = model('rule_html')->find($hid);
        if(!$info){
            $info['remark'] = '';
            $info['content'] = '';
        }
        $this->g->template['title'] = $info['remark'];
        $this->g->template['content'] = $info['content'];
        T('hid');
    }


    


}
?>