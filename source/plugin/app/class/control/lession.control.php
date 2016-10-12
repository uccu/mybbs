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

        $data['list'] = $t;
        $this->success($data);
    }

    function info($id){
        $id = post('id',$id,'%d');
        $t = model('course')->find($id);
        if(!$t)$this->errorCode(418);
        if($t['open_time']<TIME_NOW && $t['etime']>TIME_NOW){
            if($t['look_nums']==$t['nums'])$this->errorCode(419);
            model('course')->data(array('nums'=>array('add',1)))->save($id);
            $t['nums']++;
        }elseif($t['etime']<TIME_NOW){
            $this->_check_vip();
        }

        $data['info'] = $t;
        $this->success($data);
    }
    function leave($id){
        $id = post('id',$id,'%d');
        $t = model('course')->find($id);
        if(!$t)$this->errorCode(418);
        if($t['open_time']<TIME_NOW && $t['etime']>TIME_NOW)
            model('course')->data(array('nums'=>array('add',-1)))->save($id);
        $this->success();
    }
    
    function collect($id){
        $this->_check_login();
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
        $z['list_p'] = model('paper')->where(array('charge'=>1))->limit(1)->select();
        $z['list_y'] = model('paper')->where(array('charge'=>2))->limit(2)->select();
        $z['list_m'] = model('paper')->where(array('charge'=>3))->limit(2)->select();
        $this->success($z);
    }
    function test_list($charge){
        $charge = post('charge',charge,'%d');
        $z['list'] = model('paper')->where(array('charge'=>$charge))->limit(9999)->select();
        $this->success($z);
    }

}
?>