<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class my extends base\e{
    function _beginning(){
        $this->_check_login();
    }

    function _change_info($info,$v){
        if($v)$info = array($info=>$v);
        return model('user')->data($info)->save($this->uid);
    }

    function choose_char($type){
        $this->_check_type(-1);
        //$type = post('type',$type,'0');
        $type = 0;
        $data['count'] = model('user')->data(array('type'=>$type))->save($this->uid);
        $this->success($data);
    }

    function change_u_info($nickname,$sex,$city,$plant){
        $this->_check_type(0);
        $data['nickname'] = post('nickname',$nickname);
        $data['sex'] = post('sex',$sex);
        $data['city'] = post('city',$city);
        if(!is_numeric($data['city']))$data['city'] = model('manager_organ')->where(array('jgmc'=>$data['city'],'bid'=>array('logic',0,'!=')))->get_filed('id');
        $data['plant'] = post('plant',$plant);
        $data['thumb'] = post('thumb');
        if(!$data['thumb'])unset($data['thumb']);
        $this->_change_info($data);
        $this->success();
    }
    function change_o_info($nickname,$sex,$city,$plant){
        $this->_check_type(-1);
        $data['nickname'] = post('nickname','');
        $data['sex'] = post('sex',0,'%d');
        $data['city'] = post('city',$city);
        if(!is_numeric($data['city']))$data['city'] = model('manager_organ')->where(array('jgmc'=>$data['city'],'bid'=>array('logic',0,'!=')))->get_filed('id');
        $data['plant'] = post('plant','');
        $data['company'] = post('company','');
        $data['at_start'] = post('at_start',0,'%d');
        $data['at_end'] = post('at_end',0,'%d');
        $data['experience'] = post('experience','');
        $data['generator'] = post('generator',0,'%d');
        $data['label'] = post('label','');
        $data['field'] = post('field',0,'%d');
        $data['thumb'] = post('thumb','');
        $data['type'] = 0;
        $data['apply'] = 1;
        if(!$data['thumb'])unset($data['thumb']);
        $this->_change_info($data);
        $this->success();
    }

    function my_info(){
        $u = $this->userInfo;
        unset($u['password']);
        $t['info'] = model('user')->field(array('uid','nickname','type','label','thumb','sex','score'))->find($this->uid);
        
        $t['fans'] = model('fans')->where(array('uid'=>$this->uid))->get_field();
        $t['follow'] = model('fans')->where(array('follow'=>$this->uid))->get_field();
        $t['collect'] = 0;
        $t['message'] = 0;
        $this->success($t);
    }

    function my_fans(){
        model('fans')->mapping('f');
        $t['fans'] = model('fans')->add_table(array(
            'user'=>array('_on'=>'f.fans_id=u.uid','uid'=>'fuid','_mapping'=>'u','type','nickname','label','thumb'),
            '_table'=>array('_join'=>'LEFT JOIN','_on'=>'f.fans_id=f2.uid AND f2.fans_id='."'{$this->uid}'",'_mapping'=>'f2','fans_id'=>'follow')
        ))->where(array('uid'=>$this->uid))->limit(999)->select();
        foreach($t['fans'] as &$v)$v['follow'] = $v['follow']?'1':'0';
        $this->success($t);
    }
    function my_follow(){
        model('fans')->mapping('f');
        $t['follow'] = model('fans')->add_table(array(
            'user'=>array('_on'=>'uid','_mapping'=>'u','uid'=>'fuid','nickname','type','label','thumb'),
        ))->where(array('fans_id'=>$this->uid))->limit(999)->select();
        foreach($t['follow'] as &$v)$v['follow'] = '1';
        $this->success($t);
    }
    function my_inquiry(){
        $page = post('page',1);
        $limit = post('limit',10);
        $t['list'] = model('inquiry')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname')
        ))->where(array('uid'=>$this->uid))->order(array('ctime'=>'DESC'))->limit($page,$limit)->select();
        $this->success($t);
    }

    function take_reply($id,$thank){
        $id = post('id',$id,'%d');
        $r= model('inquiry_list')->find($id);
        if(!$r)$this->errorCode(439);
        $i= model('inquiry_list')->find($r['bid']);
        if(!$i)$this->errorCode(439);
        if(!$i['uid']!=$this->uid)$this->erorCode(411);
        $thank = post('thank',$thank);
        model('inquiry_list')->where(array('adopt'=>1,'thank'=>$thank))->save($id);
        $this->success();
    }

    function del_inquiry($id){
        $id = post('id',$id,'%d');
        $i= model('inquiry')->find($id);
        if(!$i)$this->errorCode(439);
        if($i['user']!==$this->uid)$this->errorCode(411);
        model('inquiry')->remove($id);
        model('inquiry_list')->where(array('bid'=>$id))->remove();
        $this->success();
    }


    function my_reply(){



    }

    function my_reply_info(){


        
    }

    function my_equip(){



    }
    function score(){
        $z['score'] = $this->userInfo['score'];
        $this->success($z);

    }

    function score_log(){
        $page = post('page',1);
        $limit = post('limit',10);
        $where['uid'] = $this->uid;
        $list = model('score_log')->where($where)->page($page,$limit)->order(array('ctime'=>'DESC'))->select();
        $this->success($list);
    }

    function cash_bind(){
        $wx_pay = post('wx_pay','');
        model('user')->data(array('wx_pay'=>$wx_pay))->save($this->uid);
        $this->success();
    }

    function cash_apply($money=0){
        if(!$this->userInfo['wx_pay'])$this->errorCode(417);
        $data['money'] = post('money',$money,'%d');
        if(!$data['money'])$this->errorCode(416);
        if($this->userInfo['score']<$data['money']*100)$this->errorCode(442);
        $data['uid'] = $this->uid;
        $data['ctime'] = TIME_NOW;
        model('cash_apply')->data($data)->add();
        model('user')->data(array('score'=>array('add',-1*$data['money']*100)))->save($this->uid);
        $this->success();
    }

    function cash_log(){
        $page = post('page',1);
        $limit = post('limit',10);
        $where['uid'] = $this->uid;
        $list = model('cash_apply')->where($where)->page($page,$limit)->order(array('ctime'=>'DESC'))->select();
        $this->success($list);
    }


    function paper_list(){




    }
    function paper_info(){




    }

    function message(){




    }


    function collect_inquiry(){




    }

    function collect_lession(){




    }

    function collect_repository(){



    }

    function feedback(){


        
    }


}
?>