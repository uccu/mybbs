<?php
namespace plugin\h5\control;
use plugin\app\control\base\e;
defined('IN_PLAY') || exit('Access Denied');
class inquiry extends e{
    

    function type($bid = 0){
        $bid = $where['bid'] = post('bid',$bid,'%d');
        $where['del'] = 1;
        $f['list'] = model('equipment_list')->where($where)->limit(99)->order(array('orders'))->select();
        foreach($f['list'] as &$v){
            if($v['bid']){
                $v['count'] = model('inquiry')->where(array('bid'=>$v['id']))->get_field();
                $v['today_count'] = model('inquiry')->where(array('bid'=>$v['id'],'ctime'=>array('logic',$this->today,'>')))->get_field();
            }else{
                $v['count'] = model('inquiry')->mapping('i')->add_table(array(
                    'equipment_list'=>array('_on'=>'i.bid=e.id','_mapping'=>'e','bid'=>'kid')
                ))->where(array('kid'=>$v['id']))->get_field();
                $v['today_count'] = model('inquiry')->mapping('i')->add_table(array(
                    'equipment_list'=>array('_on'=>'i.bid=e.id','_mapping'=>'e','bid'=>'kid')
                ))->where(array('kid'=>$v['id'],'ctime'=>array('logic',$this->today,'>')))->get_field();
            }
        }
        T('inquiry/type'.($bid?'2':''));
        
    }

}
?>