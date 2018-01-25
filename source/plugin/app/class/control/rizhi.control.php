<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class rizhi extends base\e{
    function _beginning(){
        $this->_check_login();
    }

    /** 工作日志列表
     * logList
     * @param mixed $eid 
     * @param mixed $page 
     * @param mixed $limit 
     * @return mixed 
     */
    function logList($eid = 0,$page = 1,$limit = 20){

        $eid = post('eid',$eid,'%d');
        $page = post('page',$page,'%d');
        $limit = post('limit',$limit,'%d');

        if($eid)$where['eid'] = $eid;

        $list = model('work_log')->where($where)->order(['create_time'=>'desc'])->page($page,$limit)->select();

        foreach($list as &$v){
            $user = model('user')->find($v['user_id']);
            $v['user_type']  = $user['gid']?$user['gid']:'0';
            $v['user_name']  = $user['nametrue']?$user['nametrue']:'';
            $v['user_avatar']  = $user['avatar']?$user['avatar']:'';
            $v['followed'] = $this->_check_follow($v['uid']);
            $v['type'] = $user['type']?$user['type']:'';
        }

        $out['list'] = $list;

        $this->success($out);


    }


    /** 我的工作日志列表
     * logList
     * @param mixed $eid 
     * @param mixed $page 
     * @param mixed $limit 
     * @return mixed 
     */
    function myLogList($page = 1,$limit = 20,$open = 1){

        $page = post('page',$page,'%d');
        $limit = post('limit',$limit,'%d');
        $open = post('open',$open,'%d');

        $where['user_id'] = $this->uid;
        $where['open'] = $open;

        $list = model('work_log')->where($where)->order(['create_time'=>'desc'])->page($page,$limit)->select();

        foreach($list as &$v){
            $user = model('user')->find($v['user_id']);
            $v['user_type']  = $user['gid']?$user['gid']:'0';
            $v['user_name']  = $user['nametrue']?$user['nametrue']:'';
            $v['user_avatar']  = $user['avatar']?$user['avatar']:'';
            $v['followed'] = $this->_check_follow($v['uid']);
            $v['type'] = $user['type']?$user['type']:'';
        }

        $out['list'] = $list;

        $this->success($out);


    }


    function logInfo($id){

        $id = post('id',$id,'%d');
        $where['id'] = $id;

        $list = model('work_log')->where($where)->limit(1)->select();

        foreach($list as &$v){
            $user = model('user')->find($v['user_id']);
            $v['user_type']  = $user['gid']?$user['gid']:'0';
            $v['user_name']  = $user['nametrue']?$user['nametrue']:'';
            $v['user_avatar']  = $user['avatar']?$user['avatar']:'';
            $v['followed'] = $this->_check_follow($v['uid']);
            $v['type'] = $user['type']?$user['type']:'';
        }

        if(!$list)$this->error('查询失败');

        $out['info'] = $list[0];

        $this->success($out);


    }

    function delMyLog($id){

        $id = post('id',$id,'%d');
        $where['id'] = $id;

        $info = model('work_log')->where($where)->find();

        if(!$info)$this->error('日志不存在');
        if($info->user_id != $this->uid)$this->error('不是日志的发布者，无法删除');

        model('work_log')->where($where)->remove();
        $this->success();
    }


    function addLog($name = '',$content = '',$open = 1){

        $name = post('name',$name);
        $content = post('content',$content);
        $open = post('open',$open,'%d');

        if(!$name || !$content){
            $this->error('标题和内容不能为空');
        }

        $data['name'] = $name;
        $data['content'] = $content;
        $data['open'] = $open;
        $data['eid'] = $this->userInfo['bid'];
        $data['create_time'] = TIME_NOW;

        model('work_log')->data($data)->add();

        $this->success();

    }

    function updMyLog($id,$name = '',$content = '',$open = -1){

        $name = post('name',$name);
        $content = post('content',$content);
        $open = post('open',$open,'%d');


        $id = post('id',$id,'%d');
        $where['id'] = $id;

        $info = model('work_log')->where($where)->find();

        if(!$info)$this->error('日志不存在');
        if($info->user_id != $this->uid)$this->error('不是日志的发布者，无法编辑');

        if($name)$data['name'] = $name;
        if($content)$data['content'] = $content;
        if($open != -1)$data['open'] = $open;

        model('work_log')->data($data)->save($id);

        $this->success();

    }

}
?>