<?php
namespace plugin\article\control;
defined('IN_PLAY') || exit('Access Denied');
class article extends \control\ajax{
    function _beginning(){
        
    }
    function _get_user(){
        return control('user:base','api');
    }
    function _get_model(){
        return model('article:article');
    }
    function get_list($type=-1){
        $this->user->_safe_login();
        $tt = post('type',-1,'%d');
        if($tt!=-1)$type = $tt;
        $limit = post('limit',6,'%d');
        $where['atype'] = $type==-1 ? array('logic',0,'!=') : $type;
        $line = post('actime',0,'%d');
        if($line)$where['actime'] = array('logic',$line,'<');
        $m = $this->model->field(array('aid','athumb','atitle','actime'))->where($where)->order('actime','DESC')->limit($limit)->select();
        $this->success($m);
    }
    function article($aid=0){
        $tt = post('aid',0,'%d');
        if($tt)$aid = $tt;
        $m = $this->model->find($aid);
        if(!$m)$this->error('未找到文章');
        $this->g->title = $m['atitle'];
        if($m['atype']==0) $this->g->media = $m['amedia'];
        else $this->g->pic = $m['amedia'];
        $this->g->description = $m['adescription'];
        if($tt)$this->success(array('url'=>'http://120.26.230.136:6087/article/article/article/'.$tt));
        T();
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>