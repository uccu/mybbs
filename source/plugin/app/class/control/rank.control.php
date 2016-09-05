<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class rank extends base\basic{
    private $out = true;
    function _beginning(){
        


    }


    function rank_gou(){
        $where['aid'] = post('aid');
        $where['status'] = array('contain',array(2,3,4),'IN');
        $z['list'] = model('order')->field('distinct uid,ctime')->where($where)->order('ctime')->limit(10)->select();
        $where['uid'] = $this->uid;
        $z2 = model('order')->where($where)->order('ctime')->find();
        if(!$z2)$z['my'] = array('rank'=>'0');
        else{
            unset($where['uid']);
            $where['ctime'] = array('logic',$z2['ctime'],'<');
            $z3 = model('order')->field('count(distinct uid)+1 as c')->where($where)->get_filed('c');
            $z['my'] = array('rank'=>$z3);
        }
        $this->success($z);
    }
    function rank_xiang(){
        $where['aid'] = post('aid');
        $where['status'] = array('contain',array(2,3,4),'IN');
        $where['referee'] = array('logic',0,'!=');
        $z['list'] = model('order')->field('distinct u.referee,tuan_order.ctime')->add_table(array(
            'user'=>array('_on'=>'uid','referee','_mapping'=>'u')
        ))->where($where)->order('ctime')->limit(10)->select();
        // $where['uid'] = $this->uid;
        // $z2 = model('order')->where($where)->order('ctime')->find();
        // if($z2)$z['my'] = array('rank'=>'0');
        // else{
        //     unset($where['uid']);
        //     $where['ctime'] = array('logic',$z2['ctime'],'<');
        //     $z3 = model('order')->field('count(distinct uid)+1 as c')->where($where)->get_filed('c');
        //     $z['my'] = array('rank'=>$z3);
        // }
        $this->success($z);
    }
    function rank_bang(){
        $where['aid'] = post('aid');
        $z['list'] = model('rank_bang')->where($where)->order(array('time'))->limit(10)->select();
        $this->success($z);
    }

    function rank_dou(){
        $where['aid'] = post('aid');
        $z['list'] = model('rank_bang')->where($where)->order(array('bean'=>'DESC'))->limit(10)->select();
        $where['uid'] = $this->uid;
        $my = model('rank_bang')->where($where)->find();
        if($my){
            unset($where['uid']);
            $where['bean'] = array('logic',$my['bean'],'>');
            $rank = model('rank_bang')->where($where)->get_field()+1;
            $z['my'] = array('rank'=>$rank);
        }else $z['my'] = array('rank'=>'0');
        $this->success($z);
    }
    function my_rank_gou(){

    }
    function my_rank_xiang(){

    }
    function my_rank_bang(){

    }

    function my_rank_dou(){

    }
    function prize_list(){
        
    }

}
?>