<?php

# 巡检系统

namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class xj extends base\e{
    function _beginning(){
        // $this->_check_login();
    }


    /** 巡检路线选择
     * choose
     * @return mixed 
     */
    function choose(){

        $user_id = $this->uid;
        $lx = model('inspection')->where(['uid'=>['contain','(^|,)'.$user_id.'($|,)','REGEXP']])->order(['id'])->limit(99)->select();
        // if(!$lx)$this->error('没有巡检路线！');
        foreach($lx as &$v){

            $u = explode(',',$v['value']);
            $v['count'] = count($u);
        }

        $out['list'] = $lx;
        $this->success($out);
        
    }
    

    # 巡检首页
    function myxj($id){

        $id = post('id',$id,'%d');

        $user_id = $this->uid;
        // $user_id = 525;

        # 获取巡检路线
        if(!$id)$lx = model('inspection')->where(['uid'=>['contain','(^|,)'.$user_id.'($|,)','REGEXP']])->order(['id'])->find();
        else $lx = model('inspection')->find($id);
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
            $data['date'] = date('Y.m.d');  
            $data['inspection_time_id'] = $now_d;
            $data['message'] = '';
            $id = model('enterprise_xuanjian_final_log')->data($data)->add();
            $lxj = model('enterprise_xuanjian_final_log')->find($id);
        }


        $where['id'] = ['contain',explode(',',$lx['value']),'IN'];
        $where['del'] = 1;
        $qy = model('enterprise_equipment')->where($where)->limit(9999)->order(['orders'=>'ASC'])->select();

        $date = date('Y-m-d');

        $out['finished'] = '1';

        foreach($qy as &$qyv ){

            $log = model('enterprise_xuanjian_log')->limit(999)->where(['user_id'=>$user_id,'area_id'=>$qyv['id'],'final_log_id'=>$lxj['id']])->select();
            $qyv['logCount'] = count($log);

            if(!$qyv['logCount'])$out['finished'] = '0';

            // model('enterprise_xuanjian_final_log')->where->add();
            
            // $qyv['warning_times'] = '0';
        }


        $out['lx'] = $lx;
        $out['qy'] = $qy;
        $out['time'] = $time2;
        $out['finals'] = $lxj;
        $out['count'] = count($out['qy']);

        $this->success($out);

    }


    # 获取正在巡检的巡检信息
    private function getDuringXJ($user_id){

        # 用户不存在
        if(!$user_id)return false;

        $where['user_id'] = $user_id;
        $final = model('enterprise_xuanjian_final_log')->where($where)->order(['create_time'=>'desc'])->find();

        # 不是进行中
        if(!$final || $final['state'] == -1)return false;

        $time = model('inspection_time')->find($final['inspection_time_id']);
        if(!$time)return false;

        

        $final['lx_id'] = $time['bid'];

        # 是否过期
        $date = date('Y.m.d',TIME_NOW);
        if($date != $final['date'] || $time['end_time'] < date('H:i',TIME_NOW)){
            model('enterprise_xuanjian_final_log')->data(['state'=>'-1'])->where($where)->save();
            return false;
        }
        
        return $final;

    }

    private function getLastFinal($lx_id){

        $where['bid'] = $lx_id;
        $where['start_time'] = ['logic',date('H:i',TIME_NOW),'<'];
        $where['end_time'] = ['logic',date('H:i',TIME_NOW),'>'];

        $time = model('inspection_time')->where($where)->find();
        if(!$time)return false;
        
        $where2['date'] = date('Y.m.d',TIME_NOW);
        $where2['inspection_time_id'] = $time->id;
        $where2['user_id'] = $this->uid;

        $xj = model('enterprise_xuanjian_final_log')->where($where2)->find();
        if(!$xj)return false;

        return $xj;

    }


    # 判断是否可以巡检
    private function checkIfCanXJ($user_id,$lx_id,$error = false){

        if(!$lx_id || !$user_id){
            if($error)$this->error('用户不存在/路线不存在');
            return false;
        }

        
        $inspection = model('inspection')->where(['id'=>$lx_id])->where(['uid'=>['contain','(^|,)'.$user_id.'($|,)','REGEXP']])->find();
        if(!$inspection){
            if($error)$this->error('路线不存在');
            return false;
        }

        $time = model('inspection_time')->where(['bid'=>$inspection['id']])->limit(99)->select();


        if($xj = $this->getDuringXJ($user_id)){
            if($xj['lx_id'] != $inspection['id'] && $xj['state'] != 1){
                if($error)$this->error('您有正在巡检中的路线');
                return false;
            }
            // if($xj['lx_id'] != $inspection['id'] && $xj['state'] == 1){
            //     if($error)$this->error('巡检未开始');
            //     return false;
            // }
            if($xj['lx_id'] == $inspection['id'] && $xj['state'] == 1){
                if($error)$this->error('该线路巡检已结束');
                return false;
            }
        }

        
        foreach($time as $i){

            if(strlen($i['start_time'] == 4))$i['start_time'] = '0'.$i['start_time'];
            if($i['start_time'] < date('H:i',TIME_NOW) && $i['end_time'] > date('H:i',TIME_NOW)){

                return [

                    'lx_id'=>$i['bid'],
                    'time_id'=>$i['id'],

                ];
            }
        }


        if($error)$this->error('该线路未到巡检时间');
        return false;
    }



    /** 主页
     * home
     * @param mixed $id 
     * @return mixed 
     */
    function home($id = 0){

        $id = post('id',$id,'%d');
        $user_id = $this->uid;
        // $user_id = 214;

        $xj = $this->getDuringXJ($user_id);
        $out['ifBeingXJ'] = '0';
        $out['during'] = '0';
        $out['other'] = '0';
        if($xj){
            $out['during'] = '1';
            if($xj['state'] == 0)$out['ifBeingXJ'] = '1';
            $out['duringXJ'] = $xj;
        }

        # 获取路线
        if($id)$lx = model('inspection')->find($id);
        elseif($out['during'])$lx = model('inspection')->find($xj['lx_id']);
        else $lx = model('inspection')->where(['uid'=>['contain','(^|,)'.$user_id.'($|,)','REGEXP']])->order(['id'])->find();
        if(!$lx)$this->error('没有巡检路线！');

        $out['canXJ'] = $this->checkIfCanXJ($user_id,$lx['id']) ? '1' :'0';

        if($out['during'] && $lx['id'] != $xj['lx_id']){
            $out['other'] = '1';
        }

        # 获取路线的区域
        $where['id'] = ['contain',explode(',',$lx['value']),'IN'];
        $where['del'] = 1;
        $qy = model('enterprise_equipment')->where($where)->limit(9999)->order(['orders'=>'ASC'])->select();


        $out['finished'] = '1';
        $lxj = $this->getLastFinal($lx['id']);
        $out['hasXJ'] = $lxj ? '1' : '0';
        if($lxj)$out['nowXJ'] = $lxj;
        foreach($qy as &$qyv ){

            if($lxj){
                $log = model('enterprise_xuanjian_log')->limit(999)->where(['user_id'=>$user_id,'area_id'=>$qyv['id'],'final_log_id'=>$lxj['id']])->select();
                $qyv['logCount'] = count($log);
            }else{
                $qyv['logCount'] = '0';
            }
            
            if(!$qyv['logCount'])$out['finished'] = '0';

        }


        $out['lx'] = $lx;
        $out['qy'] = $qy;
        $out['count'] = count($out['qy']);

        $this->success($out);

    }

    /** 获取区域的设备 以及参数
     * getEquip
     * @param mixed $id 当次巡检ID
     * @return mixed 
     */
    function getEquip($id,$lx_id,$xj_id){

        $id = post('id',$id,'%d');
        $lx_id = post('lx_id',$lx_id,'%d');
        $xj_id = post('xj_id',$xj_id,'%d');

        $user_id = $this->uid;

        $xj = model('enterprise_xuanjian_final_log')->find($xj_id);
        if(!$xj['start_time'])$this->error('请先扫描开始码！');

        $lx = model('inspection')->find($lx_id);
        if(!$lx)$this->error('没有巡检路线！');
        !$id && $this->error('区域参数错误');

        if(!in_array($id,explode(',',$lx['value']))){
            $this->error('该区域不在您的巡检路线中！');
        }

        if(!is_numeric($id)){

            $id = base64_decode($id);
            $id = str_replace('sbgl_','',$id);

        }

        if(!$id)$this->error('id 不合法！');

        $area = model('enterprise_equipment')->find($id);
        
        !$area && $this->error('区域不存在！');

        $log = model('enterprise_xuanjian_log')->limit(999)->where(['user_id'=>$user_id,'area_id'=>$id,'final_log_id'=>$xj_id])->find();

        if($log){

            $this->error('该区域已巡检，请勿重复巡检');
        }

        $qy = model('enterprise_equipment')->where(['bid'=>$id])->limit(9999)->order(['orders'=>'ASC'])->select();

        foreach($qy as $k=>&$v){

            $v['params'] = model('device_parameters')->where(['bid'=>$v['id']])->limit(999)->select();

            if(!$v['params'])unset($qy[$k]);

        }

        $out['qy'] = array_values($qy);
        $out['time'] = TIME_NOW;
        $out['area'] = $area;

        $this->success($out);

    }


    /** 填写工作记录
     * finals
     * @param mixed $message 
     * @return mixed 
     */
    function finals($message,$id){

        $id = post('id',$id);
        $this->_check_login();
        $data['message'] = post('message',$message);
        $data['state'] = 1;

        $xj = model('enterprise_xuanjian_final_log')->find($id);
        
        !$xj && $this->error('巡检不存在');
        if($xj['state'])$this->error('巡检已结束，请勿重复提交');

        model('enterprise_xuanjian_final_log')->data($data)->save($id);
        $this->success();

    }

    /** 获取当次巡检结果
     * getFinals
     * @param mixed $id 
     * @return mixed 
     */
    function getFinals($id){

        $id = post('id',$id);
        $this->_check_login();
        $user_id = $this->uid;
        // $user_id = 557;

        $info = model('enterprise_xuanjian_final_log')->find($id);
        
        // !$info && $this->error('巡检不存在');
        !$info['start_time'] && $this->error('巡检未开始，请扫描开始巡检二维码');
        $out['info'] = $info;
        $info['end_time'] && $this->success($out);

        $time = model('inspection_time')->find($info['inspection_time_id']);
        $inspection = model('inspection')->find($time['bid']);


        $where['id'] = ['contain',explode(',',$inspection['value']),'IN'];
        $where['del'] = 1;
        $qy = model('enterprise_equipment')->where($where)->limit(9999)->order(['orders'=>'ASC'])->select();

        foreach($qy as &$qyv ){

            $log = model('enterprise_xuanjian_log')->limit(999)->where(['user_id'=>$user_id,'area_id'=>$qyv['id'],'final_log_id'=>$id])->select();
            if(!$log)$this->error('还有区域未完成巡检');

        }
        
        
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
        $id = post('id',$id);
        if($_POST['data'])$_POST['data'] = str_ireplace(array('&lt;','&gt;','&quot;','&#39;'),array('<','>','"',"'"),$_POST['data']);
        $data = $_POST['data']?$_POST['data']:$data;
        // $data = '[{"input_type":"0","value":"30","type":"3","bid":"3","parameters_id":"1"}]';

        $obj = json_decode($data,true);
        if(!$obj)$obj = [];
        $data2['area_id'] = $area_id;
        $data2['user_id'] = $this->uid;
        $data2['time'] = TIME_NOW;
        $data2['date'] = date('Y-m-d',TIME_NOW);
        $data2['final_log_id'] = $id;

        $final_log = model('enterprise_xuanjian_final_log')->find($id);

        $inspection_time = model('inspection_time')->find($final_log['inspection_time_id']);
        $inspection = model('inspection')->find($inspection_time['bid']);

        $area = model('enterprise_equipment')->find($area_id);

        $log_id = model('enterprise_xuanjian_log')->data($data2)->add();

        $warns = 0;

        foreach($obj as $o){

            $o['log_id'] = $log_id;
            $o['final_log_id'] = $id;
            $o['create_time'] = TIME_NOW;
            $o['user_id'] = $this->uid;

            model('enterprise_xuanjian_parameters_log')->data($o)->add();
            $parameter = model('device_parameters')->find($o['parameters_id']);
            !$parameter && $this->error('parameters_id 错误');
            $users = [];
            if($o['value'] === ''){
                $warns++;
                
                if($parameter['bid']){

                    $where['value'] = ['contain','(^|,)'.$parameter['bid'].'($|,)','REGEXP'];

                    $equip = model('enterprise_equipment')->find($parameter['bid']);

                    $users = $equip['uid']?explode(',',$equip['uid']):[];

                    

                    if($equip){
                        model('enterprise_equipment')->data(['warning_times'=>['add',1],'warning'=>1])->save($equip['id']);
                        model('enterprise_equipment')->data(['warning_times'=>['add',1],'warning'=>1])->save($equip['bid']);
                    }
                    
                    $msg = '巡检员'.$this->userInfo['nametrue'].'于'.date('Y年m月d日 H:i:s').'在巡检'.$inspection['title'].'时，'.$area['title'].'-'.$equip['title'].'的'.$parameter['name'].'数值未填写，请与巡检人员联系确认原因并尽快处理！';
                    foreach($users as $user){

                        $z = $this->_pusher($msg,$user);
                        model('user')->data(['has_warning'=>1])->save($user);
                        $user = model('user')->find($user);
                        if($user)$this->_message($user['usercode'],$msg);
                        
                    }
                    model('user')->data(['has_warning'=>1])->save($this->uid);

                    $data = [];
                    $data['bid'] = $equip['id'];
                    $data['type'] = 1;
                    $data['states'] = 1;
                    $data['value'] = $parameter['name'].'未填';
                    $data['create_time'] = TIME_NOW;
                    $data['final_log_id'] = $id;
                    $data['user_id'] = $this->uid;
                    if($users){

                        $data['push_id'] = implode(',',$users);
                    }
                    model('warning_log')->data($data)->add();

                }

                
            }elseif($o['value'] < $parameter['min_value']){
                $warns++;
                if($parameter['bid']){

                    $where['value'] = ['contain','(^|,)'.$parameter['bid'].'($|,)','REGEXP'];
                    $equip = model('enterprise_equipment')->find($parameter['bid']);
                    $users = $equip['uid']?explode(',',$equip['uid']):[];

                    
                    if($equip){
                        model('enterprise_equipment')->data(['warning_times'=>['add',1],'warning'=>1])->save($equip['id']);
                        model('enterprise_equipment')->data(['warning_times'=>['add',1],'warning'=>1])->save($equip['bid']);
                    }

                    foreach($users as $user){

                        $z = $this->_pusher('巡检员'.$this->userInfo['nametrue'].'于'.date('Y年m月d日 H:i:s').'在巡检'.$inspection['title'].'时，'.$area['title'].'-'.$equip['title'].'填写的'.$parameter['name'].'数值低于安全范围最低值，请尽快与巡检员联系并尽快处理！',$user);
                        model('user')->data(['has_warning'=>1])->save($user);
                        $user = model('user')->find($user);
                        if($user)$this->_message($user['usercode'],'巡检员'.$this->userInfo['nametrue'].'于'.date('Y年m月d日 H:i:s').'在巡检'.$inspection['title'].'时，'.$area['title'].'-'.$equip['title'].'填写的'.$parameter['name'].'数值低于安全范围最低值，请尽快与巡检员联系并尽快处理！');
                    }
                    model('user')->data(['has_warning'=>1])->save($this->uid);

                    $level = model('warning_level')->where([
                        'bid'=>$parameter->id,
                        'state'=>-1,
                        'value_low'=>['logic',$o['value'],'>='],
                        'value_height'=>['logic',$o['value'],'<']
                        
                        ])->find();

                    

                    $data = [];
                    $data['bid'] = $equip['id'];
                    $data['type'] = 1;
                    $data['user_id'] = $this->uid;
                    $data['states'] = 1;
                    $data['value'] = $level?$level['name']:$parameter['name'].'过低';
                    $data['create_time'] = TIME_NOW;
                    $data['final_log_id'] = $id;
                    
                    if($users){

                        $data['push_id'] = implode(',',$users);
                    }
                    model('warning_log')->data($data)->add();

                }
            }elseif($o['value'] > $parameter['max_value']){
                $warns++;
                if($parameter['bid']){

                    $where['value'] = ['contain','(^|,)'.$parameter['bid'].'($|,)','REGEXP'];
                    $equip = model('enterprise_equipment')->find($parameter['bid']);
                    $users = $equip['uid']?explode(',',$equip['uid']):[];

                    
                    if($equip){
                        model('enterprise_equipment')->data(['warning_times'=>['add',1],'warning'=>1])->save($equip['id']);
                        model('enterprise_equipment')->data(['warning_times'=>['add',1],'warning'=>1])->save($equip['bid']);
                    }

                    foreach($users as $user){
                        
                        $z = $this->_pusher('巡检员'.$this->userInfo['nametrue'].'于'.date('Y年m月d日 H:i:s').'在巡检'.$inspection['title'].'时，'.$area['title'].'-'.$equip['title'].'填写的'.$parameter['name'].'数值高于安全范围最高值，请尽快与巡检员联系并尽快处理！',$user);
                        model('user')->data(['has_warning'=>1])->save($user);
                        $user = model('user')->find($user);
                        if($user)$this->_message($user['usercode'],'巡检员'.$this->userInfo['nametrue'].'于'.date('Y年m月d日 H:i:s').'在巡检'.$inspection['title'].'时，'.$area['title'].'-'.$equip['title'].'填写的'.$parameter['name'].'数值高于安全范围最高值，请尽快与巡检员联系并尽快处理！');
                    }
                    model('user')->data(['has_warning'=>1])->save($this->uid);

                    $level = model('warning_level')->where([
                        'bid'=>$parameter->id,
                        'state'=>1,
                        'value_low'=>['logic',$o['value'],'>='],
                        'value_height'=>['logic',$o['value'],'<']
                        
                        ])->find();

                    $data = [];
                    $data['bid'] = $equip['id'];
                    $data['type'] = 1;
                    $data['states'] = 1;
                    $data['value'] = $level?$level['name']:$parameter['name'].'过高';
                    $data['create_time'] = TIME_NOW;
                    $data['final_log_id'] = $id;
                    
                    if($users){

                        $data['push_id'] = implode(',',$users);
                    }
                    model('warning_log')->data($data)->add();

                }
            }

            

            
        }

        $data = [];
        $data['warning_times'] = ['add',$warns];

        model('enterprise_xuanjian_final_log')->data($data)->save($id);

        $this->success();
        

    }


    /** 巡检开始
     * start
     * @param mixed $id 路线id
     * @return mixed 
     */
    function start($id){

        $id = post('id',$id,'%d');
        $this->_check_login();

        $user_id = $this->uid;
        // $user_id = '557';

        $xj = $this->getDuringXJ($user_id);
        if($xj){
            if($xj['state'] != 1)$this->error('正在巡检中，请勿重复开始');
        
        }$xj = $this->checkIfCanXJ($user_id,$id,true);
        
        // if(!$xj)$this->error('无法巡检');

        $data['start_time'] = TIME_NOW;
        $data['user_id'] = $user_id;
        $data['create_time'] = TIME_NOW;  
        $data['date'] = date('Y.m.d');  
        $data['inspection_time_id'] = $xj['time_id'];
        $data['message'] = '';
        $id = model('enterprise_xuanjian_final_log')->data($data)->add();
        $this->success(['id'=>$id]);
    }



    function test(){

        $a = strtotime('6:00') < strtotime('12:00');

        var_dump($a);
    }


    function my_log_list($page = 1,$limit = 10){

        $page = post('page',$page,'%d');
        $limit = post('limit',$limit,'%d');

        if($page < 1)$page = 1;
        if($limit < 1)$limit = 1;
        $offset = ($page - 1) * $limit;

        $list = model('logic')->fetch_all('select date from '.model('logic')->quote_table('enterprise_xuanjian_final_log').' where user_id = '.model('logic')->quote($this->uid).' group by date order by date desc limit '.$offset.','.$limit);

        $this->success(['list'=>$list]);

    }

    function my_log($date){

        $date = post('date',$date);
        // $this->uid = 525;
        // $date = '2017.01.01';
        $list = model('enterprise_xuanjian_final_log')->where(['date'=>$date,'user_id'=>$this->uid])->order(['start_time'=>'desc'])->limit(999)->select();

        $this->success(['list'=>$list,'user_id'=>$this->uid]);

    }


    /** 预警列表
     * warningLogList
     * @param mixed $page 
     * @param mixed $limit 
     * @return mixed 
     */
    function warningLogList($page = 1,$limit = 10){
        // $this->uid = 532;
        // $this->userInfo = [];
        // $this->userInfo['gid'] = 2;
        $this->_check_login();

        $page = post('page',$page);
        $limit = post('limit',$limit);

        if($this->userInfo['gid'] == 1){

        }elseif($this->userInfo['gid'] == 2){

            $where['user_id'] = $this->uid;
        }elseif($this->userInfo['gid'] == 3){
            $where2['uid'] = ['contain','(^|,)'.$this->uid.'($|,)','REGEXP'];
            $value = model('enterprise_equipment')->where($where2)->limit(999)->select();

            foreach($value as &$k){

                $k = $k['id'];
            }

            if(!$value)$this->error('无权限查看');

            $where['bid'] = array('contain',$value,'IN');
        }else{

            $this->error('无权限查看');
        }


        $list = model('warning_log')->where($where)->page($page,$limit)->order(['create_time'=>'desc'])->select();


        foreach($list as &$v){

            $equip_id = $v['bid'];
            $equip = model('enterprise_equipment')->find($equip_id);
            $where2['value'] = ['contain','(^|,)'.$equip_id.'($|,)','REGEXP'];
            $users = $users = $equip['uid']?explode(',',$equip['uid']):[];

            foreach($users as $k=>&$user){

                $user = model('user')->field(['uid','nametrue','usercode'])->find($user);
                if(!$user)unset($users[$k]);
            }
            $users = array_values($users);


            $v['equip_users'] = $users;

            $v['equipInfo'] = model('enterprise_equipment')->field(['title','bid','id'])->find($v['bid']);
            $v['areaInfo'] = model('enterprise_equipment')->field(['title','bid','id'])->find($v['equipInfo']['bid']);
            $finalLogInfo = model('enterprise_xuanjian_final_log')->find($v['final_log_id']);
            $userInfo = model('user')->find($v['user_id']);
            $v['user_name'] = $userInfo['nametrue'];
            $v['user_phone'] = $userInfo['usercode'];
            $inspection_time = model('inspection_time')->find($finalLogInfo['inspection_time_id']);
            $v['inspection'] = model('inspection')->find($inspection_time['bid']);
            $v['start_time'] = $inspection_time['start_time'];

        }

        $out['list'] = $list;

        model('user')->data(['has_warning'=>0])->save($this->uid);


        $this->success($out);

    }


    /** 昨日记录
     * lastLog
     * @param mixed $equip_id 
     * @return mixed 
     */
    function lastLog($equip_id){

        $equip_id = post('equip_id',$equip_id,'%d');

        $date = date('Y.m.d', TIME_NOW - 24* 3600 );
        $date2 = date('Y-m-d', TIME_NOW - 24* 3600 );

        $final_log = model('enterprise_xuanjian_final_log')->where(['date'=>$date])->order('create_time','desc')->find();
        if(!$final_log)$this->success(['list'=>[]]);

        // $where['final_log_id'] = $final_log['id'];

        $equip = model('enterprise_equipment')->find($equip_id);

        $log = model('enterprise_xuanjian_log')->where(['area_id'=>$equip['bid'],'date'=>$date2,'final_log_id'=>$final_log['id']])->order('time','desc')->find();

        $where['equip_id'] = $equip_id;
        $where['log_id'] = $log['id'];

        $list = model('enterprise_xuanjian_parameters_log')->mapping('i')->add_table([
            'device_parameters'=>[
                'name','unit','input_type','bid'=>'equip_id','DCS','_mapping'=>'p','_on'=>'i.parameters_id=p.id'
            ]
        ])->where($where)->limit(999)->select();

        $this->success(['list'=>$list]);

    }



}
?>