<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class home extends base\basic{
    private $out = true;
    function _beginning(){
        

    }
    function banner(){
        $z = model('banner')->limit(999)->select();
        $q['bannerList'] = $z;
        if($this->out)$this->success($q);
        return $q;
    }
    function nav(){
        $z = model('nav')->limit(999)->select();
        $q['navList'] = $z;
        if($this->out)$this->success($q);
        return $q;
    }
    function home(){
        $this->out = false;
        $q = array();
        $q = array_merge($q,$this->banner());
        $q = array_merge($q,$this->nav());
        $q = array_merge($q,$this->activity());
        $q = array_merge($q,$this->recommend());
        $this->success($q);
    }
    function activity(){
        $now = TIME_NOW;
        $where['zz'] = 'stime<$now AND etime>$now';
        $z = model('activity')->where($where)->find();
        $q['activityInfo'] = $z;
        if($z){
            $q['activityInfo']['message'] = '总奖金100W';
            $where2['stime'] = array('logic',$z['stime'],'>');
            $z2 = model('activity')->where($where2)->order(array('stime'))->find();
        }else{
            $where2['stime'] = array('logic',$now,'>');
            $z2 = model('activity')->where($where2)->order(array('stime'))->find();
        }
        $q['nextActivityInfo'] = $z2;
         if($z2){
             $q['nextActivityInfo']['message'] = '总关注100W';
        //     $where3['stime'] = array('logic',$z2['stime'],'>');
        //     $z3 = model('activity')->where($where3)->order(array('stime'))->limit(999)->select();
        // }else{
        //     $z3 = array();
        }
        // $q['previewActivityList'] = $z3;
        if($this->out)$this->success($q);
        return $q;
    }
    function recommend(){
        $where['recommend'] = 1;
        $z = model('goods')->where($where)->limit(4)->select();
        $q['recommendList'] = array();
        if($this->out)$this->success($q);
        return $q;
    }
    function recommend_c(){
        $where['recommend'] = 1;
        $page = post('page',2);
        $z = model('goods')->where($where)->page($page,4)->select();
        $q['recommendList'] = array();
        if($this->out)$this->success($q);
        return $q;
    }

}
?>