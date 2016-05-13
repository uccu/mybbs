<?php
namespace plugin\my\control;
defined('IN_PLAY') || exit('Access Denied');
class article extends \control\ajax{
    function _beginning(){

    }
    function _get_model(){
        return model('my:article');
    }
    private function unseri(&$n){
        $n = preg_replace('/\{img:([^\}]+):\}/i','<img src="$1" class="img-responsive" />',$n);
        
        "{b:string:}";'<strong>string</strong>';
        "{color=#fff:}";
        "{size=20px:}";
        "{center:}";
        
    }
    function aid($aid){
        $m = $this->model;
        if(!$f = $m->find($aid))$this->error('401','no article');
        $f['date'] = date('Y-m-d H:i:s',$f['ctime']);
        $f['passage'] = explode('\n',$f['description']);
        foreach($f['passage'] as &$n){
            $this->unseri($n);
        }
        
        
        
        $this->g->article = $f;
        
        
        
        
        T();
    }
    function _nomethod(){
        $this->error('401','no article');
        
    }
}


?>