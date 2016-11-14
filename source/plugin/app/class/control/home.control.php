<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class home extends base\basic{
    private $out = true;
    function _beginning(){
        

    }
    function _allBean($aid){
        $all = model('order')->field('SUM(`bean`) as `s`')->where(array(
            'aid'=>$aid,
            'status'=>array('contain',array(2,3,4),'IN'),
        ))->find();
        $pe = model('cache')->get('percent');
        return $all['s']?$all['s']*$pe/100:0;
    }
    function _allMoney($aid){
        $all = model('order')->field('SUM(`money`) as `s`')->where(array(
            'aid'=>$aid,
            'status'=>array('contain',array(2,3,4),'IN'),
        ))->find();
        return $all['s']?number_format($all['s'],2):0;
    }

    function _allMoney2($aid){
        $c = 0;

        $c += control('rank')->rank_gou_count($aid);
        $c += control('rank')->rank_xiang_count($aid);
        $c += control('rank')->rank_bang_count($aid);
        $c += control('rank')->rank_dou_count($aid);
        

        return number_format($c,2);
    }
    function _allFans($aid){
        $all = model('fans')->where(array(
            'aid'=>$aid))->get_field();
        return $all;
    }
    function _allpeople($aid){
        $where['aid'] = $aid;
        $where['first'] = 1;
        $where['status'] = array('contain',array(2,3,4),'IN');
        $where['score'] = 0;
        return model('order')->where($where)->get_field();
    }
    function banner(){
        $z = model('banner')->limit(999)->select();
        //if(!$z)$this->errorCode(427);
        $q['bannerList'] = $z;
        if($this->out)$this->success($q);
        return $q;
    }
    function nav(){
        $z = model('nav')->limit(999)->select();
        //if(!$z)$this->errorCode(427);
        $q['navList'] = $z;
        if($this->out)$this->success($q);
        return $q;
    }
    function home(){
        $this->out = false;
        $q = array();
        $q = array_merge($q,$this->banner());
        $q = array_merge($q,$this->nav());
        
        $q = array_merge($q,$this->recommend());
        $q = array_merge($q,$this->activity());
        $q['message'] = $this->uid<1?0:control('my')->_has_message();
        $this->success($q);
    }
    function forward(){
        $now = TIME_NOW;
        $where = "stime<$now AND stime+ktime*3600>$now";
        $z = model('activity')->where($where)->find();
        $z['time'] = TIME_NOW;
        $q['now'] = $now;
        $q['activityInfo'] = $z;

        $where = "etime<$now";
        $z = model('activity')->where($where)->limit(999)->order(array('stime'=>'DESC'))->select();
        foreach($z as &$v)$v['time'] = TIME_NOW;
        $q['last'] = $z;

        $where = "stime>$now";
        $z = model('activity')->where($where)->limit(999)->order(array('stime'))->select();
        foreach($z as &$v)$v['time'] = TIME_NOW;
        $q['next'] = $z;

        $this->success($q);
    }
    function activity(){
        $now = TIME_NOW;
        $where = "stime<$now AND stime+ktime*3600>$now";
        $z = model('activity')->where($where)->limit(1)->select();
        $q['activityInfo'] = $z;
        if($z){
            $q['activityInfo'][0]['time'] = TIME_NOW;
            $q['activityInfo'][0]['message'] = '总销售'.$this->_allMoney($z[0]['aid']).'元，参团'.$this->_allpeople($z[0]['aid']).'人，奖金'.$this->_allMoney2($z[0]['aid']).'元';
            $where2['stime'] = array('logic',$z[0]['stime'],'>');
            $z2 = model('activity')->where($where2)->order(array('stime'))->limit(9999)->select();
        }else{
            $where2['stime'] = array('logic',$now,'>');
            $z2 = model('activity')->where($where2)->order(array('stime'))->limit(9999)->select();
        }
        $q['nextActivityInfo'] = $z2;
        if($z2){
            foreach($q['nextActivityInfo'] as &$v){
                $v['time'] = TIME_NOW;
                $v['message'] = '';
            }
            
        }
        if($this->out)$this->success($q);
        return $q;
    }
    function recommend(){
        $where['recommend'] = 1;
        $where['del'] = 1;
        $q['recommendList'] = model('goods')->where($where)->limit(4)->select();
        //if(!$q['recommendList'])$this->errorCode(427);
        if($this->out)$this->success($q);
        return $q;
    }
    function recommend_c(){
        $where['recommend'] = 1;
        $where['del'] = 1;
        $page = post('page',2);
        $q['recommendList'] = model('goods')->where($where)->page($page,4)->select();
        if(!$q['recommendList'])$this->errorCode(427);
        if($this->out)$this->success($q);
        return $q;
    }
    function profession(){
        $z['list'] = model('profession')->limit(999)->select();
        $this->success($z);
    }
    function share($type=0){
        $type = post('type',$type);
        if($type){
            $z['share_title'] = model('cache')->get('share_title_1');
            $z['share_content'] = model('cache')->get('share_content_1');
        }else{
            $z['share_title'] = model('cache')->get('share_title');
            $z['share_content'] = model('cache')->get('share_content');
        }
        $this->success($z);
    }


    function android(){
   
        $z['android_id'] = model('cache')->get('android_id');
        $z['android_download'] = model('cache')->get('android_download');
       
        $this->success($z);
    }

}
?>