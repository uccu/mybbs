<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class rank extends base\basic{
    private $out = true;
    function _beginning(){
        


    }
    function _allBean($aid){
        $all = model('order')->field('SUM(`bean`) as `s`')->where(array(
            'aid'=>$aid,
            'status'=>array('contain',array(2,3,4),'IN'),
        ))->find();
        return $all['s']?$all['s']:0;
    }

    function rank_gou($aid){
        //获取AID
        $aid = post('aid',$aid,'%d');
        
        //获取活动所有乐豆
        $allBean = $z['allBean'] = $this->_allBean($aid);

        //获取当前排行的奖金
        $gou = model('rule')->find(1);
        $z['allCoin'] = $allBean*$gou['value']/100;

        //获取排名
        $where['aid'] = $aid;
        $where['status'] = array('contain',array(2,3,4),'IN');
        $where['score'] = 0;
        $z['list'] = model('order')->add_table(array(
            'user'=>array(
                'avatar','_on'=>'uid','username','_join'=>'LEFT JOIN'
            ),
            'rank_bean'=>array(
                '_on'=>'tuan_order.uid=b.uid AND tuan_order.aid=b.aid','_mapping'=>'b','bean'=>'get','_join'=>'LEFT JOIN'
            )
        ))->where($where)->order(array('ctime'))->page(1,10)->select();

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