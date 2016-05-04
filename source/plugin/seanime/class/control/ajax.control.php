<?php
namespace plugin\seanime\control;
defined('IN_PLAY') || exit('Access Denied');
class ajax extends \control\ajax{
    function _beginning(){
        
    }
    function _get_user(){
        return control('user:base','api');
    }
    protected function _get_g(){
        return table('config');
    }
    protected function _get_tran(){
        return control('tool:tran','format');
    }
    protected function _get_model(){
        return model('seanime:seanime_resource');
    }
    protected function _get_modelTag(){
        return model('seanime:seanime_resource_tag');
    }
    protected function _get_theme(){
        return model('seanime:seanime_theme');
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
    public function _typein_sdtype(&$s,$ss){
        $s = floor($s);
        if(!$s || $s ==58){
            $s = 58;
            if(preg_match("/BD/i",$ss))$s=83;
			elseif(preg_match("/DVD/i",$ss))$s=84;
			elseif(preg_match("/raw/i",$ss))$s=91;
			elseif(preg_match("/(?<!\+|\+ )movie/i",$ss))$s=64;
			elseif(preg_match("/(?<!\+|\+ )OVA/i",$ss))$s=57;
			elseif(preg_match("/\[全\]|(合|全)集/i",$ss))$s=82;
			elseif(!preg_match("/MP4|AVI|MKV|rmvb|big5|gb|\d{4}x\d{3,4}/i",$ss)){
				if(preg_match("/漫画/i",$ss))$s=73;
				elseif(preg_match("/(图包|画册)/i",$ss))$s=81;
				elseif(preg_match("/小说/",$ss))$s=74;
				elseif(preg_match("/op|ed|音乐|主题(歌|曲)/i",$ss))$s=67;
				elseif(preg_match("/硬盘版/i",$ss))$s=90;
			}
        }
    }
    public function _typein_aid(&$a,$ss){
        $a = floor($a);
        if(!$a || $a ==69){
            $a = 69;
            $ss = preg_replace('/([-_ \/\.\\!&]|！|☆|×|【|】|『|』|★|＜|＞|《|》|的|之|の|·|&#39;)+/i',' ',$ss);
            $ss = preg_replace('/[`]+/i','',$ss);
            $where['matchs'] = array('match',$ss,true);
            $tt = $this->theme->where($where)->limit(5)->select();
            if(count($tt)<1)return;
            
            //elseif(count($tt)==1)return $a = $tt[0]['aid'];
            //elseif(!$tt[0]['vague'])return $a = $tt[0]['aid'];
            else{
                $v = $tt[0];
                $array = array();
                if($v['name'])$array = array_merge($array,explode(',',$v['name']));
                if($v['zh_tag'])$array = array_merge($array,explode(',',$v['zh_tag']));
                if($v['en_tag'])$array = array_merge($array,explode(',',$v['en_tag']));
                if($v['loma_tag'])$array = array_merge($array,explode(',',$v['loma_tag']));
                if($v['jp_tag'])$array = array_merge($array,explode(',',$v['jp_tag']));
                //var_dump( $tt[0],$array);die();
                $ss = preg_replace('/[ \d]+/i','',$ss);
				//var_dump($array);echo $ss;die();
                foreach($array as $v){
                    $v= preg_replace('/([-_ \/\.\\!&\d`]|！|☆|×|【|】|『|』|★|＜|＞|《|》|的|之|の|·|&#39;)+/i','',$v);
                    if(stripos($ss, $v)!==false)return $a = $tt[0]['aid'];
                }
                if(post('test')){
                    var_dump($array,$ss);die();
                }
                if(!$tt[0]['vague'])return;
                foreach($tt as $v){
                    if($tt[0]['vague'] === $v['aid'])return $tt[0]['vague'];
                }
            }
            
        }
    }
    private function _typein_playbill($a,$r,$s){
        $t = $this->theme->find($a);
        if(in_array($r,array(58,91))){
			$l = $t['lastnum']<1?1:$t['lastnum']+1;
			if(preg_match("/(#|-|第|\[|【|\]|】) ?0".($l<10?"+":"*").$l."( ?(?!月|部|季|章|卷|[a-z0-9])| ?RAW|$)/i",$s) 
                && !preg_match("/\d(预告|Preview|sp|ova|oad)\d/i",$s)){
                $data['lastnum'] = $l;$data['utime'] = time();
                $data['remark'] = '最后更新时间:'.date('Y-m-d H:i:s');
                $this->theme->data($data)->save($a);
            }
        }
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
        if(!preg_match('/^[a-z2-7]{32}$/i',$base32))$this->error('BASE32不规范');
        $a='abcdefghijklmnopqrstuvwxyz234567';
		$str='';
		for($i=0;$i<32;$i++)$str.=(string)($this->_typein_addzero(decbin(stripos($a,$base32[$i])),1,5));
		$hash='';
		for($i=0;$i+4<=40*4;$i+=4)$hash.=base_convert(substr($str,$i,4),2,16);
		$h = $hash;
    }
    public function _typein_hash($h){
        if(!$h)$this->error('HASH未定义');
        if($sid = $this->model->where(array('hash'=>$h))->find(false,false)->get_field('sid'))$this->error(array('code'=>300,'des'=>'存在HASH : '.$sid));
        return $h;
    }
    public function _typein_outlink($o){
        if(!preg_match('/^(\/\/|https?:)/i',$o))$this->error('outlink不正确');
        return $o;
    }
    public function _typein_sloc($o){
        if(!preg_match('/^(\/\/|https?:|magnet:)/i',$o))$this->error('sloc不正确');
        return $o;
    }
    public function resource($w=false){
        $sid = post('sid',0,'%d');
		if($w=='get'){
            if(!$sid)$this->error('无参数 sid');
            $o = $this->model->find($sid);
            $this->success($o);
        }
        $this->user->_safe_login();
        if($w=='del'){
            if(!$sid)$this->error('无参数 sid');
            $this->user->_safe_right(8);
            $t = $this->model->remove($sid);
            $this->success($t);
		}
		$info=post('info','',array($this,'_typein'));
 
        if(!is_array($info))$this->error('无参数 info');
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
            'outlink'=>array(array($this,'_typein_outlink')),
            'sloc'=>array(array($this,'_typein_sloc'))
        );
        if($w=='upd'){
            
            if(!$sid)$this->error('无参数 : sid');
			$this->user->_safe_right(8);
            if($info['hash'] && $rsid = $this->model->where(array('hash'=>$info['hash'],'sid'=>array('logic',$sid,'!=')))->find(false,false)->get_field('sid')){
                $this->error('存在HASH : '.$rsid);
            }
            if($info['aid'])$this->_typein_aid($info['aid'],$info['sname']);
            if($info['aid']!=69)$this->_typein_playbill($info['aid'],$info['sdtype'],$info['sname']);
			if($upd = $this->model->auto($auto)->data($info)->save($sid))
            {
                if($info['sname']){
                    $data2['sid'] = $sid;
                    $data2['tag'] = array('logic',$info['sname'],'%m');
                    $this->modelTag->data($data2)->add(true);
                    
                }
                
                
            }
            $this->success($upd);
		}else{
            $auto['stimeline'] = array(false,time());
            $auto['suid'] = array(false,$this->user->uid);
            $auto['sname'] = array(array($this,'_typein_sname'),true);
            if($info['hash'])$auto[ 'hash'] = array(array($this,'_typein_hash'),true);
            if(!$info['aid'] || $info['aid']==69)$this->_typein_sdtype($info['sdtype'],$info['sname']);
            $this->_typein_aid($info['aid'],$info['sname']);
            if($info['aid']!=69)$this->_typein_playbill($info['aid'],$info['sdtype'],$info['sname']);
            if($ins = $this->model->auto($auto)->data($info)->add()){
                $data2['sid'] = $ins;
                $data2['tag'] = array('logic',$info['sname'],'%m');
                $this->modelTag->data($data2)->add(true);
            }
            
            $this->success($ins);
        }
	}

	public function getanimes($s=false){
		$this->user->_safe_right(8);
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
		$this->success(array('list'=>$list,'maxrow'=>$maxrow,'maxpage'=>$maxpage));
	}
    
	public function animedelete($aid=false){
		$this->user->_safe_right(8);
		$t = $this->theme->remove($aid);
		$this->success($t);
	}
	public function newanime($s=false){
		$this->user->_safe_right(8);
        $data['name'] = 'new_anime';
        $data['timeline'] = time();
		$t = $this->theme->data($data)->add();
		$this->success($t);
	}
    /*--------------------------------------------------*/
    
    
	public function animereturnresource($s=false){
		$this->user->_safe_right(8);
        $aid = post('aid',0,'%d');
        if(!$aid)$this->error('无参数');
        $where['aid'] = $aid;
        $data['aid'] = 69;
		$t = $this->model->where($where)->data($data)->save();
		$this->success($t);
	}
	public function animefilterresource(){
		$this->user->_safe_right(8);
        $f = post('search','');
        $aid = post('aid',0,'%d');
        if(!$aid || !$f)$this->error('无参数');
        $where['tag'] = array('match',$f);
        $where['aid'] = 69;
        $data['aid'] = $aid;
        $plusTable = array('seanime_resource'=>array('aid','_on'=>'sid'));
        $t = $this->modelTag->add_table($plusTable)->where($where)->data($data)->save();
        $this->success($t);
	}
	public function changeanimename($s=false){
		return $this->changeanimeinfo('name',post('name'));
	}
	public function changeanimetag($s=false){
		return $this->changeanimeinfo('tag',post('tag'));
	}
	public function changeanimedess($s=false){
		return $this->changeanimeinfo('dess',post('dess'));
	}
	public function changeanimenewsname($s=false){
		return $this->changeanimeinfo('newname',post('newname'));
	}
	public function changeanimelastnum($s=false){
		return $this->changeanimeinfo('lastnum',post('lastnum'));
	}
	public function changeanimeregexp($s=false){
		return $this->changeanimeinfo('regexp',post('regexp'));
	}
	public function changeanimeorder($s=false){
		return $this->changeanimeinfo('order',post('order'));
	}
    private function _changeanimeinfo($k,$v){
		$this->user->_safe_right(8);
        $data[$k] = $v;
        $aid = post('aid',0,'%d');
        if(!$aid)$this->error('无参数');
		$t = $this->theme->data($data)->save($aid);
		$this->success($t);
	}
	public function themetags($s=false){
        $f = post('search','');
        if(!$f)$this->error('无参数');
        $where['matchs'] = array('match',$f,1);
        $tags = $this->theme->field(array('name','tag','aid'))->where($where)->limit(5)->select();
		$this->success($tags);
	}
	public function changesize($s=false){
		if($this->user->uid==217 && $s){
			$r = $this->model->find($s);
			if(!$r)$this->error('无资源');
			if(!$r['size']){
                $size = post('info',0,'%d');
				if(!$size)$this->error('参数错误');
                $data['size'] = floor($size/1024/1024);
				$a = $this->model->data($data)->save($s);
				$this->success($a);
			}
			$this->success('ok');
		}else{
			$this->error('无权限');
		}
	}
    
    
    
    public function flesh_theme_matchs($s=false,$o=false){
		$this->user->_safe_right(8);$where = array();
        if($s && $o)$where['aid'] = array('between',array($s,$o));
        elseif($s)$where['aid']=$s;
        $r = $this->theme->where($where)->field(array('aid','name','zh_tag','en_tag','loma_tag','jp_tag'))->limit(9999)->order('aid')->select();
        $oo = array();
        foreach($r as $v){
            $data = array();
            $vf = $v;
            unset($vf['aid']);
            $data['matchs'] = array('logic',implode(' ',$vf),'%m');
            if(!$this->theme->data($data)->save($v['aid'])){
                $oo[] = $v['aid'];
            }
        }
        $out['count'] = count($r);
        $out['unflesh'] = $oo;
        $this->success($out);
	}
    public function filter_theme_in($s=false){
		$this->user->_safe_right(8);
        if(!$s)$this->error('无AID');
        $s = floor($s);
        $r = $this->theme->field(array('name','zh_tag','en_tag','loma_tag','jp_tag'))->find($s);
        if(!$r)$this->error('无AID');
        $tt = array();
        foreach ($r as $v) {
           if($v)$tt = array_merge($tt,explode(',',$v));
        }
        $data['aid'] = $s;$ue = array();
        $plusTable = $this->modelTag->tableMapx;
        $t = $this->modelTag->add_table($plusTable);
        foreach ($tt as $v) {
            $where['tag'] = array('match',$v);
            $where['aid'] = 69;
            $ue[]= $t->where($where)->data($data)->save();
        }
        $out['count'] = $ue;
        $out['matchs'] =$tt;
        $this->success($out);
	}
    public function flesh_resource_matchs($page=1,$limit=100){
		$this->user->_safe_right(8);
        $r = $this->model->field(array('sid','sname'))->page($page,$limit)->order('sid')->select();
        $oo = array();
        foreach($r as $v){
            $data = array();
            $data['tag'] = array('logic',$v['sname'],'%m');
            if(!$this->modelTag->data($data)->save($v['sid'])){
                $oo[] = $v['sid'];
            }
        }
        $out['unflesh'] = $oo;
        $this->success($out);
	}
    
}

?>