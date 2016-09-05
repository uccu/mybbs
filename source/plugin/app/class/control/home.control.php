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
        $q = array_merge($q,$this->recommand());
        $this->success($q);
    }
    function activity(){
        $now = TIME_NOW;
        $where['zz'] = 'stime<$now AND etime>$now';
        $z = model('activity')->where($where)->find();
        $q['activityInfo'] = $z;
        if($z){
            $where2['stime'] = array('logic',$z['stime'],'>');
            $z2 = model('activity')->where($where2)->order(array('stime'))->find();
        }else{
            $where2['stime'] = array('logic',$now,'>');
            $z2 = model('activity')->where($where2)->order(array('stime'))->find();
        }
        $q['nextActivityInfo'] = $z2;
        // if($z2){
        //     $where3['stime'] = array('logic',$z2['stime'],'>');
        //     $z3 = model('activity')->where($where3)->order(array('stime'))->limit(999)->select();
        // }else{
        //     $z3 = array();
        // }
        // $q['previewActivityList'] = $z3;
        if($this->out)$this->success($q);
        return $q;
    }
    function recommand(){
        $where['recommand'] = 1;
        $z = model('activity')->where($where)->limit(4)->select();
        $q['recommandList'] = array();
        if($this->out)$this->success($q);
        return $q;
    }
    function recommand_c(){
        $where['recommand'] = 1;
        $page = post('page',2);
        $z = model('activity')->where($where)->page($page,4)->select();
        $q['recommandList'] = array();
        if($this->out)$this->success($q);
        return $q;
    }

}
?>