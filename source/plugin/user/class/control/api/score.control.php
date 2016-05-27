<?php
namespace plugin\user\control\api;
defined('IN_PLAY') || exit('Access Denied');
class score extends \control\ajax{
    function _beginning(){
        $this->user->_safe_login();
    }
    function _get_user(){
        return control('user:base','api');
    }
    function _get_model(){
        return model('user:user_info');
    }
    function _get_work(){
        return model('tool:work_list');
    }
    function _get_thread(){
        return model('community:thread');
    }
    function _get_favourite(){
        return model('user:favourite');
    }
    function _get_gift(){
        return model('user:gift');
    }
    function _get_project(){
        return model('project:project');
    }
    function _get_feedback(){
        return model('user:feedback');
    }
    function _get_scoreDetail(){
        return model('user:score_detail');
    }
    function _get_tool(){
        return control('tool:other');
    }
    
    function _add_score_detail($desc,$score,$type='in'){
        if(!$score)return;
        $type=$type=='out'?'out':'in';
        $user = $this->model->find($this->user->uid);
        if($type=='out' && $score>$user['score'])$this->error(421,'积分不够');
        $data2['score'] = array('add',($type=='out'?-1:1)*$score);
        $this->model->data($data2)->save($this->user->uid);
        $data['stime'] = time();
        $data['type'] = $type;
        $data['desc'] = $desc;
        $data['score'] = $score;
        $data['uid'] = $this->user->uid;
        return $this->scoreDetail->data($data)->add();
    }
    
    
}

?>