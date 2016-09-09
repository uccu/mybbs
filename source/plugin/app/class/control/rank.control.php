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
    function get_c($rank,$c,$b){
 
        $rank = floor($rank);
        if($rank==1)return ($c*$b[0]);
        $rankz = $rank;
        for($i=0;$i<5;$i++){
            $rankz -= pow(10,$i);
            if($rankz>pow(10,$i+1))continue;
            if($i==4){
                return floor($c*$b[$i+1]/1000);
            }
            
            if($rankz<=pow(10,$i+1)*0.1){
                return floor($c*$b[$i+1]*0.2/(pow(10,$i+1)*0.1));
            }elseif($rankz<=pow(10,$i+1)*0.3){
                return floor($c*$b[$i+1]*0.3/(pow(10,$i+1)*0.2));
            }elseif($rankz<=pow(10,$i+1)*0.6){
                return floor($c*$b[$i+1]*0.3/(pow(10,$i+1)*0.3));
            }else{
                return floor($c*$b[$i+1]*0.2/(pow(10,$i+1)*0.4));
            }
        }
        
        return 0;
    }
    function _addCoin(&$list,$allCoin,$rule,$page=1,$limit=10){
        foreach($list as $k=>&$v){
            $rank = ($page-1)*limit+$k+1;
            $v['rank'] = $rank;
            $b = array($rule['value1']/100,$rule['value2']/100,$rule['value3']/100,$rule['value4']/100,$rule['value5']/100);
            $v['coin'] = get_c($rank,$allCoin,$b);
        }
    }

    function rank_gou($aid){
        //获取AID
        $aid = post('aid',$aid,'%d');
        
        //获取活动所有乐豆
        $allBean = $z['allBean'] = $this->_allBean($aid);

        //获取当前排行的奖金
        $rule = model('rule')->find(1);
        $allCoin = $z['allCoin'] = $allBean*$rule['value']/100;

        //获取排名
        $where['aid'] = $aid;
        $where['first'] = 1;
        $where['status'] = array('contain',array(2,3,4),'IN');
        $where['score'] = 0;
        $z['list'] = model('order')->table(array(
            'order'=>array(
                'score','oid','uid','aid','status','pay_time','first','_mapping'=>'o'
            ),
            'user'=>array(
                'avatar','_on'=>'uid','username','_join'=>'LEFT JOIN'
            ),
            'rank_bean'=>array(
                '_on'=>'o.uid=b.uid AND o.aid=b.aid','_mapping'=>'b','bean','_join'=>'LEFT JOIN'
            )
        ))->where($where)->order(array('pay_time'))->page(1,10)->select();

        $this->success($z);
    }
    function rank_xiang($aid){
        //获取AID
        $aid = post('aid',$aid,'%d');
        
        //获取活动所有乐豆
        $allBean = $z['allBean'] = $this->_allBean($aid);

        //获取当前排行的奖金
        $gou = model('rule')->find(2);
        $z['allCoin'] = $allBean*$gou['value']/100;

        //获取排名
        $where['aid'] = $aid;
        $where['first'] = 1;
        $where['status'] = array('contain',array(2,3,4),'IN');
        $where['score'] = 0;
        $where['referee'] = array('logic',0,'!=');
        $z['list'] = model('order')->table(array(
            'order'=>array(
                'score','oid','aid','referee'=>'uid','status','pay_time','first','_mapping'=>'o'
            ),
            'user'=>array(
                'avatar','_on'=>'o.referee=u.uid','username','_join'=>'LEFT JOIN','_mapping'=>'u'
            ),
            'rank_bean'=>array(
                '_on'=>'o.referee=b.uid AND o.aid=b.aid','_mapping'=>'b','bean','_join'=>'LEFT JOIN'
            )
        ))->where($where)->order(array('pay_time'))->page(1,10)->select();

        $this->success($z);
    }
    function rank_bang($aid){
        //获取AID
        $aid = post('aid',$aid,'%d');
        
        //获取活动所有乐豆
        $allBean = $z['allBean'] = $this->_allBean($aid);

        //获取当前排行的奖金
        $gou = model('rule')->find(3);
        $z['allCoin'] = $allBean*$gou['value']/100;
        $where['aid'] = post('aid',$aid);
        $z['list'] = model('rank_bang')->where($where)->order(array('time'))->page(1,10)->select();
        $this->success($z);
    }

    function rank_dou($aid){
        //获取AID
        $aid = post('aid',$aid,'%d');
        
        //获取活动所有乐豆
        $allBean = $z['allBean'] = $this->_allBean($aid);

        //获取当前排行的奖金
        $gou = model('rule')->find(4);
        $z['allCoin'] = $allBean*$gou['value']/100;
        $where['aid'] = post('aid',$aid);
        $z['list'] = model('rank_bean')->where($where)->order(array('bean'=>'DESC'))->page(1,10)->select();
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