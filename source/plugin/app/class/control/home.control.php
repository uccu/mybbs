<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class home extends base\basic{
    private $out = true;
    function _beginning(){
        //测试
        if(!$_POST)$_POST = $_GET;


    }
    function banner(){
        $z = model('banner')->limit(999)->select();
        $q['bannerList'] = $z;
        if($this->out)$this->success($q);
    }
    function nav(){
        $z = model('nav')->limit(999)->select();
        $q['navList'] = $z;
        if($this->out)$this->success($q);
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
        if($z2){
            $where3['stime'] = array('logic',$z2['stime'],'>');
            $z3 = model('activity')->where($where3)->order(array('stime'))->limit(999)->select();
        }else{
            $z3 = array();
        }
        $q['previewActivityList'] = $z3;
        if($this->out)$this->success($q);
    }
    function recommand(){
        $where['recommand'] = 1;
        $z = model('activity')->where($where)->limit(999)->select();
        $q['recommandList'] = array();
        if($this->out)$this->success($q);
    }

}
?>