<?php
namespace plugin\weixin\control;
defined('IN_PLAY') || exit('Access Denied');
class app extends \control{
    
/*
    set subnav

*/    
    function pinpai($m,$a,$b){
        $c = control(METHOD_NAME);
        $m = '_app_'.$m;
        if(method_exists($c,$m))$c->$m($a,$b);
        else header('Location: /404.html');
    }
    function shili($m,$a,$b){
        $c = control(METHOD_NAME);
        $m = '_app_'.$m;
        if(method_exists($c,$m))$c->$m($a,$b);
        else header('Location: /404.html');
    }
    function hudong($m,$a,$b){
        $c = control(METHOD_NAME);
        $m = '_app_'.$m;
        if(method_exists($c,$m))$c->$m($a,$b);
        else header('Location: /404.html');
    }
    function up(){
        return control('hudong')->up();
    }
  
}