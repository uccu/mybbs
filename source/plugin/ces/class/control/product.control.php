<?php
namespace plugin\ces\control;
defined('IN_PLAY') || exit('Access Denied');
class product extends \control\ajax{
	public function _beginning(){
        $this->user = control('ces:user');
    }

	public function get_product_info($pid=0){
		$this->user->_safe_login();
        $pinfo = model('product_info','api')->get_product($pid);
        $ginfo = model('progress','api')->_get_progress_by_pid($pid);
        
	}
    public function get_my_product_list(){
		$this->user->_safe_login();
        
	}
    //public function get_product_list_by_user($uid=0){
		
        
	//}
    public function get_product_list(){
		$this->user->_safe_login();
        
	}
    public function get_all_product_list(){
		$this->user->_safe_admin();
        
	}
    public function get_deleted_product_list(){
		
        
	}
	public function clean_product(){
		
        
	}
    public function change_product($pid=0){
		
        
	}
    public function release_product(){
        
        
    }
    public function get_my_claim_product(){
		
        
	}
   
}


?>