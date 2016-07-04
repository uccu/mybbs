<?php
namespace plugin\testadmin\control\na;
use plugin\adminloader\control\lib\base;
defined('IN_PLAY') || exit('Access Denied');
abstract class ba extends base{
    protected function _get_nav(){
        control('app:base','api')->_safe_type(3);
        return array(
            'index'=>'首页',
            'user'=>'用户',
            'team'=>'团队',
            'contest'=>'赛事',
            'character'=>'角色',
            'album'=>'相册',
            'video'=>'视频',
            'picture'=>'图片',
            //'blog'=>'blog',
            //'permission'=>'权限',
        );
        
    }
    abstract protected function _get_defaultMethod();
    function _nomethod(){
        $this->_header($this->defaultMethod);
    }
    protected function _get_name(){
        return '炫漫';
    }
    protected function _get_subname(){
        return '后台';
    }
    protected function _beginning(){
        
    }
    function _add($m,$addTime=false){
        if($addTime)$_POST['ctime'] = TIME_NOW;
        return model($m)->data($_POST)->add();
    }
    function _save($m,$id,$allowAdd=false,$addTime=false){
        if($allowAdd && !$id)return $this->_add($m,$addTime);
        else $p = model($m)->data($_POST)->save($id);
        return $p;
    }
    function _remove_suffix($z=''){
        while(preg_match('/(\.[a-z]+)$/i',$z,$t)){
            $z = str_ireplace($t[1],'',$z);
        }
        return $z;
    }
    function _detail($callback,$m,$id){
        if(is_null($id))$this->_header($callback);
        $info = model($m)->find($id);
        $this->g->template['id'] = $info ? reset($info) : 0;
    }
    function _del($m,$id){
        if(!$id)$this->error(400,'no data');
        return model($m)->remove($id);
    }
    protected function _header($s){
        header('Location:/'.PLUGIN_NAME.'/'.CONTROL_NAME.'/'.$s);die();
    }
    
    function _get_userInfo(){
        return model('app:UserInfo');
    }

}