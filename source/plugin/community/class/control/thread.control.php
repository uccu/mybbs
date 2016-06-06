<?php
namespace plugin\community\control;
defined('IN_PLAY') || exit('Access Denied');
class thread extends \control\ajax{
    function _beginning(){
        
    }
    function _get_user(){
        return control('user:base','api');
    }
    function _get_model(){
        return model('community:thread');
    }
    function _get_tool(){
        return control('tool:other');
    }
    function _get_tag(){
        return model('community:community_tag');
    }
    function _get_modelView(){
        $t = model('community:thread_link_tag');
        $t->add_table($t->threadMap);
        return $t;
    }
    function _get_threadTag(){
        return model('community:thread_link_tag');
    }
    function _get_favourite(){
        return model('user:favourite');
    }
    function get_tag(){
        $this->user->_safe_login();
        $m = $this->tag->field(array('tid','tname'))->order('torder')->limit(9999)->select();
        $this->success($m);
    }

    function get_theme($tid=0){
        $this->user->_safe_login();
        $limit = post('limit',6,'%d');
        $tid = post('tid',$tid,'%d');
        $line = post('last',0,'%d');
        if($tid)$where['tid'] = $tid;
        $where['reply'] = 0;
        if($line)$where['last'] = array('logic',$line,'<');
        if(!$tid)$m = $this->model->where($where)->field(array('hid','title','pic','ctime','uid','last','favo','reply_num'))->order('last','DESC')->limit($limit)->select();
        else $m = $this->modelView->where($where)->field(array('hid','title','pic','ctime','uid','last','favo','reply_num'))->order(array('last'=>'DESC'))->limit($limit)->select();
        foreach($m as &$v)$v['pic'] = $v['pic']?unserialize($v['pic']):array();
        $this->success($m);
    }
    function get_detail($hid=0){
        $this->user->_safe_login();
        $limit = post('limit',6,'%d');
        $hid = post('hid',$hid,'%d');
        $line = post('ctime',0,'%d');
        if(!$hid)$this->error(401,'参数错误');
        $where0['hid'] = $hid;
        $where0['reply'] = 0;
        $where['reply'] = $hid;
        if($line)$where['ctime'] = array('logic',$line,'>');
        $this->model->add_table($this->model->userMap);
        $theme = $this->model->where($where0)->field(array('hid','title','content','pic','ctime','uid','nickname','avatar'))->find();
        $reply = $this->model->where($where)->field(array('hid','content','ctime','uid','nickname','avatar'))->order(array('ctime'))->limit($limit)->select();
        if($theme){
            $theme['pic'] = $theme['pic']?unserialize($theme['pic']):array();
            $where2['uid'] = $this->user->uid;
            $where2['hid'] = $hid;
            $theme['favo'] = $this->favourite->where($where2)->find() ? 1 : 0;
        }
        foreach($reply as &$v)$v['pic'] = $v['pic']?unserialize($v['pic']):array();
        $m = array('theme'=>$theme,'reply'=>$reply);
        $this->success($m);
    }
    function new_theme(){
        $this->user->_safe_login();
        $data['title'] = post('title');
        $data['content'] = post('content');
        $tag = post('tag');
        if(!$tag)$this->error(401,'参数错误');
        if(is_string($tag))$tag = explode(',',$tag);
        if(!is_array($tag))$this->error(401,'参数错误,TAG非数组');
        $data['pic'] = $this->tool->_up_pic('community');
        if(post('pic1'))$data['pic'] = array(post('pic1'),post('pic2'));
        if(!$data['title'] || !$data['content'])$this->error(401,'参数错误');
        $data['pic'] = serialize($data['pic']);
        $data['ctime'] = $data['last'] = time();
        $data['uid'] = $this->user->uid;
        if(!$hid = $this->model->data($data)->add())$this->error(416,'创建失败');
        foreach($tag as $t){
            $data = array('hid'=>$hid,'tid'=>$t);
            $this->threadTag->data($data)->add(true);
        }
        $array = array('hid'=>$hid);
        if($score = control('user:score','api')->_add_score_detail('发帖','thread'))
            $array['score'] = $score;
        
        //model('cache')->replace('test2',$array,'%s');
        $this->success($array);
    }
    function new_reply(){
        $this->user->_safe_login();
        $hid = post('hid');
        $data['reply'] = $hid;
        $data['content'] = post('content');
        if(!$data['reply'] || !$data['content'])$this->error(401,'参数错误');
        $data['ctime'] = time();
        $data['uid'] = $this->user->uid;
        if(!$hid2 = $this->model->data($data)->add())$this->error(416,'创建失败');
        $data = array();
        $data['reply_num'] = array('add',1);
        $data['last'] = time();
        $hid = $this->model->data($data)->save($hid);
        $array = array('hid'=>$hid);
        if($score = control('user:score','api')->_add_score_detail('回复','thread_reply'))
            $array['score'] = $score;
        $this->success($array);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>