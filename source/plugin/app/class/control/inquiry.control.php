<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class inquiry extends base\e{
    function _beginning(){
        //$this->_check_login();
    }


    function info($id){
        $id = post('id',$id,'%d');
        
        
        model('inquiry')->data(array('read'=>array('add',1)))->save($id);

        $t['info'] = model('inquiry')->mapping('i')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname','type'),
            'collect'=>array('_join'=>'LEFT JOIN','_mapping'=>'c','_on'=>'i.id=c.id AND c.type=\'w\' AND c.uid='.$this->uid,'uid'=>'collected')
        ))->find($id);
        if(!$t['info'])$this->errorCode(439);
        $t['info']['collected'] = $t['info']['collected']?'1':'0';


        $t['follow'] = model('fans')->where(array('uid'=>$t['info']['uid'],'fans_id'=>$this->uid))->get_field();
        $t['collect'] = model('collect')->where(array('type'=>'w','uid'=>$this->uid,'id'=>$t['info']['id']))->get_field();

        $t['paid'] = model('inquiry_paid')->where(array('uid'=>$this->uid,'id'=>$id))?'1':'0';

        $t['adopt'] = model('inquiry_list')->mapping('r')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname','type'),
            'inquiry_zan'=>array('_join'=>'LEFT JOIN','_on'=>'r.id=z.id AND z.uid='.$this->uid,'_mapping'=>'z','uid'=>'iszan')
        ))->where(array('bid'=>$id,'adopt'=>1))->limit(999)->order(array('ctime'=>'DESC'))->select();
        foreach($t['adopt'] as &$v)$v['iszan'] = $v['iszan']?'1':'0';


        $t['replyCount'] = model('inquiry_list')->where(array('bid'=>$id,'adopt'=>0))->get_field();

        $t['reply'] = model('inquiry_list')->where(array('bid'=>$id,'adopt'=>0))->limit(3)->order(array('ctime'=>'DESC'))->select();
        foreach($t['reply'] as &$v)$v['iszan'] = $v['iszan']?'1':'0';

        
        $this->success($t);
    }

    function reply($id){

        
        
        $id = post('id',$id,'%d');
        $page = post('page',1);
        $limit = post('limit',10);
        $p = model('inquiry_paid')->where(array(
            'uid'=>$this->uid,
            'id'=>$id
        ))->find();
        if(!$p)$this->_check_access();

        $t['reply'] = model('inquiry_list')->mapping('r')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname','type'),
            'inquiry_zan'=>array('_join'=>'LEFT JOIN','_on'=>'r.id=z.id AND z.uid='.$this->uid,'_mapping'=>'z','uid'=>'iszan'),
            'inquiry_paid'=>array('_join'=>'LEFT JOIN','_on'=>'r.id=p.id AND p.uid='.$this->uid,'_mapping'=>'p','uid'=>'ispaid')
        ))->where(array('bid'=>$id))->page($page,$limit)->order(array('adopt'=>'DESC','ctime'=>'DESC'))->select();
        foreach($t['reply'] as &$v){
            $v['iszan'] = $v['iszan']?'1':'0';
            $v['ispaid'] = $v['ispaid']?'1':'0';
        }

        $this->success($t);
    }


    function lists($bid){
        $bid = post('bid',$bid,'%d');
        if($bid)$where['bid'] = $bid;
        $page = post('page',1);
        $limit = post('limit',10);
        $t['list'] = model('inquiry')->mapping('i')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname','type'),
            'collect'=>array('_join'=>'LEFT JOIN','_mapping'=>'c','_on'=>'i.id=c.id AND c.type=\'w\' AND c.uid='.$this->uid,'uid'=>'collected'),
            'inquiry_paid'=>array('_join'=>'LEFT JOIN','_mapping'=>'p','_on'=>'i.id=p.id AND p.uid='.$this->uid,'ctime'=>'paid')
        ))->where($where)->order(array('ctime'=>'DESC'))->page($page,$limit)->select();
        foreach($t['list'] as &$v){
            $v['collected'] = $v['collected']?'1':'0';
            $v['paid'] = $v['paid']?'1':'0';
        }
        $t['uid'] = $this->uid;
        $this->success($t);

    }
    
    function answer(){
        $this->_check_login();
        $ty = $this->userInfo['type'];
        if($ty<1)$this->errorCode(411);
        $data['uid'] = $this->uid;
        $data['bid'] = post('bid',0);
        if(!$i = model('inquiry')->find($data['bid']))$this->errorCode(413);
        $data['content'] = post('content','');
        $data['img'] = post('img','');
        $data['ctime'] = TIME_NOW;
        $r = model('inquiry_list')->data($data)->add();
        if(!$r)$this->errorCode(413);
        model('inquiry')->data(array('answer'=>array('add',1)))->save($data['bid']);
        model('user')->data(array('answer'=>array('add',1)))->save($this->uid);


        $user = model('user')->find($i['uid']);
        if($user)$this->_pusher($user['nickname'].'回答了您发布的问诊',$i['uid']);
        $this->_handle_score(5,'发布问诊',3);
        $this->success();
    }

    function publish(){
        $this->_check_login();
        $z = model('inquiry')->data($_POST)->add();
        if(!$z)$this->errorCode(415);
        $e2 = model('equipment_list')->find($_POST['bid']);
        $e1 = model('equipment_list')->find($e2['bid']);
        if(!$e1)$this->errorCode(415);
        $data['count'] = array('add',1);
        $data['utime'] = TIME_NOW;
        if($e2['utime']<$this->today)$data['today_count'] = 1;
        else $data['today_count'] = array('add',1);
        model('equipment_list')->data($data)->save($e2['id']);
        if($e1['utime']<$this->today)$data['today_count'] = 1;
        else $data['today_count'] = array('add',1);
        model('equipment_list')->data($data)->save($e1['id']);

        $this->_handle_score(5,'回答问题');
        $this->success();

    }

    function search($search){
        $search = post('search',$search);
        if($search)$where['title'] = array('contain','%'.$search.'%','LIKE');
        else $where = '1=2';
        $page = post('page',1);
        $limit = post('limit',10);
        $t['list'] = model('inquiry')->mapping('i')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname','type'),
            'collect'=>array('_join'=>'LEFT JOIN','_mapping'=>'c','_on'=>'i.id=c.id AND c.type=\'w\' AND c.uid='.$this->uid,'uid'=>'collected'),
            'inquiry_paid'=>array('_join'=>'LEFT JOIN','_mapping'=>'p','_on'=>'i.id=p.id AND p.uid='.$this->uid,'ctime'=>'paid')
        ))->where($where)->order(array('ctime'=>'DESC'))->page($page,$limit)->select();
        foreach($t['list'] as &$v){
            $v['collected'] = $v['collected']?'1':'0';
            $v['paid'] = $v['paid']?'1':'0';
        }
        $this->success($t);
    }

    function expert_search($search){
        $search = post('search',$search);
        $where['type'] = 2;
        if($search)$where['nametrue'] = array('contain','%'.$search.'%','LIKE');
        //else $where['is_login'] = '1';
        $page = post('page',1);
        $limit = post('limit',10);
        $t['list'] = model('user')->mapping('u')->add_table(array(
             'fans'=>array('_join'=>'LEFT JOIN','_on'=>'u.uid=f.uid AND f.fans_id='."'{$this->uid}'",'_mapping'=>'f','fans_id'=>'followed')
        ))->field(array(
            "uid","thumb","nickname","experience","label","type","is_login","answer",'nametrue',"fans","follow","followed"
        ))->where($where)->page($page,$limit)->select();
        foreach($t['list'] as &$v){
            $v['followed'] = $v['followed']?'1':'0';
        }
        $this->success($t);
    }




    function collect($id){
        $this->_check_login();
        $id = post('id',$id,'%d');
        $data['uid'] = $this->uid;
        $data['type'] = 'w';


        $i = model('inquiry')->find($id);
        if(!$i)$this->errorCode(439);

        $data['id'] = $id;
        $f = model('collect')->where($data)->find();
        if($f){
            if($i['collect'])model('inquiry')->data(array('collect'=>array('add',-1)))->save($id);
            model('collect')->where($data)->remove();
            $z['collected'] = '0';
        }else{
            model('inquiry')->data(array('collect'=>array('add',1)))->save($id);
            model('collect')->data($data)->add();
            $z['collected'] = '1';
        }
        $this->success($z);
    }
    function zan($id){
        $this->_check_login();
        $id = post('id',$id,'%d');
        $data['uid'] = $this->uid;


        $i = model('inquiry_list')->find($id);
        if(!$i)$this->errorCode(439);

        $data['id'] = $id;
        $f = model('inquiry_zan')->where($data)->find();
        if($f){
            if($i['zan'])model('inquiry_list')->data(array('zan'=>array('add',-1)))->save($id);
            model('inquiry_zan')->where($data)->remove();
            $z['collected'] = '0';
        }else{
            model('inquiry_list')->data(array('zan'=>array('add',1)))->save($id);
            model('inquiry_zan')->data($data)->add();
            $z['collected'] = '1';
        }
        $this->success($z);
    }


    function pay($id=0){
        $this->_check_login();
        $id = post('id',$id,'%d');
        $type = post('type',0);

        if($type==0){
            if($this->userInfo['score']<100)$this->errorCode(442);
            $p = model('inquiry_paid')->where(array(
                'uid'=>$this->uid,
                'id'=>$id
            ))->find();
            if($p)$this->errorCode(431);


            $this->_handle_score(-100,'支付问诊');
            model('inquiry_paid')->data(array(
                'uid'=>$this->uid,
                'ctime'=>TIME_NOW,
                'id'=>$id
            ))->add();
            $this->success();
        }elseif($type==2){

            control('pay')->__wcpay('inquiry',100,$id);

        }else{

            $this->errorCode(430);
        }

    }


}
?>