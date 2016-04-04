<?php
namespace plugin\ces\control;
defined('IN_PLAY') || exit('Access Denied');
class user extends \control\ajax{
    const LOGIN_SALT = 'gtiekFamdojga4owied7';
    const ADMIN_SALT = 'gtiekFamdojga4owied7';
    protected function _verify_login($cookie,$salt){
         if($s = cookie('login_secury'))if($s = substr($s,1))if($s = base64_decode($s))if($s = explode('|',$s)){
            list($uid,$type,$uname,$time,$md5) = $s;
            if(md5($uid . $type . $uname . $time . self::LOGIN_SALT) === $md5){
                $this->uid = $uid;
                $this->type = $type;
                $this->uname = $uname;
                return $uid;
            }
        }    
        return false;
    }
    protected function _get_login(){
       return $this->_verify_login('login_secury',self::LOGIN_SALT);
    }
    protected function _get_admin(){
       return $this->_verify_login('admin_secury',self::ADMIN_SALT);
    }
    protected function _get_type(){
        if($this->login || $this->admin)return $this->type;
        return 0;
    }
    protected function _get_uid(){
        if($this->login || $this->admin)return $this->uid;
        return 0;
    }
    protected function _get_uname(){
        if($this->login || $this->admin)return $this->uname;
        return '';
    }
    public function _safe_login(){
        if(!$this->login)$this->error('no login');
    }
    public function _safe_admin(){
        if(!$this->admin)$this->error('no admin login');
    }
    public function _safe_type($type=1){
        if($this->type < $type)$this->error('no permission');
    }
    public function _safe_utype($uid=0){
        $uinfo = $this->userModel->get_user_info($uid);
        if(!$uinfo)$this->error('no user');
        if($uinfo['type']>=$this->type)$this->error('no permission 2');
    }
    
    
    
    
    /********************分割(╯‵□′)╯︵┻━┻******************/
    
    
    
    
    
    
    function _beginning(){
        $this->userModel = model('user_info','api');
    }
    public function get_my_info(){
        $this->_safe_login();
		$this->success($this->userModel->get_user_info($this->uid));
	}
    public function get_user_info($uid=0){
        $this->_safe_admin();
        $this->_safe_utype($uid);
		$this->success($this->userModel->get_user_info($uid));
	}
    public function test(){
		echo $this->success('niconiconi~~~');
	}
    public function get_user_list($page=1){
        
        //根据uid
        //根据uname
        //根据type
		$this->_safe_admin();
        $page = floor($page);
        $page = $page<1?1:$page;
        $this->success($this->userModel->get_user_list($this->type,$data,$page));
        
	}
    public function get_admin_list($page=1){
		$this->_safe_admin();
        $this->_safe_type(4);
        $page = floor($page);
        $page = $page<1?1:$page;
        $this->success($this->userModel->get_admin_list($data,$page));
	}
	public function add_admin(){
        $uid = post('uid');
		$this->_safe_admin();
        $this->_safe_type(4);
        $this->success($this->userModel->add_admin($uid));
	}
    public function del_admin(){
        $uid = post('uid');
		$this->_safe_admin();
        $this->_safe_type(4);
        $this->_safe_utype($uid);
        $this->success($this->userModel->del_admin($uid));
	}
    public function user_login(){
        
        
        
        $uname = post('uname');
        $pwd = post('pwd');
        var_dump( $this->type );
        $uid = 1;
        $uname = 'c'; 
        $type = 2;
        $time = time();
        $login_secury = self::LOGIN_SALT[rand(0,4)].base64_encode(implode('|',array(
            $uid,
            $type,
            $uname,
            $time,
            md5($uid . $type . $uname . $time . self::LOGIN_SALT)
        )));
        cookie('login_secury',$login_secury,3600);
        cookie('admin_secury',$login_secury,-72000);
       
        
    }
    public function user_logout(){
	    $this->_safe_login();
    
	}
	public function reg(){
        
        
    }
	public function change_email(){
        $this->_safe_login();
        
    }
    public function change_password(){
        $this->_safe_login();
        
    }
    public function change_user_email(){
        $uid = post('uid');
        $this->_safe_admin();
        $this->_safe_utype($uid);
    }
    public function change_user_password(){
        $uid = post('uid');
        $this->_safe_admin();
        $this->_safe_utype($uid);
    }
    public function admin_login(){
        $this->_safe_login();
        
    }
}


?>