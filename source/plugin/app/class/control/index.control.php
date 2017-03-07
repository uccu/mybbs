<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class index extends base\e{//运维
    function _beginning(){
		$this->g->template['title'] = '运维卫士--设备问诊与咨询专业服务平台';
        T();
    }

    



}
?>