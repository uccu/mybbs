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

        # 获取巡检路线
        $lx = model('inspection')->where(['uid'=>$user_id])->find();
        if(!$lx)$this->error('没有巡检路线！');

        # 获取巡检路线的时间段
        $time = model('inspection_time')->where(['bid'=>$lx['id']])->order(['start_time'])->limit(999)->select();
        if(!$time)$this->error('没有巡检路线时间！');

        # 获取最近一次巡检
        $lxj = model('enterprise_xuanjian_final_log')->where(['user_id'=>$user_id])->order(['create_time'=>'desc'])->find();

        # 检查当前时间
        $time2 = [];
        $now_d = '0';
        $last = '0';
        foreach($time as $t){
            $start = strtotime($t['start_time']);
            $time2[$start] = $t;
        }
        ksort($time2);
        $time2 = array_values($time2);
        foreach($time2 as $t){
            $start = strtotime($t['start_time']);
            $end = strtotime($t['end_time']);
            if(TIME_NOW > $start - $t['effective_time'] && TIME_NOW < $start + $t['effective_time'])$now_d = $t['id'];
            if(TIME_NOW > $end)$last = $t['id'];
        }
        if(!$now_d && !$last){
            $now_d = $time2[0]['id'];
        }elseif(!$now_d && $last){
            $now_d = $last;
        }

        if($now_d != $lxj['inspection_time_id']){
            $data['user_id'] = $user_id;
            $data['create_time'] = TIME_NOW;
            $data['inspection_time_id'] = $now_d;
            $data['message'] = '';
            $id = model('enterprise_xuanjian_final_log')->data($data)->add();
            $lxj = model('enterprise_xuanjian_final_log')->find($id);
        }


        $where['id'] = ['contain',explode(',',$lx['value']),'IN'];
        $where['del'] = 1;
        $qy = model('enterprise_equipment')->where($where)->limit(9999)->order(['orders'=>'ASC'])->select();

        $date = date('Y-m-d');

        foreach($qy as &$qyv ){

            $log = model('enterprise_xuanjian_log')->limit(999)->where(['user_id'=>$user_id,'area_id'=>$qyv['id'],'final_log_id'=>$lxj['id']])->select();
            $qyv['logCount'] = count($log);
        }


        $out['lx'] = $lx;
        $out['qy'] = $qy;
        $out['time'] = $time2;
        $out['finals'] = $lxj;
        $out['count'] = count($out['qy']);

        $this->success($out);

    }

    /** 获取区域的设备 以及参数
     * getEquip
     * @param mixed $id 当次巡检ID
     * @return mixed 
     */
    function getEquip($id){

        $id = post('id',$id,'%d');

        if(!is_numeric($id)){

            $id = base64_decode($id);
            $id = str_replace('sbgl_','',$id);

        }

        if(!$id)$this->error('id 不合法！');

        $qy = model('enterprise_equipment')->where(['bid'=>$id])->limit(9999)->order(['orders'=>'ASC'])->select();

        foreach($qy as $k=>&$v){

            $v['params'] = model('device_parameters')->where(['bid'=>$v['id']])->limit(999)->select();

            if(!$v['params'])unset($qy[$k]);

        }

        $out['qy'] = array_values($qy);
        $out['time'] = TIME_NOW;

        $this->success($out);

    }


    /** 填写工作记录
     * finals
     * @param mixed $message 
     * @return mixed 
     */
    function finals($message,$id){

        $this->_check_login();
        $data['message'] = post('message',$message);
        $data['state'] = 1;
        model('enterprise_xuanjian_final_log')->data($data)->save($id);
        $this->success();

    }

    /** 获取当次巡检结果
     * getFinals
     * @param mixed $id 
     * @return mixed 
     */
    function getFinals($id){

        // $this->_check_login();
        $info = model('enterprise_xuanjian_final_log')->find($id);
        $info['end_time'] = TIME_NOW;
        model('enterprise_xuanjian_final_log')->data($info)->save($id);
        $out['info'] = $info;
        $this->success($out);

    }


    /** 填写记录
     * fillIn
     * @param mixed $area_id 
     * @param mixed $data json字符串
     * @param mixed $id 当次巡检ID 
     * @return mixed 
     */
    function fillIn($area_id,$data,$id){


        $this->_check_login();

        $area_id = post('area_id',$area_id);
        if($_POST['data'])$_POST['data'] = str_ireplace(array('&lt;','&gt;','&quot;','&#39;'),array('<','>','"',"'"),$_POST['data']);
        $data = $_POST['data']?$_POST['data']:$data;
        // $data = '[{"input_type":"0","value":"30","type":"3","bid":"3","parameters_id":"1"}]';

        $obj = json_decode($data,true);
        if(!$obj)$obj = [];
        $data2['area_id'] = $area_id;
        $data2['user_id'] = $this->uid;
        $data2['time'] = TIME_NOW;
        $data2['date'] = date('Y-m-d',TIME_NOW);
        $data2['time_id'] = $id;

        $log_id = model('enterprise_xuanjian_log')->data($data2)->add();

        foreach($obj as $o){

            $o['parameters_id'] = $o['parameters_id'];
            unset($o['id']);

            $o['log_id'] = $log_id;
            $o['time_id'] = $id;
            $o['create_time'] = TIME_NOW;
            $o['user_id'] = $this->uid;

            model('enterprise_xuanjian_parameters_log')->data($o)->add();
            
        }

        $this->success();
        

    }


    /** 巡检开始
     * start
     * @param mixed $id 当次巡检ID
     * @return mixed 
     */
    function start($id){

        $this->_check_login();
        $data['start_time'] = TIME_NOW;
        $id = model('enterprise_xuanjian_final_log')->data($data)->save($id);
        $this->success(['id'=>$id]);
    }



    function test(){

        $a = strtotime('6:00') < strtotime('12:00');

        var_dump($a);
    }

}
?>