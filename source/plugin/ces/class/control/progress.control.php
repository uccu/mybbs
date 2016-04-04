<?php
namespace plugin\ces\control;
defined('IN_PLAY') || exit('Access Denied');
class progress extends \control\ajax{
    public function _add_progress(){
		
        
	}
    public function _safe_team($team,$pid){
		
        
	}
    
    
	public function _beginning(){
        $this->user = control('ces:user');
        $this->claim = control('ces:claim');
    }

	public function change_progress(){
		$this->user->_safe_login();
        $this->user->_safe_type(2);
        $this->claim->_safe_my_claim($pid,$type);
        
	}
    public function get_progresses($pid=0){
		
        
	}
    

   
}


?>