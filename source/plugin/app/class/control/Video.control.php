<?php
namespace plugin\app\control;
defined('IN_PLAY') || die('Access Denied');
class Video extends api\ajax{
    function _beginning(){
        
    }

    function _video($vid){
        return model('app:Video')->find($vid);
    }
    function index($vid){
        $video = $this->g->template['video'] = $this->_video($vid);
        if(!$video)$this->error(401,'视频不存在');
        T('Video');
    }
    function create($title){
        $this->user->_safe_login();
        $title = $data['title'] = post('title',$title);
        if(!$title)$this->error(401,'标题不允许为空');
        $addr = post('addr','');
        if(!$addr)$this->error(401,'FLASH地址不允许为空');
        $data['iframe'] = '<p style="text-align: center;"><embed type="application/x-shockwave-flash" class="edui-faked-video" pluginspage="http://www.macromedia.com/go/getflashplayer" src="'.
        $addr.'" width="900" height="600" wmode="transparent" play="true" loop="false" menu="false" allowscriptaccess="never" allowfullscreen="true"/></p>';
        
        $img = control('tool:upload','picture')->_get_srcs();
        if($img)$data['thumb'] = $img['e'];
        else $data['thumb'] = 'no_video_thumb';
        $data['uid'] = $this->user->uid;
        $data['tid'] = $this->user->tid;
        $data['ctime'] = TIME_NOW;
        $vid = model('video')->data($data)->add();
        $array['vid'] = $vid;
        $this->success($array);
    }
    function update(){
        $this->g->template['title'] = '个人中心-视频上传';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        T('video/update');
    }
    function delete($id){
        $where['vid'] = $id = post('vid',$id);
        $video = model('video')->find($id);
        if(!$video)$this->success(array('count'=>0));
        $this->user->_safe_right($video['uid']);
        $c = model('video')->remove($id);
        $this->success(array('count'=>$c));
    }
    function lists($uid){
        $where['uid'] = $uid?$uid:$this->user->uid;
        $this->g->template['list'] = model('video')->where($where)->limit(9999)->select();
        $this->g->template['thisuid'] = $where['uid'];
        $this->g->template['title'] = '视频列表';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        T('video/lists');
    }
    function teamlists($tid){
        $where['tid'] = $tid;
        $this->g->template['list'] = model('video')->where($where)->limit(9999)->select();
        $this->g->template['thisuid'] = -1;
        $this->g->template['title'] = '视频列表';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        T('video/teamlists');
    }
    function admin(){
        $this->user->_safe_login();
        $where['uid'] = $this->user->uid;
        $this->g->template['list'] = model('video')->where($where)->limit(9999)->select();
        $this->g->template['title'] = '个人中心-视频管理';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        T('video/admin');
    }
}




?>