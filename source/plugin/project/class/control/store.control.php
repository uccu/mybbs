<?php
namespace plugin\project\control;
defined('IN_PLAY') || exit('Access Denied');
class store extends \control\ajax{
    function _beginning(){
        //$this->user->_safe_login();
    }
    function _get_user(){
        return control('user:base','api');
    }
    function _get_store(){
        return model('project:store_info');
    }
    function _get_expert(){
        return model('project:expert_info');
    }
    function _get_reservation(){
        return model('project:reservation');
    }
    function _get_pls(){
        $m = model('project:project_link_store');
        return $m->add_table($m->store);
    }
    function get_store_list($jid,$area){
        $where['jid'] = post('jid',$jid);
        $where['area'] = post('area',$area);
        //model('cache')->replace('test',$where,'%s');
        $m = $this->pls->where($where)->limit(9999)->select();
        $this->success($m);
    }
    function get_store_area_list(){
        
        $province = post('province');
        $city = post('city');
        $m = $this->store->field('DISTINCT `area`')->order('area')->limit(9999)->select();
        $gg = array();
        
        if($province){
            foreach($m as &$v){
                $v = explode(' ',$v['area']);
                if($v[0]==$province && !array_search($v[1],$gg))$gg[] = $v[1];
            }
        }elseif($city){
            foreach($m as &$v){
                $v = explode(' ',$v['area']);
                if($v[1]==$city)$gg[] = $v[2];
            }
        }else{
            foreach($m as &$v){
                $v = explode(' ',$v['area']);
                if(!array_search($v[0],$gg))$gg[] = $v[0];
            }
        }
        
        
        
        $this->success($gg);
    }
    function get_expert_list($sid=0){
        //$where['sid'] = $sid;
        $where['sid'] = post('sid');
        $m = $this->expert->where($where)->limit(9999)->select();
        $this->success($m);
    }
    function booking(){
        $data['eid'] = post('eid',0,'%d');
        if(!$this->expert->find($data['eid']))$this->error(412,'没有找到对应的专家');
        $where['name'] = post('name');
        $where['phone'] = post('phone');
        $where['time'] = post('time');
        $where['uid'] = $this->user->uid;
        $m = $this->reservation->data($data)->add();
        if($m)$this->success($m);
        else $this->error(413,'预约失败');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>