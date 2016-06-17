<?php
namespace plugin\adminloader\control\lib;
defined('IN_PLAY') || exit('Access Denied');
abstract class base extends \control\ajax{
    abstract protected function _get_subnav();
    abstract protected function _get_nav();
    abstract protected function _get_name();
    abstract protected function _get_subname();
    function _init(){
        $this->_page_header();
        $this->_subnav();
    }
    function _get_baseurl(){
        return dirname($this->g->template['baseurl'])=='http:'?$this->g->template['baseurl']:dirname($this->g->template['baseurl']).'/';
    }
    function _page_header(){
        $this->g->template['pageHeader'] = '<div class="page-header"><h1>'.$this->name.'<small>'.$this->subname.'</small></h1></div>';
        $nav = '<ul class="nav nav-tabs t">';
        foreach($this->nav as $k=>$v){
            $k0 = end(explode('/',$k));
            $nav .= '<li role="presentation" class="nav_'.$k0.'"><a href="'.$this->baseurl.PLUGIN_NAME.'/'.$k.'">'.$v.'</a></li>';
        }
        $nav .= '</ul>';
        $this->g->template['nav'] = $nav;
    }
    function _subnav(){
        $this->g->template['subnav'] = "<script>subnav(".json_encode($this->subnav).",'".array_search(reset($this->subnav),$this->subnav)."');</script>";
    }
    


    
}