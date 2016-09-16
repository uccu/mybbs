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
        $pe = model('cache')->get('percent');
        return $all['s']?$all['s']*$pe:0;
    }
    function get_c($rank,$c,$b){
 
        $rank = floor($rank);
        if($rank==1)return floor($c*$b[0]);
        $rankz = $rank;
        for($i=0;$i<4;$i++){
            $rankz -= $b[5]*pow(10,$i);
            if($rankz>$b[5]*pow(10,$i+1))continue;
            if($i==4)return floor($c*$b[$i+1]/1000);
            if($rankz<=$b[5]*pow(10,$i+1)*0.1){
                return floor($c*$b[$i+1]*0.2/($b[5]*pow(10,$i+1)*0.1));
            }elseif($rankz<=$b[5]*pow(10,$i+1)*0.3){
                return floor($c*$b[$i+1]*0.3/($b[5]*pow(10,$i+1)*0.2));
            }elseif($rankz<=$b[5]*pow(10,$i+1)*0.6){
                return floor($c*$b[$i+1]*0.3/($b[5]*pow(10,$i+1)*0.3));
            }else{
                return floor($c*$b[$i+1]*0.2/($b[5]*pow(10,$i+1)*0.4));
            }
        }
        if($rankz<=$b[5]*1000 && $b[4]){
            return floor($c*$b[4]/$b[5]*10000);
        }
        
        return 0;
    }
    function _addCoin(&$list,$allCoin,$rule,$page=1,$limit=10){
        foreach($list as $k=>&$v){
            $rank = ($page-1)*limit+$k+1;
            $v['rank'] = $rank;
            $b = array($rule['value1']/100,$rule['value2']/100,$rule['value3']/100,$rule['value4']/100,$rule['value5']/100,$rule['type']);
            $v['coin'] = $this->get_c($rank,$allCoin,$b);
        }
    }

    function rank_gou($aid){
        //获取AID
        $aid = post('aid',$aid,'%d');
        if(!$aid)$aid = $this->lastAid;
        $page = post('page',1);
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
        ))->where($where)->order(array('pay_time'))->page($page,10)->select();
        $this->_addCoin($z['list'],$allCoin,$rule,$page);
        $this->success($z);
    }
    function rank_xiang($aid){
        //获取AID
        $aid = post('aid',$aid,'%d');
        if(!$aid)$aid = $this->lastAid;
        $page = post('page',1);
        //获取活动所有乐豆
        $allBean = $z['allBean'] = $this->_allBean($aid);

        //获取当前排行的奖金
        $rule = model('rule')->find(2);
        $allCoin = $z['allCoin'] = $allBean*$rule['value']/100;

        //获取排名
        $where['aid'] = $aid;
        $where['share_first'] = 1;
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
        ))->where($where)->order(array('pay_time'))->page($page,10)->select();
        $this->_addCoin($z['list'],$allCoin,$rule,$page);
        $this->success($z);
    }
    function rank_bang($aid){
        //获取AID
        $aid = post('aid',$aid,'%d');
        if(!$aid)$aid = $this->lastAid;
        $page = post('page',1);
        //获取活动所有乐豆
        $allBean = $z['allBean'] = $this->_allBean($aid);

        //获取当前排行的奖金
        $rule = model('rule')->find(3);
        $allCoin = $z['allCoin'] = $allBean*$rule['value']/100;

        $where['aid'] = post('aid',$aid);
        $z['list'] = model('rank_bang')->where($where)->order(array('time'))->page($page,10)->select();
        $this->_addCoin($z['list'],$allCoin,$rule,$page);
        $this->success($z);
    }

    function rank_dou($aid){
        //获取AID
        $aid = post('aid',$aid,'%d');
        if(!$aid)$aid = $this->lastAid;
        $page = post('page',1);
        //获取活动所有乐豆
        $allBean = $z['allBean'] = $this->_allBean($aid);

        //获取当前排行的奖金
        $rule = model('rule')->find(4);
        $allCoin = $z['allCoin'] = $allBean*$rule['value']/100;

        $where['aid'] = post('aid',$aid);
        $z['list'] = model('rank_bean')->where($where)->order(array('bean'=>'DESC'))->page($page,10)->select();
        $this->_addCoin($z['list'],$allCoin,$rule,$page);
        $this->success($z);
    }
    function my_rank($aid){

        $this->_check_login();


        $aid = post('aid',$aid,'%d');
        if(!$aid)$aid = $this->lastAid;
        $allBean = $z['allBean'] = $this->_allBean($aid);


        $where = array();
        $where['aid'] = $aid;
        $where['uid'] = $this->uid;
        $where['first'] = 1;
        $where['status'] = array('contain',array(2,3,4),'IN');
        $where['score'] = 0;
        $me = model('order')->where($where)->order(array('pay_time'))->find();
        if($me){
            unset($where['uid']);
            $where['pay_time'] = array('logic',$me['pay_time'],'<');
            $z['gou']['rank'] = $rank = model('order')->where($where)->get_field()+1;
            $rule = model('rule')->find(1);
            $allCoin =  $allBean*$rule['value']/100;
            $b = array($rule['value1']/100,$rule['value2']/100,$rule['value3']/100,$rule['value4']/100,$rule['value5']/100,$rule['type']);
            $z['gou']['coin'] = $coin = $this->get_c($rank,$allCoin,$b);
            $z['gou']['time'] = $me['pay_time'];
        }else{
            $z['gou']['rank'] = $z['gou']['coin'] = $z['gou']['time'] = 0;
        }


        $where = array();
        $where['aid'] = $aid;
        $where['referee'] = $this->uid;
        $where['share_first'] = 1;
        $where['status'] = array('contain',array(2,3,4),'IN');
        $where['score'] = 0;
        $me = model('order')->where($where)->order(array('pay_time'))->find();
        $z['xiang_x']['coin'] = 0;
        if($me){
            unset($where['referee']);
            $where['pay_time'] = array('logic',$me['pay_time'],'<');
            $z['xiang']['rank'] = $rank = model('order')->where($where)->get_field()+1;
            $rule = model('rule')->find(2);
            $allCoin =  $allBean*$rule['value']/100;
            $b = array($rule['value1']/100,$rule['value2']/100,$rule['value3']/100,$rule['value4']/100,$rule['value5']/100,$rule['type']);
            $z['xiang']['coin'] = $coin = $this->get_c($rank,$allCoin,$b);
            $z['xiang']['time'] = $me['pay_time'];
            unset($where['pay_time']);
            $where['referee'] = array('logic','0','!=');
            $where['uid'] = $this->uid;
            $me = model('order')->field('distinct referee')->where($where)->limit(9999)->select();
            foreach($me as $v)if($v['referee']){
                $tr = $this->_xiang($aid,$v['referee']);
                $z['xiang_x']['coin'] += $tr['xiang']['coin']/2;
            }
            $z['xiang_x']['coin'] = floor($z['xiang_x']['coin']);
        }else{
            $z['xiang']['rank'] = $z['xiang']['coin'] = $z['xiang']['time'] = 0;
        }

        $where = array();
        $where['aid'] = $aid;
        $where['uid'] = $this->uid;
        $me = model('rank_bang')->where($where)->find();
        $z['bang_x']['coin'] = 0;
        if($me){
            unset($where['uid']);
            $where['time'] = array('logic',$me['time'],'<');
            $z['bang']['rank'] = $rank = model('rank_bang')->where($where)->get_field()+1;
            $rule = model('rule')->find(3);
            $allCoin =  $allBean*$rule['value']/100;
            $b = array($rule['value1']/100,$rule['value2']/100,$rule['value3']/100,$rule['value4']/100,$rule['value5']/100,$rule['type']);
            $z['bang']['coin'] = $coin = $this->get_c($rank,$allCoin,$b);
            $z['bang']['time'] = $me['time'];
            $where = array();

            $where['aid'] = $aid;
            $where['uid'] = $this->uid;
            $where['status'] = array('contain',array(2,3,4),'IN');
            $where['score'] = 0;
            $where['referee'] = array('logic','0','!=');
            $me = model('order')->field('distinct referee')->where($where)->limit(9999)->select();
            foreach($me as $v)if($v['referee']){
                $tr = $this->_bang($aid,$v['referee']);
                var_dump($tr);
                $z['bang_x']['coin'] += $tr['bang']['coin']/2/$tr['bang']['num'];
            }
            $z['bang_x']['coin'] = floor($z['bang_x']['coin']);


        }else{
            $z['bang']['rank'] = $z['bang']['coin'] = $z['bang']['time'] = 0;
        }
        


        $where = array();
        $where['aid'] = $aid;
        $where['uid'] = $this->uid;
        $me = model('rank_bean')->where($where)->find();
        if($me){
            unset($where['uid']);
            $where['bean'] = array('logic',$me['bean'],'>');
            $z['bean']['rank'] = $rank = model('rank_bean')->where($where)->get_field()+1;
            $rule = model('rule')->find(4);
            $allCoin =  $allBean*$rule['value']/100;
            $b = array($rule['value1']/100,$rule['value2']/100,$rule['value3']/100,$rule['value4']/100,$rule['value5']/100,$rule['type']);
            $z['bean']['coin'] = $coin = $this->get_c($rank,$allCoin,$b);
            $z['bean']['time'] = 0;
        }else{
            $z['bean']['rank'] = $z['bean']['coin'] = $z['bean']['time'] = 0;
        }

        




        $this->success($z);

    }
    function my_rank_gou(){

    }
    function _xiang($aid,$uid){
        $allBean = $z['allBean'] = $this->_allBean($aid);
        $where['aid'] = $aid;
        $where['referee'] = $uid;
        $where['share_first'] = 1;
        $where['status'] = array('contain',array(2,3,4),'IN');
        $where['score'] = 0;
        $me = model('order')->where($where)->order(array('pay_time'))->find();
        if($me){
            unset($where['referee']);
            $where['pay_time'] = array('logic',$me['pay_time'],'<');
            $z['xiang']['rank'] = $rank = model('order')->where($where)->get_field()+1;
            $rule = model('rule')->find(2);
            $allCoin =  $allBean*$rule['value']/100;
            $b = array($rule['value1']/100,$rule['value2']/100,$rule['value3']/100,$rule['value4']/100,$rule['value5']/100,$rule['type']);
            $z['xiang']['coin'] = $coin = $this->get_c($rank,$allCoin,$b);
            $z['xiang']['time'] = $me['pay_time'];
        }else{
            $z['xiang']['rank'] = $z['xiang']['coin'] = $z['xiang']['time'] = 0;
        }
        return $z;
    }
    function _bang($aid,$uid){
        $where = array();
        $where['aid'] = $aid;
        $where['uid'] = $uid;
        $me = model('rank_bang')->where($where)->find();
        if($me){
            unset($where['uid']);
            $where['time'] = array('logic',$me['time'],'<');
            $z['bang']['rank'] = $rank = model('rank_bang')->where($where)->get_field()+1;
            $rule = model('rule')->find(3);
            $allCoin =  $allBean*$rule['value']/100;
            $b = array($rule['value1']/100,$rule['value2']/100,$rule['value3']/100,$rule['value4']/100,$rule['value5']/100,$rule['type']);
            $z['bang']['coin'] = $coin = $this->get_c($rank,$allCoin,$b);
            $z['bang']['time'] = $me['time'];
            $z['bang']['num'] = $me['num'];
        }else{
            $z['bang']['rank'] = $z['bang']['coin'] = $z['bang']['time'] = 0;
        }
        return $z;
    }
    function my_rank_bang(){

    }

    function my_rank_dou(){

    }
    function prize_list(){
        
    }
    

}
?>