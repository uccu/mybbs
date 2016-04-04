<?php
namespace plugin\ces\control;
defined('IN_PLAY') || exit('Access Denied');
class claim extends \control\ajax{
    public function _safe_my_claim($pid,$type=false){
        
        
        
    }
    
    
    
    
    
    
    
	public function _beginning(){
        $this->user = control('ces:user');
    }

	public function claim_product(){
		$this->user->_safe_login();
        $this->user->_safe_type(2);
        //如果product不是共有，则需要验证是否在组

        
	}
    public function finish_claim(){
		$this->user->_safe_admin();
        $this->user->_safe_type(3);
        //如果product不是共有，则需要验证是否在组
        
	}
    public function cancel_claim(){
		$this->user->_safe_admin();
        $this->user->_safe_type(3);
        //如果product不是共有，则需要验证是否在组 
	}


   
}


?>