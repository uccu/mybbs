<?php
namespace plugin\my\control;
defined('IN_PLAY') || exit('Access Denied');
use \control;
class e extends control{
    function _beginning(){
        //session_set_cookie_params ( 0 ,'/' ,'.'.$this->g->config['HOST'] );
        //session_name('baka');
        //session_start();
        //echo session_id ();
        $this->g->template['baseurl'] = 'http://a.baka/my/e';
        //echo json_encode((object)array());
        T();
        
    }
    
    
    
}


?>