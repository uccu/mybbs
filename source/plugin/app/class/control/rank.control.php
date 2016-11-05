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
        return $all['s']?number_format($all['s']*$pe/100,2,'.',''):0;
    }
    function get_c($rank,$c,$b){
 
        $rank = floor($rank);
        if($rank==1)return number_format($c*$b[0],2,'.','');
        $rankz = $rank;
        $rankz = $rankz+$b[5]-1;
        for($i=0;$i<4;$i++){
            $rankz -= $b[5]*pow(10,$i);
            if($rankz>$b[5]*pow(10,$i+1))continue;
            if($i==4)return number_format($c*$b[$i+1]/1000,2,'.','');
            if($rankz<=$b[5]*pow(10,$i+1)*0.1){
                return number_format($c*$b[$i+1]*0.2/($b[5]*pow(10,$i+1)*.1),2,'.','');
            }elseif($rankz<=$b[5]*pow(10,$i+1)*0.3){
                return number_format($c*$b[$i+1]*0.3/($b[5]*pow(10,$i+1)*.2),2,'.','');
            }elseif($rankz<=$b[5]*pow(10,$i+1)*0.6){
                return number_format($c*$b[$i+1]*0.3/($b[5]*pow(10,$i+1)*.3),2,'.','');
            }else{
                return number_format($c*$b[$i+1]*0.2/($b[5]*pow(10,$i+1)*.4),2,'.','');
            }
        }
        if($rankz<=$b[5]*1000 && $b[4]){
            return number_format($c*$b[4]/$b[5]*10000,2,'.','');
        }
        
        return 0;
    }
    function _addCoin(&$list,$allCoin,$rule,$page=1,$limit=10){
        foreach($list as $k=>&$v){
            $rank = ($page-1)*$limit+$k+1;
            $v['rank'] = $rank;
            $b = array($rule['value1']/100,$rule['value2']/100,$rule['value3']/100,$rule['value4']/100,$rule['value5']/100,$rule['type']);
            $v['coin'] = $this->get_c($rank,$allCoin,$b);
        }
    }
    function _addtime(&$list,$aid){
        $time = model('activity')->where(array('aid'=>$aid))->get_field('stime');
        foreach($list as $k=>&$v){
            $v['time'] = !$time || $v['time'] - $time < 0 ? 0 : $v['time'] - $time;
        }
    }

    function rank_gou_count($aid){

        $allBean = $this->_allBean($aid);
        $rule = model('rule')->find(1);
        $allCoin = $z['allCoin'] = number_format($allBean*$rule['value']/100,2,'.','');
        $where['aid'] = $aid;
        $where['first'] = 1;
        $where['status'] = array('contain',array(2,3,4),'IN');
        $where['score'] = 0;
        $z['count'] = model('order')->where($where)->get_field();
        $z['allCoin_'] = 0;
        for($i=1;$i<=$z['count'];$i++)$z['allCoin_'] += $this->get_c($i,$allCoin,array($rule['value1']/100,$rule['value2']/100,$rule['value3']/100,$rule['value4']/100,$rule['value5']/100,$rule['type']));
        $z['allCoin_'] = number_format($z['allCoin_'],2,'.','');
        return $z['allCoin_'];

    }
    
    function rank_gou($aid,$page=1){
        //获取AID
        $aid = post('aid',$aid,'%d');
        if(!$aid)$aid = $this->lastAid;
        $page = post('page',$page,'%d');
        $page = floor($page);
        if($page<1)$page = 1;
        //获取活动所有乐豆
        $allBean = $z['allBean'] = $this->_allBean($aid);

        //获取当前排行的奖金
        $rule = model('rule')->find(1);
        $allCoin = $z['allCoin'] = number_format($allBean*$rule['value']/100,2,'.','');

        //获取排名
        $where['aid'] = $aid;
        $where['first'] = 1;
        $where['status'] = array('contain',array(2,3,4),'IN');
        $where['score'] = 0;
        $z['count'] = model('order')->where($where)->get_field();
        $z['allCoin_'] = 0;
        for($i=1;$i<=$z['count'];$i++)$z['allCoin_'] += $this->get_c($i,$allCoin,array($rule['value1']/100,$rule['value2']/100,$rule['value3']/100,$rule['value4']/100,$rule['value5']/100,$rule['type']));
        $z['allCoin_'] = number_format($z['allCoin_'],2,'.','');
        $z['list'] = model('order')->table(array(
            'order'=>array(
                'score','oid','uid','aid','status','pay_time'=>'time','first','_mapping'=>'o'
            ),
            'user'=>array(
                'avatar','_on'=>'uid','username','_join'=>'LEFT JOIN'
            ),
            'rank_bean'=>array(
                '_on'=>'o.uid=b.uid AND o.aid=b.aid','_mapping'=>'b','bean','_join'=>'LEFT JOIN'
            )
        ))->field(array('avatar','uid','time','aid'))->where($where)->order(array('time'))->page($page,10)->select();
        $this->_addCoin($z['list'],$allCoin,$rule,$page);
        //$this->_addtime($z['list'],$aid);


        $ke = model('activity')->find($aid);
        $z['title'] = $ke['title'];

        $where = array();
        $where['aid'] = $aid;
        $where['uid'] = $this->uid;
        $where['first'] = 1;
        $where['status'] = array('contain',array(2,3,4),'IN');
        $where['score'] = 0;
        $me = model('order')->table_first()->where($where)->order(array('time'))->find();
        if($me){
            //var_dump($me);
            unset($where['uid']);
            $where['time'] = array('logic',$me['time'],'<');
            $z['me']['rank'] = $rank = model('order')->where($where)->get_field()+1;

            $b = array($rule['value1']/100,$rule['value2']/100,$rule['value3']/100,$rule['value4']/100,$rule['value5']/100,$rule['type']);
            $z['me']['coin'] = $coin = number_format( $this->get_c($rank,$allCoin,$b) ,2,'.','');
            $z['me']['time'] = $me['time'];
        }else{
            $z['me']['rank'] = $z['me']['time'] = 0;
            $z['me']['coin'] = '0.00';
        }
        $z['me']['uid'] = $this->userInfo['uid'];
        $z['me']['avatar'] = $this->userInfo['avatar'];
        $z['me']['aid'] = $aid;
        $this->success($z);
    }

    function rank_xiang_count($aid){
        $allBean = $z['allBean'] = $this->_allBean($aid);
        $rule = model('rule')->find(2);
        $allCoin = $z['allCoin'] = number_format($allBean*$rule['value']/100,2,'.','');
        $where['aid'] = $aid;
        $where['share_first'] = 1;
        $where['status'] = array('contain',array(2,3,4),'IN');
        $where['score'] = 0;
        $where['referee'] = array('logic',0,'!=');
        $z['count'] = model('order')->where($where)->get_field();
        $z['allCoin_'] = 0;
        for($i=1;$i<=$z['count'];$i++)$z['allCoin_'] += $this->get_c($i,$allCoin,array($rule['value1']/100,$rule['value2']/100,$rule['value3']/100,$rule['value4']/100,$rule['value5']/100,$rule['type']));
        $z['allCoin_'] = number_format($z['allCoin_'],2,'.','');
        return $z['allCoin_'];
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
        $allCoin = $z['allCoin'] = number_format($allBean*$rule['value']/100,2,'.','');

        //获取排名
        $where['aid'] = $aid;
        $where['share_first'] = 1;
        $where['status'] = array('contain',array(2,3,4),'IN');
        $where['score'] = 0;
        $where['referee'] = array('logic',0,'!=');
        $z['count'] = model('order')->where($where)->get_field();
        $z['allCoin_'] = 0;
        for($i=1;$i<=$z['count'];$i++)$z['allCoin_'] += $this->get_c($i,$allCoin,array($rule['value1']/100,$rule['value2']/100,$rule['value3']/100,$rule['value4']/100,$rule['value5']/100,$rule['type']));
        $z['allCoin_'] = number_format($z['allCoin_'],2,'.','');
        $z['list'] = model('order')->table(array(
            'order'=>array(
                'score','oid','aid','referee'=>'uid','status','pay_time'=>'time','share_first','_mapping'=>'o'
            ),
            'user'=>array(
                'avatar','_on'=>'o.referee=u.uid','username','_join'=>'LEFT JOIN','_mapping'=>'u'
            ),
            'rank_bean'=>array(
                '_on'=>'o.referee=b.uid AND o.aid=b.aid','_mapping'=>'b','bean','_join'=>'LEFT JOIN'
            )
        ))->field(array('avatar','uid','time','aid'))->where($where)->order(array('time'))->page($page,10)->select();
        $this->_addCoin($z['list'],$allCoin,$rule,$page);
        //$this->_addtime($z['list'],$aid);
        $ke = model('activity')->find($aid);
        $z['title'] = $ke['title'];



        $where = array();
        $where['aid'] = $aid;
        $where['uid'] = $this->uid;
        $where['share_first'] = 1;
        $where['status'] = array('contain',array(2,3,4),'IN');
        $where['score'] = 0;
        $me = model('order')->table_first()->where($where)->order(array('time'))->find();
        if($me){
            unset($where['uid']);
            $where['time'] = array('logic',$me['time'],'<');
            $z['me']['rank'] = $rank = model('order')->where($where)->get_field()+1;
            $b = array($rule['value1']/100,$rule['value2']/100,$rule['value3']/100,$rule['value4']/100,$rule['value5']/100,$rule['type']);
            $z['me']['coin'] = $coin = number_format( $this->get_c($rank,$allCoin,$b) ,2,'.','');
            $z['me']['time'] = $me['time'];
        }else{
            $z['me']['rank'] = $z['me']['time'] = 0;
            $z['me']['coin'] = '0.00';
        }
        $z['me']['uid'] = $this->userInfo['uid'];
        $z['me']['avatar'] = $this->userInfo['avatar'];
        $z['me']['aid'] = $aid;


        $this->success($z);
    }

    function rank_bang_count($aid){
        $allBean = $z['allBean'] = $this->_allBean($aid);

        //获取当前排行的奖金
        $rule = model('rule')->find(3);
        $allCoin = $z['allCoin'] = number_format($allBean*$rule['value']/100,2,'.','');

        $where['aid'] = post('aid',$aid);
        $z['count'] = model('rank_bang')->where($where)->get_field();
        $z['allCoin_'] = 0;
        for($i=1;$i<=$z['count'];$i++)$z['allCoin_'] += $this->get_c($i,$allCoin,array($rule['value1']/100,$rule['value2']/100,$rule['value3']/100,$rule['value4']/100,$rule['value5']/100,$rule['type']));
        $z['allCoin_'] = number_format($z['allCoin_'],2,'.','');
        return $z['allCoin_'];

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
        $allCoin = $z['allCoin'] = number_format($allBean*$rule['value']/100,2,'.','');

        $where['aid'] = post('aid',$aid);
        $z['count'] = model('rank_bang')->where($where)->get_field();
        $z['allCoin_'] = 0;
        for($i=1;$i<=$z['count'];$i++)$z['allCoin_'] += $this->get_c($i,$allCoin,array($rule['value1']/100,$rule['value2']/100,$rule['value3']/100,$rule['value4']/100,$rule['value5']/100,$rule['type']));
        $z['allCoin_'] = number_format($z['allCoin_'],2,'.','');
        $z['list'] = model('rank_bang')->add_table(array(
            'user'=>array(
                'avatar','_on'=>'uid','_join'=>'LEFT JOIN'
            ),
        ))->field(array('avatar','uid','time','aid'))->where($where)->order(array('time'))->page($page,10)->select();
        $this->_addCoin($z['list'],$allCoin,$rule,$page);
        //$this->_addtime($z['list'],$aid);
        $ke = model('activity')->find($aid);
        $z['title'] = $ke['title'];



        $where = array();
        $where['aid'] = $aid;
        $where['uid'] = $this->uid;
        $me = model('rank_bang')->where($where)->find();
        if($me){
            unset($where['uid']);
            $where['time'] = array('logic',$me['time'],'<');
            $z['me']['rank'] = $rank = model('rank_bang')->where($where)->get_field()+1;
            $b = array($rule['value1']/100,$rule['value2']/100,$rule['value3']/100,$rule['value4']/100,$rule['value5']/100,$rule['type']);
            $z['me']['coin'] = $coin = number_format( $this->get_c($rank,$allCoin,$b) ,2,'.','');
            $z['me']['time'] = $me['time'];
        }else{
            $z['me']['rank'] = $z['me']['time'] = 0;
            $z['me']['coin'] = '0.00';
        }
        $z['me']['uid'] = $this->userInfo['uid'];
        $z['me']['avatar'] = $this->userInfo['avatar'];
        $z['me']['aid'] = $aid;

        $this->success($z);
    }

    function rank_dou_count($aid){
        $allBean = $z['allBean'] = $this->_allBean($aid);

        //获取当前排行的奖金
        $rule = model('rule')->find(4);
        $allCoin = $z['allCoin'] = number_format($allBean*$rule['value']/100,2,'.','');

        $where['aid'] = post('aid',$aid);
        $z['count'] = model('rank_bean')->where($where)->get_field();
        $z['allCoin_'] = 0;
        for($i=1;$i<=$z['count'];$i++)$z['allCoin_'] += $this->get_c($i,$allCoin,array($rule['value1']/100,$rule['value2']/100,$rule['value3']/100,$rule['value4']/100,$rule['value5']/100,$rule['type']));
        $z['allCoin_'] = number_format($z['allCoin_'],2,'.','');
        return $z['allCoin_'];
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
        $allCoin = $z['allCoin'] = number_format($allBean*$rule['value']/100,2,'.','');

        $where['aid'] = post('aid',$aid);
        $z['count'] = model('rank_bean')->where($where)->get_field();
        $z['allCoin_'] = 0;
        for($i=1;$i<=$z['count'];$i++)$z['allCoin_'] += $this->get_c($i,$allCoin,array($rule['value1']/100,$rule['value2']/100,$rule['value3']/100,$rule['value4']/100,$rule['value5']/100,$rule['type']));
        $z['allCoin_'] = number_format($z['allCoin_'],2,'.','');
        $z['list'] = model('rank_bean')->add_table(array(
            'user'=>array(
                'avatar','_on'=>'uid','_join'=>'LEFT JOIN'
            ),
        ))->field(array('avatar','uid','bean','aid'))->where($where)->order(array('bean'=>'DESC'))->page($page,10)->select();
        $this->_addCoin($z['list'],$allCoin,$rule,$page);
        $ke = model('activity')->find($aid);
        $z['title'] = $ke['title'];



        $where = array();
        $where['aid'] = $aid;
        $where['uid'] = $this->uid;
        $me = model('rank_bean')->where($where)->find();
        if($me){
            unset($where['uid']);
            $where['bean'] = array('logic',$me['bean'],'>');
            $z['me']['rank'] = $rank = model('rank_bean')->where($where)->get_field()+1;
            $b = array($rule['value1']/100,$rule['value2']/100,$rule['value3']/100,$rule['value4']/100,$rule['value5']/100,$rule['type']);
            $z['me']['coin'] = $coin = number_format( $this->get_c($rank,$allCoin,$b) ,2,'.','');
            $z['me']['bean'] = $me['bean'];
        }else{
            $z['me']['rank'] = $z['me']['time'] = 0;
            $z['me']['coin'] = '0.00';
        }
        $z['me']['uid'] = $this->userInfo['uid'];
        $z['me']['avatar'] = $this->userInfo['avatar'];
        $z['me']['aid'] = $aid;
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
            $z['gou']['coin'] = $coin = number_format( $this->get_c($rank,$allCoin,$b) ,2,'.','');

            
            $z['gou']['time'] = $me['pay_time'];
        }else{
            $z['gou']['rank'] = $z['gou']['time'] = 0;
            $z['gou']['coin'] = '0.00';
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
            $z['xiang']['coin'] = $coin = number_format( $this->get_c($rank,$allCoin,$b) ,2,'.','');
            $z['xiang']['time'] = $me['pay_time'];
        }else{
            $z['xiang']['rank'] = $z['xiang']['time'] = 0;
            $z['xiang']['coin'] = '0.00';
        }
        unset($where['pay_time']);
        $where['referee'] = array('logic','0','!=');
        $where['uid'] = $this->uid;
        $me = model('order')->field('distinct referee')->where($where)->limit(9999)->select();
        foreach($me as $v)if($v['referee']){
            $tr = $this->_xiang($aid,$v['referee']);
            $z['xiang_x']['coin'] += $tr['xiang']['coin']/2;
        }
        $z['xiang_x']['coin'] = number_format($z['xiang_x']['coin'],2,'.','');

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
            $z['bang']['coin'] = $coin = number_format( $this->get_c($rank,$allCoin,$b) ,2,'.','');
            $z['bang']['time'] = $me['time'];
        }else{
            $z['bang']['rank'] = $z['bang']['time'] = 0;
            $z['bang']['coin'] = '0.00';
        }
        $where = array();
        $where['aid'] = $aid;
        $where['uid'] = $this->uid;
        $where['status'] = array('contain',array(2,3,4),'IN');
        $where['score'] = 0;
        $where['referee'] = array('logic','0','!=');
        $me = model('order')->field('distinct referee')->where($where)->limit(9999)->select();
        foreach($me as $v)if($v['referee']){
            $tr = $this->_bang($aid,$v['referee']);
            $z['bang_x']['coin'] += $tr['bang']['num']?$tr['bang']['coin']/2/$tr['bang']['num']:0;
        }
        $z['bang_x']['coin'] = number_format($z['bang_x']['coin'],2,'.','');


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
            $z['bean']['coin'] = $coin = number_format( $this->get_c($rank,$allCoin,$b) ,2,'.','');
            $z['bean']['bean'] = $me['bean'];
        }else{
            $z['bean']['rank'] =  $z['bean']['bean'] = 0;
            $z['bean']['coin'] = '0.00';
        }

        



        $z['avatar'] = $this->userInfo['avatar'];
        $z['uid'] = $this->uid;
        $z['allCoin'] = number_format($z['gou']['coin']+
        $z['xiang']['coin']+$z['bang']['coin']+
        $z['xiang_x']['coin']+$z['bang_x']['coin']+
        $z['bean']['coin'],2,'.','');
        $this->success($z);

    }

    function my_xiang_list($aid){
        $this->_check_login();
        $aid = post('aid',$aid,'%d');
        if(!$aid)$aid = $this->lastAid;
        $where['aid'] = $aid;
        $where['share_first'] = 1;
        $where['status'] = array('contain',array(2,3,4),'IN');
        $where['score'] = 0;
        $where['referee'] = $this->uid;
        $q['list'] = model('order')->add_table(array(
            'user'=>array(
                '_on'=>'uid','avatar','username'
            )
        ))->where($where)->limit(999)->select();
        if(!$q['list'])$this->errorCode(427);
        $this->success($q);
    }
    function my_bang_list($aid){
        $this->_check_login();
        $aid = post('aid',$aid,'%d');
        if(!$aid)$aid = $this->lastAid;
        $where['aid'] = $aid;
        $where['referee_first'] = 1;
        $where['status'] = array('contain',array(2,3,4),'IN');
        $where['score'] = 0;
        $where['referee'] = $this->uid;
        $q['list'] = model('order')->add_table(array(
            'user'=>array(
                '_on'=>'uid','avatar','username'
            )
        ))->where($where)->order(array('pay_time'))->limit(999)->select();
        if(!$q['list'])$this->errorCode(427);
        $this->success($q);
    }
    function my_dou_list($aid){
        $this->_check_login();
        $aid = post('aid',$aid,'%d');
        if(!$aid)$aid = $this->lastAid;
        $where['referee_first'] = 1;
        $where['status'] = array('contain',array(2,3,4),'IN');
        $where['score'] = 0;
        $uid = $this->uid;
        $q['list'] = model('logic')->fetch_all(
            "SELECT o1.*,u.username,u.avatar FROM `tuan_order` o1 
            inner join tuan_user u on o1.uid = u.uid 
            WHERE ( o1.referee = $uid ) AND o1.aid = $aid AND o1.status IN (2,3,4) AND o1.score = 0 ORDER BY o1.pay_time");


        $myd = model('rank_bean')->where(array('uid'=>$this->uid,'aid'=>$aid))->find();
        if(!$myd)$myd = array('bean'=>0);
        $myd['avatar'] = $this->userInfo['avatar'];
        $myd['username'] = $this->userInfo['username'];
        $bean = 0;
        foreach($q['list'] as $v)$bean +=$v['bean'];
        $myd['bean'] -= $bean;
        $q['me'] = $myd;
        $this->success($q);
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
        $allBean = $z['allBean'] = $this->_allBean($aid);
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
    
    function activity_list(){
        $now = TIME_NOW;
        $where = "etime<$now";
        $z = model('activity')->where($where)->limit(999)->order(array('stime'=>'DESC'))->select();
        foreach($z as &$v)$v['time'] = TIME_NOW;
        $q['last'] = $z;
        if(!$q['last'])$this->errorCode(427);
        $this->success($q);
    }
    

}
?>