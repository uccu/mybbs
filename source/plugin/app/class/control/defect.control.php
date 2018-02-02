<?php


/** 控制器  ===  缺陷  

 * 


 */

namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class defect extends base\e{
    function _beginning(){
        // $this->_check_login();
    }

    
    /** 填写缺陷
     * fillIn
     * @param mixed $explanation 
     * @param mixed $state 
     * @param mixed $type 
     * @return mixed 
     */
    function fillIn($explanation,$state,$type,$equip_id = 0,$area_id = 0,$inspection_id = 0,$gid){
        

        $this->_check_login();

        $pic = $this->uploadFiles();
        $pic = $pic ? implode(',',$pic) : '';
        
        $data['explanation'] = post('explanation',$explanation);
        $data['state'] = post('state',$state);
        $data['type'] = post('type',$type);
        $data['pic'] = post('pic',$pic);
        $data['equip_id'] = post('equip_id',$equip_id);
        $data['area_id'] = post('area_id',$area_id);
        $data['user_id'] = post('user_id',$this->uid);
        $data['create_time'] = TIME_NOW;
        $data['gid'] = post('gid',$gid);


        

        if(1){

            $name = $this->userInfo['nametrue'];
            $date = date('Y年m月d日 H:i:s');
            if($inspection_id)$inspection = model('inspection')->find($inspection_id);

            $equip = model('enterprise_equipment')->find($data['equip_id']);
            $area = model('enterprise_equipment')->find($equip['bid']);
            // $equip = 


            $type = model('defect_type')->where(['name'=>$data['state']])->find();
            $type = $type['states'];

            $group = model('user_group')->find($type);
            $state = $group['states'];
            
            $data['push_id'] = [];
            $msg = '巡检员'.$name.'与'.$date.($inspection_id?'在巡检'.$inspection['title'].'时':'').'，填写了'.$area['title'].'-'.$equip['title'].'的普通缺陷，请尽快与该设备负责人联系并尽快处理！';
            // $this->error($type.'.'.$data['type'].'.1');
            if($state == 1){

                $where['gid'] = 1;
                $where['bid'] = $this->userInfo['bid'];
                $users = model('user')->where($where)->field('uid')->limit(999)->select();
                
                foreach($users as &$user2){

                    $z = $this->_pusher($msg,$user2['uid']);
                    $user2 = $user2['uid'];
                }
                $data['push_id'] = $users;
                
            }
            
            if($state == 2 || $state == 1 || $state == 3){

                if($this->userInfo['gid'] == 2){
                    $z = $this->_pusher($msg,$this->uid);
                
                    $data['push_id'][] = $this->uid; 
                }
                
                
                
            }
            
            if($state == 3 || $state == 1){

                $where = [];
                $where['value'] = ['contain','(^|,)'.$data['equip_id'].'($|,)','REGEXP'];
                $users = $users = $equip['uid']?explode(',',$equip['uid']):[];
                foreach($users as $user){

                    $z = $this->_pusher($msg,$user);
                }
                $data['push_id'] = array_merge($users ,$data['push_id'] );
            }

            if($state == 4){

                $where['gid'] = 4;
                $where['bid'] = $this->userInfo['bid'];
                $users = model('user')->where($where)->field('uid')->limit(999)->select();
                
                foreach($users as &$user2){

                    $z = $this->_pusher($msg,$user2['uid']);
                    $user2 = $user2['uid'];
                }
                $data['push_id'] = $users;

            }

            $data['push_id'] = implode(',',$data['push_id']);

        }

        model('defect')->data($data)->add();
        


        $this->success();


    }


    /** 列表
     * lists
     * @return mixed 
     */
    function lists($gid = 0,$search = '',$status = -1,$order = 0,$type = '',$page = 1,$limit = 10){

        $order = post('order',$order);
        $search = post('search',$search);
        $type = post('type',$type);
        $limit = post('limit',$limit);
        $page = post('page',$page);
        $status = post('status',$status);
        $gid = post('gid',$gid);

        switch($order){
            case '1':
                $order = ['create_time'=>'0'];
                break;
            default:
                $order = ['create_time'=>'1'];
                break;
        }
        if($type){

            $where['type'] = $type;
        }
        

        if($status != -1 && $status != 0){
            $where['answer_id'] = ['logic',0,'!='];
        }elseif($status == 0){
            $where['answer_id'] = 0;

        }
        $where['gid'] = $gid;

        if($search){
            $where2['type'] = ['contain','%'.$search.'%','LIKE'];
            $where2['explanation'] = ['contain','%'.$search.'%','LIKE'];
        }
            
        $list = model('defect')->where($where)->where($where2,false,'OR')->page($page,$limit)->order($order)->select();
        // die();

        foreach($list as $k=>&$v){

            $v['userInfo'] = model('user')->field(['uid','nickname'])->find($v['user_id']);
            $v['areaInfo'] = model('enterprise_equipment')->find($v['area_id']);
            $v['equipInfo'] = model('enterprise_equipment')->find($v['equip_id']);
            $v['date'] = date('Y.m.d H:i:s',$v['create_time']);

            if(!$v['userInfo']|| !$v['areaInfo'] || !$v['equipInfo'])unset($list[$k]);
            
        }

        $list = array_values($list);

        $this->success(['list'=>$list]);
    }
    
    /** 详情
     * info
     * @param mixed $id 
     * @return mixed 
     */
    function info($id){

        $id = post('id',$id);

        $v = model('defect')->find($id);

        if(!$v)$this->error('不存在！');

        $v['userInfo'] = model('user')->field(['uid','nickname'])->find($v['user_id']);
        $v['areaInfo'] = model('enterprise_equipment')->find($v['area_id']);
        $v['equipInfo'] = model('enterprise_equipment')->find($v['equip_id']);
        $v['date'] = date('Y.m.d H:i:s',$v['create_time']);

        if(!$v['userInfo']|| !$v['areaInfo'] || !$v['equipInfo'])$this->error('错误！');
            

        $this->success(['info'=>$v]);
    }


    /** 缺陷状态
     * type
     * @return mixed 
     */
    function type($gid){

        $gid = post('gid',$gid,'%d');

        $where = [];
        if($gid)$where['gid'] = $gid;
        $list = model('defect_type')->where($where)->limit(99)->select();

        $this->success(['list'=>$list]);
    }


    /** 推荐专家
     * expert
     * @param mixed $equip_id 
     * @param mixed $type 
     * @return mixed 
     */
    function expert($equip_id,$type = ''){

        $equip_id = post('equip_id',$equip_id,'%d');
        $type = post('type',$type);

        $where['value'] = ['contain','(^|,)'.$equip_id.'($|,)','REGEXP'];
        $where['end_time'] = ['logic',TIME_NOW,'>'];

        $list = model('master_equipment')->where($where)->field('uid')->limit(999)->select();
        $out['count'] = count($list);

        foreach($list as &$v){

            $v = $v['uid'];
        }

        $where = [];
        if($list)$where['uid'] = ['contain',$list,'IN'];
        else $where['uid'] = '-1';
        
        $out['list'] = model('user')->where($where)->field(['nickname','thumb','fans','follow','answer','uid','label','experience'])->limit(999)->select();

        $where = [];
        if($type){

            $where['field'] = ['contain','%'.$type.'%','LIKE'];

        }
        $where['type'] = 2;
        $list = model('user')->where($where)->field(['nickname','thumb','fans','follow','answer','uid','label','experience'])->order('rand()')->limit(10)->select();

        $out['list'] = array_merge($out['list'],$list);

        $this->success($out);

    }


    /** 解决方案
     * answerList
     * @param mixed $id 
     * @param mixed $equip_id 
     * @return mixed 
     */
    function answerList($id,$equip_id,$type){

        $id = post('id',$id);
        $equip_id = post('equip_id',$equip_id);
        $type = post('type',$type);

        $this->uid;

        # 是否有权限设置有用
        $out['canPlay'] = '0'; 
        $defect = model('defect')->find($id);
        if($defect['user_id'] == $this->uid && $defect['answer_id'] == 0){
            $out['canPlay'] = '1'; 
        }
        
        # 有用的解决方案
        if($defect['answer_id']){
            $where3['id'] = $defect['answer_id'];
            $list = model('defect_answer')->where($where3)->limit(99)->select();
            if($list){
                $use = $list[0]['id'];
                $list[0]['useful'] = '1';
            }
        }else{
            $list = [];
        }

        # 该缺陷的解决方案
        $where['bid'] = $id;
        if($use)$where['id'] = ['logic',$use,'!='];
        $list2 = model('defect_answer')->where($where)->limit(99)->select();
        foreach($list2 as &$v){
            $v['useful'] = '0';
        }
        $list = array_merge($list,$list2);

        # 设备的其他解决方案
        $where2['equip_id'] = $equip_id;
        if($type)$where2['type'] = $type;
        $where2['bid'] = ['logic',$id,'!='];
        if($use)$where2['id'] = ['logic',$use,'!='];
        $list3 = model('defect_answer')->where($where2)->limit(99)->select();
        foreach($list3 as &$v){
            $v['useful'] = '0';
        }
        $list = array_merge($list,$list3);

        $out['list'] = $list;

        
        

        $this->success($out);

    }

    /** 解决方案有效
     * useful
     * @param mixed $id 
     * @param mixed $answer_id 
     * @return mixed 
     */
    function useful($id,$answer_id){

        $id = post('id',$id);
        $answer_id = post('answer_id',$answer_id);

        $out['canPlay'] = '0'; 
        $defect = model('defect')->find($id);
        if($defect['user_id'] == $this->uid){
            $out['canPlay'] = '1'; 
        }else{
            $this->error('不能操作！');
        }
        model('defect')->data(['answer_id'=>$answer_id])->save($id);
        $this->success();
    }
}

?>