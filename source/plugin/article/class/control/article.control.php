<?php
namespace plugin\article\control;
defined('IN_PLAY') || exit('Access Denied');
class article extends \control\ajax{
    function _beginning(){
        //$this->user->_safe_login();
    }
    function _get_user(){
        return control('user:base','api');
    }
    function _get_model(){
        return model('article:article');
    }
    function get_article_list($type=-1){
        $limit = post('limit',6,'%d');
        $where['atype'] = $type==-1 ? array('logic',0,'!=') : $type;
        $line = post('actime',0,'%d');
        if($line)$where['actime'] = array('logic',$line,'<');
        $m = $this->model->field(array('aid','athumb','atitle'))->where($where)->order('actime','DESC')->limit($limit)->select();
        $this->success($m);
    }
    function article($aid){
        $m = $this->model->find($aid);
        if(!$m)$this->error('未找到文章');
        $this->g->title = $m['atitle'];
        $this->g->media = $m['amedia'];
        $this->g->description = $m['adescription'];
        T();
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>