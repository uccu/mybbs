<?php
namespace plugin\seanime\control;
defined('IN_PLAY') || exit('Access Denied');
class down extends \control{
    function _beginning(){
        
        
    }
    protected function _get_model(){
        return model('seanime:seanime_resource');
    }
    protected function _get_modelTag(){
        return model('seanime:seanime_resource_tag');
    }
    function _get_user(){
        return control('user:base','api');
    }
    function thunder($sid=0,$time){
        $m = model('seanime_resource');
        $where['sid'] = $sid;
        $where['stimeline'] = $time;
        $hash = $m->where($where)->get_field('hash');
        $hash = strtoupper($hash);
        $r1 = substr($hash,0,2);
		$r2 = substr($hash,38,2);
		header("Location: http://bt.box.n0808.com/".$r1."/".$r2."/".$hash.".torrent");
    }
    function straight($sid=0,$time){
        $m = model('seanime_resource');
        $where['sid'] = $sid;
        $where['stimeline'] = $time;
        $t = $m->where($where)->get_field('sloc');
		header("Location: ".$t);
    }
    
    
    function nomethod(){
        
        
    }
    
    public function sort_resource_tag($s=0){
		$this->user->_safe_right(8);
        $where['sid']=array('logic',$s*10000,'>');
        $where2['sid']=array('logic',$s*10000+10001,'<');
        $r = $this->model->field(array('sid','sname'))->where($where)->where($where2)->order('sid')->limit(10000)->select();
        $oo = $vr = array();
        foreach($r as $v){
            $data = array();
            $data['tag'] = array('logic',$v['sname'],'%m');
            $data['sid'] = $v['sid'];
            if(!$vr[] = $this->modelTag->data($data)->sql()->add(true)){
                $oo[] = $v['aid'];
            }
            
        }
                foreach($vr as $vv){
                    $ve .= $vv.";\n";
                }
                header("Content-Type: application/octet-stream");
                header("Accept-Ranges: bytes");
                if($s<10)$s = '0'.$s;
                header("Content-Disposition: attachment; filename=tag_".$s.".sql");
                echo $ve;
        //$this->success($oo);
	}
}

?>