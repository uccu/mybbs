<?php
namespace plugin\testadmin\control;
use plugin\adminloader\control\lib\base;
defined('IN_PLAY') || exit('Access Denied');
class index extends base{
    protected function _get_subnav(){
        return array(
            'dd'=>'test',
            'dd2'=>'测试2'
        );
    }
    protected function _get_nav(){
        return array(
            'index'=>'主页',
            'list'=>'列表'
        );
    }
    protected function _get_name(){
        return '炫漫';
    }
    protected function _get_subname(){
        return '后台';
    }
    protected function _beginning(){
        
    }
    function _nomethod(){
        $this->dd();
    }
    function dd(){
        $this->_init();
        //$this->g->template['subnav'] = '';
        T();
    }
    function dd2(){
        $this->_init();
        //$this->g->template['subnav'] = '';
        T();
    }


}