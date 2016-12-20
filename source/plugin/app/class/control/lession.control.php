<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class lession extends base\e{//运维
    function _beginning(){
        //$this->_check_login();
    }
    function lists($type=0){
        $type = post('type',$type,'%d');
        if($type==1)
            $t = model('course')->where(array('open_time'=>array('logic',TIME_NOW,'>')))->order(array('open_time'))->limit(999)->select();
        elseif($type==2)
            $t = model('course')->where(array('open_time'=>array('logic',TIME_NOW,'<'),'etime'=>array('logic',TIME_NOW,'>')))->order(array('open_time'=>'DESC'))->limit(999)->select();
        elseif($type==3)
            $t = model('course')->where(array('etime'=>array('logic',TIME_NOW,'<')))->limit(999)->order(array('open_time'=>'DESC'))->select();
        else $t = model('course')->limit(999)->select();

        foreach($t as &$v)$v['now'] = TIME_NOW;
        $data['list'] = $t;
        $this->success($data);
    }
    function info($id=0){
        $id = post('id',$id,'%d');
        $t = model('course')->find($id);
        if(!$t)$this->errorCode(418);
        if($t['open_time']<TIME_NOW && $t['etime']>TIME_NOW){
            //if($t['look_nums']<=$t['nums'])$this->errorCode(419);
            model('course')->data(array('nums'=>array('add',1)))->save($id);
            $t['nums']++;
        }
        
        //     
        // }
        $t['now'] = TIME_NOW;
        $data['info'] = $t;
        $data['collect'] = model('collect')->where(array('type'=>'k','uid'=>$this->uid,'id'=>$t['cid']))->find() ? '1' :'0';
        $this->success($data);
    }
    function leave($id=0){
        $id = post('id',$id,'%d');
        $t = model('course')->find($id);
        if(!$t)$this->errorCode(418);
        if(!$t['nums'])$this->success();
        if($t['open_time']<TIME_NOW && $t['etime']>TIME_NOW)
            model('course')->data(array('nums'=>array('add',-1)))->save($id);
        $this->success();
    }
    function collect($id=0){
        $this->_check_login();
        $this->_check_phone();
        $id = post('id',$id,'%d');
        $data['uid'] = $this->uid;
        $data['type'] = 'k';


        $i = model('course')->find($id);
        if(!$i)$this->errorCode(418);

        $data['id'] = $id;
        $f = model('collect')->where($data)->find();
        if($f){
            model('collect')->where($data)->remove();
            $z['collected'] = '0';
        }else{
            model('collect')->data($data)->add();
            $z['collected'] = '1';
        }
        $this->success($z);
    }
    function test(){
        $z['list_r'] = model('paper')->mapping('p')->add_table(array(
            'paper_paid'=>array('_join'=>'LEFT JOIN','_mapping'=>'i','_on'=>'i.pid=p.pid AND i.uid='.$this->uid,'ctime'=>'paid')
        ))->where(array('states'=>1))->limit(1)->select();
        $z['list_y'] = model('paper')->mapping('p')->add_table(array(
            'paper_paid'=>array('_join'=>'LEFT JOIN','_mapping'=>'i','_on'=>'i.pid=p.pid AND i.uid='.$this->uid,'ctime'=>'paid')
        ))->where(array('states'=>2))->limit(2)->select();
        $z['list_p'] = model('paper')->mapping('p')->add_table(array(
            'paper_paid'=>array('_join'=>'LEFT JOIN','_mapping'=>'i','_on'=>'i.pid=p.pid AND i.uid='.$this->uid,'ctime'=>'paid')
        ))->where(array('states'=>3))->limit(2)->select();
        foreach($z['list_r'] as &$v){
            $v['paid'] = $v['paid']?'1':'0';
        }
        foreach($z['list_y'] as &$v){
            $v['paid'] = $v['paid']?'1':'0';
        }
        foreach($z['list_p'] as &$v){
            $v['paid'] = $v['paid']?'1':'0';
        }
        $this->success($z);
    }
    function test_list($states=0,$bid = 0){
        $states = post('states',$states,'%d');
        $bid = post('bid',$bid,'%d');
        $z['list'] = model('paper')->mapping('p')->add_table(array(
            'paper_paid'=>array('_join'=>'LEFT JOIN','_mapping'=>'i','_on'=>'i.pid=p.pid AND i.uid='.$this->uid,'ctime'=>'paid')
        ))->where(array('states'=>$states,'bid'=>$bid))->limit(9999)->select();
        foreach($z['list'] as &$v){
            $v['paid'] = $v['paid']?'1':'0';
        }
        
        $this->success($z);
    }
    function test_type($states=0){
        $states = post('states',$states,'%d');

        $z['list'] = model('paper_list')->where(array('bid'=>$states,'del'=>1))->limit(9999)->select();
    
        $this->success($z);
    }
    function paper($id=0){
        $this->_check_login();
        $this->_check_phone();
        $id = post('id',$id,'%d');
        $paper = model('paper')->find($id);
        if($paper['states']==3){
            $p = model('paper_paid')->where(array(
                'uid'=>$this->uid,
                'pid'=>$id
            ))->find();
            if(!$p)$this->_check_vip();
            
        }
        $t['list'] = model('question')->where(array('states'=>$paper['states']))->order('rand()')->limit(20)->select();
        $this->success($t);

    }
    function submit($pid,$result=0){
        $this->_check_login();
        $this->_check_phone();
        $result = post('result',$result,'%d');
        $pid = post('pid',$pid,'%d');
        $data['rank'] = model('paper_result')->where(array('pid'=>$pid,'result'=>array('logic',$result,'>')))->get_field() + 1;
        $data['all'] = model('paper_result')->where(array('pid'=>$pid))->get_field() + 1;
        $data['percent'] = floor((1 - $data['rank']/$data['all'])*100);
        model('paper_result')->data(array('pid'=>$pid,'result'=>$result,'uid'=>$this->uid,'ctime'=>TIME_NOW))->add();
        $this->success($data);
    }


    function pay($id=0){
        $this->_check_login();
        $this->_check_phone();
        $id = post('id',$id,'%d');
        $type = post('type',0);
        $p = model('paper_paid')->where(array(
            'uid'=>$this->uid,
            'pid'=>$id
        ))->find();
        if($p)$this->errorCode(431);
        if($type==0){
            if($this->userInfo['score']<100)$this->errorCode(442);
            $this->_handle_score(-100,'支付考卷');
            model('paper_paid')->data(array(
                'uid'=>$this->uid,
                'ctime'=>TIME_NOW,
                'pid'=>$id
            ))->add();
            $this->success();
        }elseif($type==2){
            control('pay')->__wcpay('paper',100,$id);
        }elseif($type==1){
            control('pay')->__alipay('paper',1,$id);
        }else{

            $this->errorCode(430);
        }

    }


}
?>