<?php
namespace plugin\seanime\control;
defined('IN_PLAY') || exit('Access Denied');
class upload extends \control{
    private $listField;
    function _beginning(){
        if(stripos($_SERVER["HTTP_REFERER"], $this->g->config['BASE_URL'])!==0)$this->error();
    }
    protected function _get_model(){
        return model('seanime:seanime_resource');
    }
    function _get_sort(){
        return model('seanime:seanime_sort');
    }
    protected function _get_g(){
        return table('config');
    }
    function _get_user(){
        return control('user:base','api');
    }
    function sid($sid){
        if(!$sid)$this->error('无参数 : sid');
        $sinfo = $this->model->find($sid);
        if(!$sinfo)$this->error('无数据');
		if($this->user->right<8 && $this->user->uid!=$sinfo['suid'])$this->error('无权限');
        $sd = $this->sort->sdtype;
        $user = (array)$this->user;
        $t = template();
        $g = (array)table('config');
        include $t;
    }
    function _nomethod(){
        $sd = $this->sort->sdtype;
        $this->user->uid;
        $user = (array)$this->user;
        $t = template();
        $g = (array)table('config');
        include $t;
    }
}

?>