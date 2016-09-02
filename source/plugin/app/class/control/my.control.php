<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class home extends base\basic{
    private $out = true;
    function _beginning(){
        


    }


    function info(){

        $q['myInfo'] = array();
        $this->success($q);
    }
    function has_message(){

        $this->success($q);
    }


    function remind(){
        
    }
    function add_address(){

    }
    function default_address(){

    }
    function address_list(){

    }
    function rank_gou(){

    }
    function rank_xiang(){

    }
    function rank_bang(){

    }

    function rank_dou(){

    }
    function coin(){


    }
    function coin_custom(){//获取余额明细

    }
    function cash(){

    }
    function my_cash(){

    }
    function score_shop(){

    }
    function score_custom(){

    }
    function get_message(){


    }
    function close_push(){

    }
    function open_push(){
        
    }


    function avatar(){

    }

    function username(){

    }
    function sex(){

    }

    function birth(){

    }

    function sign_detail(){

    }

    function sign(){
 
    }

    function prize_list(){

    }
    function my_collect(){
        
    }

}
?>