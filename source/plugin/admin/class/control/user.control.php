<?php
namespace plugin\admin\control;
defined('IN_PLAY') || exit('Access Denied');
class user extends \control\ajax{
    function _beginning(){
        if($this->user->type<2)header('Location:/admin/login');
        table('config')->template['userType'] = $this->user->type;
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
    function _get_scoreDetail(){
        return model('user:score_detail');
    }

    function lists($page=1,$phone=0,$adviser=0){
        $where['user_type'] = 0;
        if($phone)$where['phone'] = $phone;
        if($adviser)$where['advisername'] = $adviser;
        $this->userModel->add_table(array('_table'=>array('_join'=>'LEFT JOIN','nickname'=>'advisername','_on'=>'adviser.uid=zr_user_info.adviser','_mapping'=>'adviser')));
        $maxRow= $this->userModel->where($where)->limit(99999999)->get_field();
        $maxPage = floor(($maxRow-1)/10)+1;
        table('config')->template['maxRow'] = $maxRow;
        table('config')->template['maxPage'] = $maxPage;
        table('config')->template['currentPage'] = $page;
        $list = $this->userModel->where($where)->page($page,10)->order(array('ctime'=>'DESC'))->select();
        foreach($list as &$user){
            $user['sexx'] = $user['sex']==1?'男':'女';
            $user['cdate'] = date('Y-m-d',$user['ctime']);
        }
        table('config')->template['list'] = $list;
        table('config')->template['areas'] = $this->area->field("concat(province,' ',city,' ',district) as name")->order(array('province','city','district'))->limit(9999)->select();
        table('config')->template['works'] = $this->work->limit(9999)->order('name')->select();
        table('config')->template['projects'] = $this->project->field(array('jid','jthumb','jname'))->limit(999)->order(array('jorder'))->select();
        T('admin:user/lists');
        
    }
    function del_user(){
        $uid = post('uid');
        $user = $this->userModel->find($uid);
        if(!$user)$this->error(411,'获取失败');
        if($user['user_type']>1)$this->user->_safe_type(3);
        if($user['user_type']==1)$this->userModel->where(array('adviser'=>$uid))->data(array('adviser'=>0))->save();
        $this->userModel->remove($uid);
        $this->success();
    }
    
    function get_user_detail($uid=0){
        $where['uid'] = post('uid',$uid,'%d');
        $m = $this->userModel->field(array('uid','avatar','nickname','name','sex','age','area','marry','child','plastic','email',
                'work','phone','interest','score','ctime','last_time','ip','adviser','invate'))->where($where)->find();
        $m['interest'] = !$m['interest']?array():unserialize($m['interest']);
        if(!$m)$this->error(411,'获取失败');
        $this->success($m);
    }
    function _nomethod(){
        $this->lists();
    }
    function change_info(){
        $uid = post('uid');
        $user = $this->userModel->find($uid);
        if(!$user)$this->error(411,'获取失败');
        if($user['user_type']>1 && $user['uid']!=$this->user->uid)$this->user->_safe_type(3);
        $data['avatar'] = post('avatar');
        $data['nickname'] = post('nickname');
        $data['name'] = post('name');
        $data['age'] = strtotime(post('age'));
        $data['area'] = post('area');
        $data['sex'] = post('sex');
        if($phone = post('phone')){
            if($user['phone']!=$phone)if($this->userModel->where(array('phone'=>$phone))->find())$this->error(411,'手机号重复');
            $data['phone'] = $phone;
        }
        $data['email'] = post('email');
        $data['work'] = post('work');
        $data['score'] = post('score');
        $data['invate'] = post('invate');
        $data['adviser'] = post('adviser');
        $data['marry'] = post('marry')?1:0;
        $data['diary'] = post('diary')?1:0;
        $data['plastic'] = post('plastic')?1:0;
        $data['child'] = post('child')?1:0;
        $shop = post('shop',0,'%d');
        if($shop<0)$this->error(400,'消费不允许为负数');
        $data['interest'] = array('logic',post('interest',array()),'%s');
        if($pwd = post('pwd'))$data['password'] = md5(md5($pwd).$user['salt']);
        $m = $this->userModel->data($data)->save($uid);
        $data2['stime'] = time();
        if($user['score']>$data['score']){
            $data2['type'] = 'out';
            $data2['desc'] = '管理员操作';
            $data2['score'] = $user['score']-$data['score'];
            
        }elseif($user['score']<$data['score']){
            $data2['type'] = 'in';
            $data2['desc'] = '管理员操作';
            $data2['score'] = $data['score']-$user['score'];
            
        }
        $data2['uid'] = $uid;
        $data2['rtype'] = 'admin';
        if($data2['score'])$this->scoreDetail->data($data2)->add();
        if($shop){
            $shop = floor($shop);
            control('user:score','api')->_add_score_detail('消费',$shop,'in',$uid);
            $u1 = $this->userModel->find($uid);
            if($u1['invate']){
                control('user:score','api')->_add_score_detail('好友消费',floor($shop*0.4),'in',$u1['invate']);
                $u2 = $this->userModel->find($u1['invate']);
                if($u2['invate']){
                    control('user:score','api')->_add_score_detail('二级好友消费',floor($shop*0.08),'in',$u2['invate']);
                }
            }
        }
        $this->success($m);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>