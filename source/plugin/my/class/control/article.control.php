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
        $n = preg_replace_callback('/\{(?:(center):)?img:([0-9]{1,2})\/([a-z0-9]{16})\.(jpg|png|gif):\}/i',function($e){
            return '<p><img src="s'.$e[2].'/'.$e[3].'.'.$e[4].'" class="img-responsive '.($e[1]?'center-block':'').'" /></p>';
        },$n);
        $ae = array();
        $callback = function($e) use (&$ae){
            if($e[5] && $ae){
                $c = substr_count($e[0],$e[6]);$d = $e[5];
                for($i=0;$i<$c;$i++){
                    $o = end($ae);
                    unset($ae[array_search($o,$ae)]);
                    $d .= "</$o>";
                }
                return $d;
            }else{
                if($e[1]){
                    $k='';
                    while(array_search('p',$ae)!==false){
                        $o = end($ae);
                        unset($ae[array_search($o,$ae)]);
                        $k .= "</$o>";
                    }
                    $p = $e[1];
                    if($e[2]=='pre'){
                        $o = $ae[] = $e[2];
                        $k.="<$o class=\"text-$p\" ";
                    }else{
                        $ae[] = 'p';
                        $o = $ae[] = $e[2];
                        $k.="<p class=\"text-$p\"><$o ";
                    }
                }else{
                    $o = $ae[] = $e[2];
                    $k = "<$o ";
                }
                if($e[3]){
                    $k .='style="'.$e[3].':'.$e[4].'"';
                }
                return $k.'>';
            }
        };
        
        $n = preg_replace_callback(
            '#\{(?:(center|left|right|justify|nowrap):)?(strong|code|pre|mark|del|u|small|big|em)(?:\[(color|font-size)=([\#a-z0-9]+)\])?:|([^-])(:\})+#i',
            $callback,$n);
        while($ae){
            $o = end($ae);
            unset($ae[array_search($o,$ae)]);
            $n .= "</$o>";
        }  
          
        "{color:#fff:}";
        "{size:px:}";
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