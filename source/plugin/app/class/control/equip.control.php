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
        if(!$f['list'])$this->errorCode(427);
        $this->success($f);
    }


    function protect(){
        $this->_check_login();
        unset($_POST['id']);
        $_POST['uid'] = $this->uid;
        $_POST['ctime'] = TIME_NOW;
        $z = model('equip_protect')->data($_POST)->add();
        if(!$z)$this->errorCode(432);



        $city = $this->userInfo['city'];

        $a = model('user_area')->mapping('a')->add_table(array(
            'user'=>array('_on'=>'a.mid=u.uid','_mapping'=>'u','usercode')
        ))->limit(999)->select();

        //$r = array();

        foreach($a as $v){

            if(array_search($city,explode(',',$v['value']))!==false){
                control('tool:captcha')->_message($v['usercode'],'您好！用户 '.$this->userInfo['usercode'].' 提交了一条维保的信息，请尽快到管理后台查看详情，并尽快与该用户取得联系，谢谢！');
            }
            

        }

        $this->success();
    }


    function protect_type($t=0){

        $z = array(
            '汽轮机'=>array('Fisher阀门','泵维修','西门子旁路维护'),
            '锅炉'=>array('分类一','分类二','分类三'),
            '电气设备及系统'=>array('电机维修','变压器维修','ABB火检'),
            '热控设备及系统'=>array('Ovatin／艾默生仪表'),
            '燃料及化水设备'=>array('西门子DCS','工业电视','Flender减速机'),
            '环保'=>array('CEMS维护'),
            '综合'=>array('金属分析')
        );
        
        if(!$t || !$z[$t]){
            $data['list'] = array_keys($z);
            $this->success($data);
        }else{
            $data['list'] = $z[$t];
            $this->success($data);
        }
    }



}
?>