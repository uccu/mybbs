<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class home extends base\basic{
    private $out = true;
    function _beginning(){
        

    }
    function banner(){
        $z = model('banner')->limit(999)->select();
        if(!$z)$this->errorCode(427);
        $q['bannerList'] = $z;
        if($this->out)$this->success($q);
        return $q;
    }
    function nav(){
        $z = model('nav')->limit(999)->select();
        if(!$z)$this->errorCode(427);
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
        }
        if($this->out)$this->success($q);
        return $q;
    }
    function recommend(){
        $where['recommend'] = 1;
        $where['del'] = 1;
        $q['recommendList'] = model('goods')->where($where)->limit(4)->select();
        if(!$q['recommendList'])$this->errorCode(427);
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

}
?>