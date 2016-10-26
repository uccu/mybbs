<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class equip extends base\e{
    function _beginning(){
        //$this->_check_login();
    }

    function types($bid = 0){
        $bid = $where['bid'] = post('bid',$bid,'%d');
        $where['del'] = 1;
        $f['list'] = model('equipment_list')->where($where)->limit(99)->order(array('orders'))->select();
        foreach($f['list'] as &$v){
            if($v['bid']){
                $v['count'] = model('inquiry')->where(array('bid'=>$bid))->get_field();
                $v['today_count'] = model('inquiry')->where(array('bid'=>$bid,'ctime'=>array('logic',$this->today,'>')))->get_field();
            }else{
                $v['count'] = model('inquiry')->mapping('i')->add_table(array(
                    'equipment_list'=>array('_on'=>'i.bid=e.id','_mapping'=>'e','bid'=>'kid')
                ))->where(array('kid'=>$bid))->get_field();
                $v['today_count'] = model('inquiry')->mapping('i')->add_table(array(
                    'equipment_list'=>array('_on'=>'i.bid=e.id','_mapping'=>'e','bid'=>'kid')
                ))->where(array('kid'=>$bid,'ctime'=>array('logic',$this->today,'>')))->get_field();
            }


        }
        if(!$f['list'])$this->errorCode(427);
        $this->success($f);
    }




}
?>