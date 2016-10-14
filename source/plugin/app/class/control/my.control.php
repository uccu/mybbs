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
        if($this->userInfo['type']<0)$data['type'] = 0;
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
        ))->where(array('uid'=>$this->uid))->order(array('ctime'=>'DESC'))->page($page,$limit)->select();
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
        if($this->userInfo['type']<1)$this->errorCode(420);

        $uid = $this->uid;
        $page = post('page',1);
        $limit = post('limit',10);

        $t['list'] = model('inquiry_list')->mapping('r')->add_table(array(
            'inquiry'=>array('_on'=>'r.bid=i.id','uid'=>'ruid','_mapping'=>'i','title','content'=>'icontent','img'=>'iimg'),
            'user@1'=>array('_on'=>'u.uid=r.uid','thumb','nickname','_mapping'=>'u'),
            'user@2'=>array('_on'=>'u2.uid=i.uid','thumb'=>'ithumb','nickname'=>'inickname','_mapping'=>'u2'),
            
        ))->where(array('uid'=>$uid))->order(array('ctime'=>'DESC'))->page($page,$limit)->select();


        $this->success($t);

    }

    

    function my_equip(){
        $t['list'] = model('user_equip')->mapping('u')->add_table(array(
            'equipment_list@2'=>array('_mapping'=>'e2','name'=>'ename2','_on'=>'e2.id=u.eid'),
            'equipment_list@1'=>array('_mapping'=>'e1','name'=>'ename1','_on'=>'e2.bid=e1.id'),
        ))->where(array('uid'=>$this->uid))->order(array('ctime'=>'DESC'))->select();
        $this->success($t);
    }
    function my_equip_info($id){
        $id = post('id',$id,'%d');
        $t['info'] = model('user_equip')->mapping('u')->add_table(array(
            'equipment_list@2'=>array('_mapping'=>'e2','name'=>'ename2','_on'=>'e2.id=u.eid'),
            'equipment_list@1'=>array('_mapping'=>'e1','name'=>'ename1','_on'=>'e2.bid=e1.id'),
        ))->order(array('ctime'=>'DESC'))->find($id);
        if(!$t['info'])$this->error(421);
        $this->success($t);


    }
    function score(){
        $z['score'] = $this->userInfo['score'];
        $this->success($z);

    }

    function score_log(){
        $page = post('page',1);
        $limit = post('limit',10);
        $where['uid'] = $this->uid;
        $t['list'] = model('score_log')->where($where)->page($page,$limit)->order(array('ctime'=>'DESC'))->select();
        $this->success($t);
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
        $t['list'] = model('cash_apply')->where($where)->page($page,$limit)->order(array('ctime'=>'DESC'))->select();
        $this->success($t);
    }


    function paper_list(){
        $t['list'] = model('paper_result')->add_table(array(
            'paper'=>array('_on'=>'pid','name','img')
        ))->order(array('citme'))->select();
        $this->success($t);
    }
    function paper_info(){
        $id = post('id',$id,'%d');
        $r = model('paper_result')->find($id);
        if(!$r)$this->errorCode(422);
        $result = $r['result'];
        $pid = $r['pid'];

        $data['rank'] = model('paper_result')->where(array('pid'=>$pid,'result'=>array('logic',$result,'>')))->get_field() + 1;
        $data['all'] = model('paper_result')->where(array('pid'=>$pid))->get_field() + 1;
        $data['percent'] = floor((1 - $data['rank']/$data['all'])*100);
        $this->success($data);
    }

    function message(){
        $page = post('page',1);
        $limit = post('limit',10);
        model('message')->where(array('uid'=>$this->uid))->data(array('read'=>1))->save();
        $t['list'] = model('message')->where(array('uid'=>$this->uid))->order(array('ctime'=>'DESC'))->select();
        $this->success($data);
    }


    function collect_inquiry(){
        $page = post('page',1);
        $limit = post('limit',10);
        $t['list'] = model('inquiry')->mapping('i')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname'),
            'collect'=>array('_mapping'=>'c','_on'=>'i.id=c.id AND c.type=\'w\' AND c.uid='.$this->uid,'uid'=>'collected')
        ))->order(array('ctime'=>'DESC'))->page($page,$limit)->select();
        foreach($t['list'] as &$v)$v['collected'] = $v['collected']?'1':'0';
        $this->success($t);
    }

    function collect_lession(){
        $page = post('page',1);
        $limit = post('limit',10);
        $t['list'] = model('course')->mapping('i')->add_table(array(
            'collect'=>array('_mapping'=>'c','_on'=>'i.cid=c.id AND c.type=\'k\' AND c.uid='.$this->uid,'uid'=>'collected')
        ))->order(array('open_time'))->page($page,$limit)->select();
        foreach($t['list'] as &$v)$v['collected'] = $v['collected']?'1':'0';
        $this->success($t);
        

    }

    function collect_repository(){

        $limit = post('limit',20,'%d');
        $page = post('page',1,'%d');

        $t['list'] = model('repository')->mapping('r')->add_table(array(
            'repository_list'=>array(
                'name','del','_on'=>'r.bid=i.rid','_mapping'=>'i'
            ),
            'collect'=>array('_mapping'=>'c','_on'=>'i.cid=c.id AND c.type=\'z\' AND c.uid='.$this->uid,'uid'=>'collected')
        ))->page($page,$limit)->select();
        foreach($t['list'] as &$v)$v['collected'] = $v['collected']?'1':'0';
        $this->success($z);


    }

    function feedback($content=''){
        $content = post('content',$content);
        if(!$content)$this->errorCode(416);
        $data['uid'] = $this->uid;
        $data['content'] = $content;
        model('feedback')->data($data)->add();
        $this->success();
    }
    function sign(){
        
        $u = model('sign')->find($this->uid);
        if(!$u)model('sign')->data(array('uid'=>$this->uid,'sign_time'=>TIME_NOW,'times'=>1))->add();
        else{
            if($u['sign_time']>$this->today())$this->errorCode(423);
            model('sign')->data(array('sign_time'=>TIME_NOW,'times'=>array('add',1)))->save($this->uid);
        }
        $this->success();
    }


}
?>