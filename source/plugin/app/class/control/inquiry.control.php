<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class inquiry extends base\e{
    function _beginning(){
        //$this->_check_login();
    }


    function info($id){
        $id = post('id',$id,'%d');
        
        $this->_check_access();
        model('inquiry')->data(array('read'=>array('add',1)))->save($id);

        $t['info'] = model('inquiry')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname')
        ))->find($id);
        if(!$t['info'])$this->errorCode(439);

        $t['follow'] = model('fans')->where(array('uid'=>$t['info']['uid'],'fans_id'=>$this->uid))->get_field();
        $t['collect'] = model('collect')->where(array('type'=>'w','uid'=>$this->uid,'id'=>$t['info']['id']))->get_field();



        $t['adopt'] = model('inquiry_list')->mapping('r')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname'),
            'inquiry_zan'=>array('join'=>'LEFT JOIN','_on'=>'r.id=z.id AND z.uid='.$this->uid,'_mapping'=>'z','uid'=>'zan')
        ))->where(array('bid'=>$id,'adopt'=>1))->limit(999)->order(array('ctime'=>'DESC'))->select();
        foreach($t['adopt'] as &$v)$v['zan'] = $v['zan']?'1':'0';

        $t['reply'] = model('inquiry_list')->where(array('bid'=>$id,'adopt'=>0))->limit(3)->order(array('ctime'=>'DESC'))->select();
        foreach($t['reply'] as &$v)$v['zan'] = $v['zan']?'1':'0';

        $this->success($t);
    }

    function reply($id){
        $id = post('id',$id,'%d');
        $page = post('page',1);
        $limit = post('limit',10);
        $t['reply'] = model('inquiry_list')->mapping('r')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname'),
            'inquiry_zan'=>array('join'=>'LEFT JOIN','_on'=>'r.id=z.id AND z.uid='.$this->uid,'_mapping'=>'z','uid'=>'zan')
        ))->where(array('bid'=>$id))->page($page,$limit)->order(array('adopt'=>'DESC','ctime'=>'DESC'))->select();
        foreach($t['reply'] as &$v)$v['zan'] = $v['zan']?'1':'0';

        $this->success($t);
    }


    function lists(){
        $page = post('page',1);
        $limit = post('limit',10);
        $t['list'] = model('inquiry')->mapping('i')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname'),
            'collect'=>array('_join'=>'LEFT JOIN','_mapping'=>'c','_on'=>'i.id=c.id AND c.type=\'w\' AND c.uid='.$this->uid,'uid'=>'collected')
        ))->where(array('uid'=>$this->uid))->order(array('ctime'=>'DESC'))->page($page,$limit)->select();
        foreach($t['list'] as &$v)$v['collected'] = $v['collected']?'1':'0';
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
        $this->success();
    }


}
?>