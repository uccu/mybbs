<?php

# 巡检系统

namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class xj extends base\e{
    function _beginning(){
        // $this->_check_login();
    }

    function collect($id){
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


    # 巡检首页
    function myxj(){

        // $user_id = $this->uid;
        $user_id = 502;
        # 获取巡检
        $lx = model('inspection')->where(['uid'=>$user_id])->find();

        if(!$lx)$this->error('没有巡检路线！');

        $where['id'] = ['contain',explode(',',$lx['value']),'IN'];
        $where['del'] = 1;
        $qy = model('enterprise_equipment')->where($where)->limit(9999)->order(['orders'=>'ASC'])->select();

        $date = date('Y-m-d');

        foreach($qy as &$qyv ){

            $qyv['log'] = model('enterprise_xuanjian_log')->limit(999)->where(['user_id'=>$user_id,'area_id'=>$qyv['id'],'date'=>$date])->select();
            $qyv['logCount'] = count($qyv['log']);
        }


        $out['lx'] = $lx;
        $out['qy'] = $qy;
        $out['count'] = count($out['qy']);

        $this->success($out);

    }

    # 获取区域的设备 以及参数
    function getEquip($id){

        $id = post('id',$id,'%d');

        $qy = model('enterprise_equipment')->where(['bid'=>$id])->limit(9999)->order(['orders'=>'ASC'])->select();

        foreach($qy as &$v){

            $v['params'] = model('device_parameters')->where(['bid'=>$v['id']])->limit(999)->select();


        }

        $out['qy'] = $qy;

        $this->success($out);

    }

}
?>