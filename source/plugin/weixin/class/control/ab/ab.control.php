<?php
namespace plugin\weixin\control\ab;
defined('IN_PLAY') || exit('Access Denied');
abstract class ab extends \control\ajax{
    abstract protected function _get_map();
    function __construct(){
        call_user_func_array(array(parent,'__construct'),func_get_args());
        if(!$this->user->uid)header('Location:/weixin/login');
        $first = reset($this->map);
        $this->g->template['subnav'] = "<script>subnav(".json_encode($this->map).",'".array_search($first,$this->map)."');</script>";
    }
    protected function _get_user(){
        return control('user:base','api');
    }
    protected function _get_opition(){
        return model('common:opition');
    }
    protected function save_opition($name){
        $array['name'] = $name;
        $array['content'] = post('content','',array($this,'_toraw'));
        return $this->opition->data($array)->add(true);
    }
    function _toraw($data){
        if(!is_string($data))return $data;
        return str_ireplace(array('&lt;','&gt;','&quot;','&#39;'),array('<','>','"',"'"),$data);
    }
    protected function get_opition($name,$find = false){
        if($find)return $this->opition->find($name);
        return $this->opition->find($name,0)->get_field('content');
    }
}