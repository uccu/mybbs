<?php
namespace plugin\user\control;
defined('IN_PLAY') || exit('Access Denied');
class center extends \control\ajax{
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
    function _get_reservationView(){
        $m = model('project:reservation');
        $m->add_table($m->storeMap);
        $m->add_table($m->expertMap);
        return $m;
    }
    function change_avatar(){
        $pic = $this->tool->_up_avatar('avatar');
        if(!$pic)$this->error(418,'没有上传照片');
        $data['avatar'] = $pic[0];
        $this->model->data($data)->save($this->user->uid);
        
        $array['avatar'] = $this->model->find($this->user->uid,0)->get_field('avatar').'?'.rand(0,9999999);
        $this->success($array);
    }
    function change_name(){
        $data['name'] = post('name');
        if(!$data)$this->error(401,'参数错误');
        $this->model->data($data)->save($this->user->uid);
        $this->success();
    }
    function change_nickname(){
        $data['nickname'] = post('name');
        if(!$data)$this->error(401,'参数错误');
        $this->model->data($data)->save($this->user->uid);
        $this->success();
    }
    function change_sex(){
        $data['sex'] = post('sex',0,'%d');
        if(!$data)$this->error(401,'参数错误');
        $this->model->data($data)->save($this->user->uid);
        $this->success();
    }
    function change_age(){
        $data['age'] = post('age',0,'%d');
        $this->model->data($data)->save($this->user->uid);
        $this->success();
    }
    function change_area(){
        $data['area'] = post('area');
        if(!$data)$this->error(401,'参数错误');
        $this->model->data($data)->save($this->user->uid);
        $this->success();
    }
    function change_marry(){
        $data['marry'] = post('marry')?1:0;
        $this->model->data($data)->save($this->user->uid);
        $this->success();
    }
    function change_child(){
        $data['child'] = post('child')?1:0;
        $this->model->data($data)->save($this->user->uid);
        $this->success();
    }
    function change_plastic(){
        $data['plastic'] = post('plastic')?1:0;
        $this->model->data($data)->save($this->user->uid);
        $this->success();
    }
    function change_email(){
        $data['email'] = post('email');
        if(!$data)$this->error(401,'参数错误');
        $this->model->data($data)->save($this->user->uid);
        $this->success();
    }
    function change_work(){
        $data['work'] = post('work');
        //model('cache')->replace('test2',$data['work']);
        if(preg_match('#\d+#',$data['work']))$where['id'] = $data['work'];
        else $where['name'] = $data['work'];
        $w = $this->work->where($where)->find();
        //model('cache')->replace('test',$w);
        if(!$w)$this->error(419,'没有找到对应的工作');
        $data['work'] = $w['name'];
        if(!$data)$this->error(401,'参数错误');
        $this->model->data($data)->save($this->user->uid);
        $this->success();
    }
    function change_interest(){
        $interest = post('interest');
        if(!$interest)$this->error(401,'参数错误');
        if(is_string($interest))$interest = explode(',',$interest);
        if(!$interest || !is_array($interest))$this->error(401,'参数错误');
        $data['interest'] = array('logic',$interest,'%s');
        $this->model->data($data)->save($this->user->uid);
        $this->success();
    }
    function get_interest(){
        $m = $this->model->field(array('interest'))->find($this->user->uid);
        $interest = $m['interest']?unserialize($m['interest']):array();
        $m = $this->project->field(array('jid','jname'))->limit(999)->order(array('jorder'))->select();
        foreach($m as &$v){
            $v['favo'] = array_search($v['jid'],$interest)===false?0:1;
        }
        $this->success($m);
    }
    function get_my_reservation(){
        $where['uid'] = $this->user->uid;
        $where['time'] = array('logic',time(),'>');
        $m = $this->reservationView->where($where)->limit(9999)->order(array('time'))->select();
        $this->success($m);
    }

    function get_my_theme(){
        $limit = post('limit',6,'%d');
        $line = post('ctime',0,'%d');
        $where['uid'] = $this->user->uid;
        $where['reply'] = 0;
        if($line)$where['ctime'] = array('logic',$line,'<');
        $m = $this->thread->where($where)->field(array('hid','title','pic','ctime','uid','last','favo','reply_num'))->order('ctime','DESC')->limit($limit)->select();
        foreach($m as &$v)$v['pic'] = $v['pic']?unserialize($v['pic']):array();
        $this->success($m);
    }
    function get_my_favourite($type){
        $limit = post('limit',6,'%d');
        $line = post('ftime',0,'%d');
        $where['type'] = post('type',$type);
        $where['uid'] = $this->user->uid;
        if($where['type']=='article'){
            $where['atype'] = array('logic',0,'!=');
            $this->favourite->add_table($this->favourite->articleMap);
        }elseif($where['type']=='media'){
            $where['atype'] = 0;
            $this->favourite->add_table($this->favourite->articleMap);
        }elseif($where['type']=='project'){
            $this->favourite->add_table($this->favourite->projectMap);
        }elseif($where['type']=='product'){
            $this->favourite->add_table($this->favourite->productMap);
        }elseif($where['type']=='thread'){
            $this->favourite->add_table($this->favourite->threadMap);
        }else $this->error(401,'参数错误');
        if($line)$where['ftime'] = array('logic',$line,'<');
        $m = $this->favourite->where($where)->order(array('ftime'=>'DESC'))->limit($limit)->select();
        
        if(post('typein')){
            if($where['type']=='article'){
                foreach($m as &$v){
                    $v['title'] = $v['atitle'];
                    $v['thumb'] = $v['athumb'];
                    
                }
                
            }elseif($where['type']=='media'){
                foreach($m as &$v){
                    $v['title'] = $v['atitle'];
                    $v['thumb'] = $v['athumb'];
                    
                }
            }elseif($where['type']=='project'){
                foreach($m as &$v){
                    $v['title'] = $v['jname'];
                    $v['thumb'] = $v['jthumb'];
                    
                }
            }elseif($where['type']=='product'){
                foreach($m as &$v){
                    $v['title'] = $v['dname'];
                    $v['thumb'] = $v['dthumb'];
                    
                }
            }elseif($where['type']=='thread'){
                //$m['title'] = $m['hname'];
            }
            
        }
        
        $this->success($m);
    }
    function add_favourite($type){

        $data['type'] = post('type',$type);
        $data['uid'] = $this->user->uid;
        $data['ftime'] = time();
        if($data['type']=='article'){
            $data['aid'] = post('aid');
        }elseif($data['type']=='media'){
            $data['aid'] = post('aid');
        }elseif($data['type']=='project'){
            $data['jid'] = post('jid');
        }elseif($data['type']=='product'){
            $data['did'] = post('did');
        }elseif($data['type']=='thread'){
            $data['hid'] = post('hid');
            
        }else $this->error(401,'参数错误');
        $data2 = $data;unset($data2['ftime']);
        if($this->favourite->where($data2)->find())$this->error(405,'非法操作:已收藏');
        $m = $this->favourite->data($data)->add(true);
        if($m && $data['type']=='thread'){
            $threadData['favo'] = array('add',1);
            model('community:thread')->data($threadData)->save($data['hid']);
        }
        $this->success();
    }
    function remove_favourite($type){
        $data['type'] = post('type',$type);
        $data['uid'] = $this->user->uid;
        if($data['type']=='article'){
            $data['aid'] = post('aid');
        }elseif($data['type']=='media'){
            $data['aid'] = post('aid');
        }elseif($data['type']=='project'){
            $data['jid'] = post('jid');
        }elseif($data['type']=='product'){
            $data['did'] = post('did');
        }elseif($data['type']=='thread'){
            $data['hid'] = post('hid');
        }else $this->error(401,'参数错误');
        $m = $this->favourite->where($data)->remove();;
        if($m && $data['type']=='thread'){
            $threadData['favo'] = array('add',-1);
            model('community:thread')->data($threadData)->save($data['hid']);
        }
        $this->success();
    }
    function get_my_score(){
        $m = $this->model->field('score')->find($this->user->uid);
        $this->success($m);
    }
    function get_my_score_detail($type='in'){
        $where['uid'] = $this->user->uid;
        $where['type'] = post('type',$type);
        $limit = post('limit',6,'%d');
        $line = post('stime',0,'%d');
        if($where['type']!='out')$where['type'] = 'in';
        if($line)$where['stime'] = array('logic',$line,'<');
        $m = $this->scoreDetail->where($where)->limit($limit)->order(array('stime'=>"DESC"))->select();
        foreach($m as &$v){
            $v['pic'] = 'score/'.$v['rtype'].'.png';
        }
        $this->success($m);
    }
    function get_my_info(){
        $m = $this->model->field(array('uid','avatar','nickname','name','sex','age','area','marry','child','plastic','email',
                'work','phone','interest','score','ctime','last_time','ip'))->find($this->user->uid);
        $m['interest'] = $m['interest']?unserialize($m['interest']):array();
        $this->success($m);
    }
    
    function feedback(){
        $data['uid'] = $this->user->uid;
        $data['content'] = post('content');
        if(!$data['content'])$this->error(401,'参数错误');
        $m = $this->feedback->data($data)->add();
        $this->success($m);
    }
    
    function get_gift_list(){
        $limit = post('limit',6,'%d');
        $line = post('ctime',0,'%d');
        $where = array();
        if($line)$where['ctime'] = array('logic',$line,'<');
        $m = $this->gift->field(array('ctime','gid','gtitle','gthumb','gscore'))->where($where)->order('ctime','DESC')->limit($limit)->select();
        $this->success($m);
    }
    function get_my_gift_list(){
        $where['uid'] = $this->user->uid;
        $where['type'] = 'out';
        $m = $this->scoreDetail->add_table(array('gift'=>array(
            '_on'=>'CONCAT(  \'兑换\', zr_gift.gname ) = zr_score_detail.desc',
            'gid','gthumb','gtitle','gscore'
        )))->where($where)->order('stime','DESC')->limit(9999)->select();
        $this->success($m);
    }
    function get_gift_detail($gid = 0){
        $gid = post('gid',$gid,'%d');
        $m = $this->gift->find($gid);
        if(!$m)$this->error(420,'没有找到礼品');
        $this->success($m);
    }
    function get_gift(){
        $gid = post('gid',0,'%d');
        $gift = $this->gift->find($gid);
        if(!$gift)$this->error(420,'没有找到礼品');
        control('user:score','api')->_add_score_detail('兑换'.$gift['gname'],$gift['gscore'],'out');
        $array['message'] = '请到成都市天府大道南段2039号领取~';
        $this->success($array['message']);
    }
        function get_friends($uid = 0){
        $where['invate'] = $this->user->uid;
        $m = $this->model->field(array('uid','nickname','avatar','invate_num'))->limit(9999)->where($where)->select();
        $this->success($m);
    }

    
    
}

?>