<?php

# 巡检系统

namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class xj extends base\e{
    function _beginning(){
        // $this->_check_login();
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


    /** 填写工作记录
     * final
     * @param mixed $start_time 
     * @param mixed $end_time 
     * @param mixed $message 
     * @return mixed 
     */
    function final($start_time,$end_time,$message){

        $this->_check_login();

        $data['message'] = post('message',$message);
        $data['start_time'] = post('start_time',$start_time);
        $data['end_time'] = post('end_time',$end_time);

        $data['user_id'] = post('user_id',$this->uid);
        $data['create_time'] = TIME_NOW;

        model('enterprise_xuanjian_final_log')->data($data)->add();

        $this->success();

    }


    /** 填写记录
     * fillIn
     * @param mixed $area_id 
     * @param mixed $data 
     * @return mixed 
     */
    function fillIn($area_id,$data){

        $area_id = post('area_id',$area_id);
        $data = post('data',$data);


        $obj = json_decode($data,true);
        if(!$obj)$this->error('json格式错误！');

        $data2['area_id'] = $area_id;
        $data2['user_id'] = $this->uid;
        $data2['time'] = TIME_NOW;
        $data2['date'] = date('Y-m-d',TIME_NOW);

        $log_id = model('enterprise_xuanjian_log')->data($data2)->add();

        foreach($obj as $o){

            $o['parameters_id'] = $o['parameters_id'];
            unset($o['id']);

            $o['log_id'] = $log_id;

            $o['create_time'] = TIME_NOW;
            $o['user_id'] = $this->uid;

            model('enterprise_xuanjian_parameters_log')->data($o)->add();
            
        }

        AJAX::success();
        

    }


}
?>