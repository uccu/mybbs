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
    function fillIn($explanation,$state,$type,$equip_id = 0,$area_id = 0){

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


        model('defect')->data($data)->add();

        $this->success();


    }


    /** 列表
     * lists
     * @return mixed 
     */
    function lists($order = 0,$type = '',$page = 1,$limit = 10,$status = -1){

        $order = post('order',$order);
        $type = post('type',$type);
        $limit = post('limit',$limit);
        $page = post('page',$page);
        $status = post('status',$status);

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

        if($status != -1){
            $where['status'] = $status;
        }
            
        $list = model('defect')->where($where)->page($page,$limit)->order($order)->select();

        foreach($list as $k=>&$v){

            $v['userInfo'] = model('user')->field(['uid','nickname'])->find($v['user_id']);
            $v['areaInfo'] = model('enterprise_equipment')->find($v['area_id']);
            $v['date'] = date('Y.m.d H:i:s',$v['create_time']);

            if(!$v['userInfo'] || !$v['areaInfo'])unset($list[$k]);
            
        }

        $list = array_values($list);

        $this->success(['list'=>$list]);
    }
    
    function info($id){

        $id = post('id',$id);

        $v = model('defect')->find($id);

        if(!$v)$this->error('不存在！');

        $v['userInfo'] = model('user')->field(['uid','nickname'])->find($v['user_id']);
        $v['areaInfo'] = model('enterprise_equipment')->find($v['area_id']);
        $v['date'] = date('Y.m.d H:i:s',$v['create_time']);

        if(!$v['userInfo'] || !$v['areaInfo'])$this->error('错误！');
            

        $this->success(['info'=>$v]);
    }


    /** 缺陷状态
     * type
     * @return mixed 
     */
    function type(){


        $list = model('defect_type')->limit(99)->select();

        $this->success(['list'=>$list]);
    }


    function expert($equip_id,$type = ''){

        $equip_id = post('equip_id',$equip_id,'%d');
        $type = post('type',$type);

        $where['value'] = ['contain','(^|,)'.$equip_id.'($|,)','REGEXP'];

        $list = model('master_equipment')->where($where)->field('uid')->limit(999)->select();

        foreach($list as &$v){

            $v = $v['uid'];
        }

        $where = [];
        $where['uid'] = ['contain',$list,'IN'];

        $out['list'] = model('user')->where($where)->field(['nickname','thumb','fans','follow','answer','uid','label','experience'])->limit(999)->select();

        $where = [];
        if($type){

            $where['field'] = ['contain','%'.$type.'%','LIKE'];

        }

        $list = model('user')->where($where)->field(['nickname','thumb','fans','follow','answer','uid','label','experience'])->limit(10)->select();

        $out['list'] = array_merge($out['list'],$list);

        $this->success($out);

    }
}

?>