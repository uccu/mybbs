<?php
namespace plugin\seanime\control;
defined('IN_PLAY') || exit('Access Denied');
class ajax extends \control\ajax{
    private $g;
    private $model;
    private $user;
    function _beginning(){
        //$this->user = model('user:base','api');
        $this->user = new class{};
        $this->user->uid = 1;
        $this->user->right = 99;
    }
    //function _get_user(){
    //    return model('user:base','api');
    //}
    function _get_g(){
        return table('config');
    }
    function _get_tran(){
        return control('tool:tran','format');
    }
    function _get_model(){
        return model('seanime:seanime_resource');
    }
    function _get_theme(){
        return model('seanime:seanime_theme');
    }
    function get_resource($sid=0){
        
    }
    /*
    function _test(&$a){
        return $a = 2;
    }
    function test(){
        $a = 1;
        echo $this->_test($a);
        echo $a;
    }
    */
    
    public function _typein($e){
		if(is_array($e)){
			$lis=array();
			foreach($e as $b){
				if(!is_array($b))$lis['_mod']=$this->_typein($b);
				elseif(isset($b[0]) && isset($b[1])){
                    $b[0] = (string)$b[0];
                    $b[1] = (string)$b[1];
					if($b[0]=='sname')$b[1]=$lis[$b[0]]=str_ireplace(array('_'),array(' '),$b[1]);
					$lis[$b[0]]=$this->_typein($b[1]);
				}
			}
			return $lis;
		}else return $this->tran->t2c(str_ireplace(array('&222;','&333;','<','>','"',"'",'\\'),array('(',')','&lt;','&gt;','&quot;','&#39;','/'),$e));
	}
    public function _typein_sname($s){
        if(!$s)$this->error('无参数 ： sname');
        return $s;
    }
    private function _typein_addzero($r,$e,$t=4){
		$r=(string)$r;
		$re=strlen($r);
		for($i=0;$i<$t*$e-$re;$i++)$r='0'.$r;
		return $r;
	}
    private function _hashtobase32(&$b,$hash){
        if(!preg_match('/^[a-z0-9]{40}$/i',$hash))$this->error('HASH不规范');
        $a='abcdefghijklmnopqrstuvwxyz234567';$p='';
		for($i=0;$i<4;$i++)$p .= $this->_typein_addzero(base_convert(substr($hash,$i*10,10),16,2),10);
		$base32='';
		for($i=0;$i+5<=160;$i+=5)$base32.=$a[base_convert(substr($p,$i,5),2,10)];
		$b = strtoupper($base32);
    }
    private function _base32tohash(&$h,$base32){
        if(!preg_match('/^[a-z2-7]{40}$/i',$base32))$this->error('BASE32不规范');
        $a='abcdefghijklmnopqrstuvwxyz234567';
		$str='';
		for($i=0;$i<32;$i++)$str.=(string)($this->_typein_addzero(decbin(stripos($a,$base32[$i])),1,5));
		$hash='';
		for($i=0;$i+4<=40*4;$i+=4)$hash.=base_convert(substr($str,$i,4),2,16);
		$h = $hash;
    }
    public function _typein_hash($h){
        if(!$h)$this->error('HASH未定义');
        if($sid = $this->model->where(array('hash'=>$h))->find(false,false)->get_field('sid'))$this->error('存在HASH : '.$sid);
        return $h;
    }
    public function resource($w=false){
        $sid = post('sid',0,'%d');
		if($w=='get'){
            if(!$sid)return $this->error('无参数');
            $o = $this->model->find($sid);
            return $this->success($o);
        }
        if(!$this->user->uid)return $this->error('未登录');
        if($w=='del'){
            if(!$sid)return $this->error('无参数');
            if($this->user->right<8)return $this->error('未授权');
            $t = $this->model->remove($sid);
            return $this->success($t);
		}
		$info=post('info','',array($this,'_typein'));
        //$this->success(array('sid'=>$sid,'info'=>$info));
        $filter=$this->_check_resource($info,$w=='upd'?true:false);
        if(!is_array($info))return $this->error('无参数');
        unset($info['sid'],$info['_mod']);
        if($info['hash']){
            $this->_hashtobase32($info['base32'],$info['hash']);
        }elseif($info['base32']){
            $this->_base32tohash($info['hash'],$info['base32']);
        }
        $auto = array(
            'sid'=>false,
            'suid'=>false,
            'stimeline'=>false,
            'order'=>false,
            'sktimeline'=>array(false,time()),
            'skuid'=>array(false,$this->user->uid),
            'sshowtimes'=>false,
            'sdowntimes'=>false,
        );
        if($w=='upd'){
            
            if(!$sid)return $this->error('无参数 : sid');
			if($this->user->right<8)return $this->error('未授权');
            if($info['hash'] && $rsid = $this->model->where(array('hash'=>$info['hash'],'sid'=>array('logic',$sid,'!=')))->find(false,false)->get_field('sid')){
                $this->error('存在HASH : '.$rsid);
            }
			$upd = $this->model->auto($auto)->data($info)->save($sid);
            $this->success($upd);
		}else{
            $auto['stimeline'] = array(false,time());
            $auto['suid'] = array(false,$this->user->uid);
            $auto['sname'] = array(array($this,'_typein_sname'),true);
            $auto[ 'hash'] = array(array($this,'_typein_hash'),true);
            $ins = $this->model->auto($auto)->data($info)->add();
            $this->success($ins);
        }
	}

	public function getanimes($s=false){
		if($this->user->right<8)return $this->error('未授权');
		$page=floor($s);$limit=10;
		if(($g = basename($_SERVER['HTTP_REFERER'])) && $g!='anime' && $this->user->uid==1){
			$maxrow = 0;
            $where['name'] = preg_match('/^\d+$/i',$g) ? $g : array('logic','%'.urldecode($g).'%',' like ');
            $list = $this->theme->where($where)->order('aid',1)->page($page,$limit)->select();
		}else{
			$list = $this->theme->order('aid',1)->page($page,$limit)->select();
			$maxrow = $this->theme->get_field('count(*)');
		}
		$maxpage=floor(($maxrow-1)/$limit)+1;
		return $this->success(array('list'=>$list,'maxrow'=>$maxrow,'maxpage'=>$maxpage));
	}
    public function _safe_right($r){
        if($this->user->right<$r)return $this->error('未授权');
    }
	public function animedelete($aid=false){
		$this->_safe_right(8);
		$t = $this->theme->remove($aid);
		return $this->success($t);
	}
	public function newanime($s=false){
		$this->_safe_right(8);
        $data['name'] = 'new_anime';
        $data['timeline'] = time();
		$t = $this->theme->data($data)->add();
		return $this->success($t);
	}
    /*--------------------------------------------------*/
    
    private function changeanimeinfo($v,$aid,$d='n'){
		if($d!=='d')$d='n';
		$aid=floor($aid);
		if(!$_G['uid'] || $_G['right']<8)return $this->out(501,'未授权');
		$t = table('seanime')->upd_theme(array($v=>$_POST['des'],'aid'=>$aid));
		return $this->out(200);
	}
	public function animereturnresource($s=false){
		global $_G;
		if(!$_G['uid'] || $_G['right']<8)return $this->out(501,'未授权');
		$t = table('seanime')->returnresourcetounsortbyaid($s);
		return $this->out($t?200:400);
	}
	public function animefilterresource($s=false){
		global $_G;
		if(!$_G['uid'] || $_G['right']<8)return $this->out(501,'未授权');
		return $this->out(table('seanime')->sort_resource($_POST['des'],$s)?200:400);
	}
	public function changeanimename($s=false){
		return $this->changeanimeinfo('name',$s);
	}
	public function changeanimetag($s=false){
		return $this->changeanimeinfo('tag',$s);
	}
	public function changeanimedess($s=false){
		return $this->changeanimeinfo('dess',$s);
	}
	public function changeanimenewsname($s=false){
		return $this->changeanimeinfo('newsname',$s);
	}
	public function changeanimelastnum($s=false){
		return $this->changeanimeinfo('lastnum',$s);
	}
	public function changeanimeregexp($s=false){
		return $this->changeanimeinfo('regexp',$s);
	}
	public function changeanimeorder($s=false){
		return $this->changeanimeinfo('order',$s);
	}
	public function error_report($s=false){
		if(!$s)return $this->out(400);
		$s=base64_decode($s);
		table('seanime')->report_resourceerror($s);
		return $this->out();
	}
	public function fleshthemetags($s=false){
		global $_G;
		if(!$_G['uid'] || $_G['right']<8)return $this->out(501,'未授权');
		$t=table('seanime')->fleshthemetags();
		return $this->out($t?200:400);
	}
	public function themetags($s=false){
		$tag=table('seanime')->ThemeTags;
		$tag2=array();
		if($s)foreach($tag as $k=>$v){
			if(stripos($k,$s)!==false)$tag2[]=array($k,$v);
			if(count($tag2)>5)break;
		}
		return json_encode($tag2);
	}
	public function changesize($s=false){
		global $_G;
		if($_G['uid']==217 && $s){
			$r = M::fetch_first('SELECT * FROM `seanime_sources` WHERE `sid`=%d',array($s));
			if(!$r)return $this->out(407);
			if(!$r['size']){
				if(!$_POST['info'])return $this->out(409,$_POST['info']);
				$a = M::query('UPDATE `seanime_sources` SET `size`=%d WHERE `sid`=%d',array(floor($_POST['info']/1024/1024),$s));
				if(!$a)return $this->out(408);
			}
			return $this->out();
		}else{
			return $this->out(400);
		}
	}
}

?>