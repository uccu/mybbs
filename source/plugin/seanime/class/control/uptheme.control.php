<?php
namespace plugin\seanime\control;
defined('IN_PLAY') || exit('Access Denied');
class uptheme extends \control{
    private $listField;
    function _beginning(){
        //if(stripos($_SERVER["HTTP_REFERER"], $this->g->config['BASE_URL'])!==0)$this->error();
    }
    protected function _get_model(){
        return model('seanime:seanime_theme');
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
    function aid($aid){
        if(!$aid)$this->error('无参数 : aid');
        $ainfo = $this->model->find($aid);
        if(!$ainfo)$this->error('无数据');
		$this->user->_safe_right(8);
        $user = (array)$this->user;
        $t = template();
        $g = (array)table('config');
        include $t;
    }
    function _nomethod(){
        $this->error();
    }
}

?>