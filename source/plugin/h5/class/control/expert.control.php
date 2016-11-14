<?php
namespace plugin\h5\control;
use plugin\app\control\base\e;
defined('IN_PLAY') || exit('Access Denied');
class expert extends e{
    

    function lists($search = ''){

        if($search)$where['nametrue'] = array('contain','%'.$search.'%','LIKE');

        $this->g->template['list'] = model('user')->where($where)->limit(999)->select();

        $this->g->template['title'] = '专家列表';

        T('expert/lists');

    }


    function info($uid = 0){

        $user = model('user')->find($uid);

        if(!$user)return;

        $user['thumb'] = $this->imgDir.$user['thumb'];
        $this->g->template['fans'] = model('fans')->where(array('uid'=>$uid))->get_field();
        $this->g->template['follow'] = model('fans')->where(array('fans_id'=>$uid))->get_field();

        $this->g->template['inquiry'] = model('inquiry')->where(array('uid'=>$uid))->get_field();
        $this->g->template['answer'] = model('inquiry_list')->where(array('uid'=>$uid))->get_field();

        $this->g->template['info'] = $user;
        $this->g->template['title'] = '专家详情';

        T('expert/info');

    }


}
?>