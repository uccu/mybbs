<?php
namespace plugin\app\control;
defined('IN_PLAY') || die('Access Denied');
class actually extends api\ajax{
    function _beginning(){
        
    }
    
    function index($cid){
        $c = model('contest')->find($cid);
        $this->g->template['contest'] = &$c;
        
        if(!$c)header('Location:404.html');
        $c['date'] = date('Y-m-d H:i:s');
        $this->g->template['title'] = $c['title'];
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = $c['description'];
        T();
    }
    
}




?>