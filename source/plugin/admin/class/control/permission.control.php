<?php
namespace plugin\admin\control;
defined('IN_PLAY') || exit('Access Denied');
class permission extends \control\ajax{
    function _beginning(){
        if($this->user->type<2)header('Location:/admin/login');
        table('config')->template['userType'] = $this->user->type;
        table('config')->template['uid'] = $this->user->uid;
    }
    function _get_user(){
        return control('user:base','api');
    }
    function _get_model(){
        return model('common:opition');
    }
    function _get_userModel(){
        return model('user:user_info');
    }
    function _get_project(){
        return model('project:project');
    }
    function _get_area(){
        return model('tool:area');
    }
    function _get_work(){
        return model('tool:work_list');
    }


    function lists($page=1){
        if($this->user->type<3)$where['uid'] = $this->user->uid;
        $where['user_type'] = array('logic',1,'>');
        //$this->userModel->add_table(array('_table'=>array('_join'=>'LEFT JOIN','nickname'=>'advisername','_on'=>'adviser.uid=zr_user_info.adviser','_mapping'=>'adviser')));
        $maxRow= $this->userModel->where($where)->limit(99999999)->get_field();
        $maxPage = floor(($maxRow-1)/10)+1;
        table('config')->template['maxRow'] = $maxRow;
        table('config')->template['maxPage'] = $maxPage;
        table('config')->template['currentPage'] = $page;
        $list = $this->userModel->where($where)->page($page,10)->select();
        foreach($list as &$user){
            $user['sexx'] = $user['sex']==1?'男':'女';
            $user['cdate'] = date('Y-m-d',$user['ctime']);
        }
        table('config')->template['list'] = $list;
        T('admin:permission/lists');
        
    }
    function add_permission(){
        $this->user->_safe_type(3);
        $ss = 'abscefghijkimnopqrstuvwxyz1234567890';
        for($i=0;$i<5;$i++)$salt .=$ss[rand(0,35)];
        $pwd = md5(md5('123456').$salt);
        $time = time();
        $data['phone'] = '1'.time();
        $data['password'] = $pwd;
        $data['ctime'] = $time;
        $data['salt'] = $salt;
        $data['avatar'] = 'noavatar.png';
        $data['user_type'] = 2;
        $data['nickname'] = '顾问_'.$time;
        $data['avatar'] = 'noavatar.png';
        if(!$rr = $this->userModel->data($data)->add())
            $this->error(404,'创建失败');

        $this->success();
    }

    function _nomethod(){
        $this->lists();
    }

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>