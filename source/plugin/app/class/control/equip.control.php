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

                $bb = model('equipment_list')->find($bid);

                if($bb['bid']){

                    $v['count'] = model('inquiry')->where(array('bid'=>$v['id']))->get_field();
                    $v['today_count'] = model('inquiry')->where(array('bid'=>$v['id'],'ctime'=>array('logic',$this->today,'>')))->get_field();

                }else{
                    $v['count'] = model('inquiry')->mapping('i')->add_table(array(
                        'equipment_list'=>array(
                            '_on'=>'i.bid=e.id','_mapping'=>'e','bid'=>'kid'
                        )
                    ))->where(array('kid'=>$v['id']))->get_field();
                    $v['today_count'] = model('inquiry')->mapping('i')->add_table(array(
                        'equipment_list'=>array('_on'=>'i.bid=e.id','_mapping'=>'e','bid'=>'kid')
                    ))->where(array('kid'=>$v['id'],'ctime'=>array('logic',$this->today,'>')))->get_field();
                }

                
            }else{
                $v['count'] = model('inquiry')->mapping('i')->add_table(array(
                    'equipment_list@1'=>array(
                        '_on'=>'i.bid=e1.id','_mapping'=>'e1'
                    ),
                    'equipment_list@0'=>array(
                        '_on'=>'e1.bid=e0.id','_mapping'=>'e0','bid'=>'kid'
                    )
                    
                ))->where(array('kid'=>$v['id']))->get_field();
                $v['today_count'] = model('inquiry')->mapping('i')->add_table(array(
                    'equipment_list@1'=>array(
                        '_on'=>'i.bid=e1.id','_mapping'=>'e1'
                    ),
                    'equipment_list@0'=>array(
                        '_on'=>'e1.bid=e0.id','_mapping'=>'e0','bid'=>'kid'
                    )
                    
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

        $count = model('equip_protect')->where(array('uid'=>$this->uid,'ctime'=>array('logic',$this->today,'>')))->get_field();

        $z = model('equip_protect')->data($_POST)->add();
        if(!$z)$this->errorCode(432);



        $city = $this->userInfo['city'];
        $cityName = model('manager_organ')->find($city);
        $province = model('manager_organ')->find($cityName['bid']);
        $province = $province['jgmc'];
        $cityName = $cityName['jgmc'];

        $a = model('user_area')->mapping('a')->add_table(array(
            'manager_user'=>array('_on'=>'mid','_mapping'=>'u','phone')
        ))->limit(999)->select();

        //$r = array();

        // if(!$count){

        //     if($this->userInfo['vip']>TIME_NOW){
        //         $this->_pusher('恭喜您！您申请设备维保信息已经提交成功，获得7.5积分！',$this->uid);
        //         $this->_handle_score(7.5,'发布设备维保',1);

        //     }else{
        //         $this->_pusher('恭喜您！您申请设备维保信息已经提交成功，获得5积分！',$this->uid);
        //         $this->_handle_score(5,'发布设备维保',1);

        //     }

        // }

        

        foreach($a as $v){

            if(array_search($city,explode(',',$v['value']))!==false){
                control('tool:captcha')->_message($v['phone'],'您好！'.$province.'-'.$cityName.'的用户 '.$this->userInfo['usercode'].' 提交了一条维保的信息，请尽快到管理后台查看详情，并尽快与该用户取得联系，谢谢！');
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


    # 配件类型
    function partsType($bid = 1,$type = 1){

        $bid = post('bid',$bid,1);
        $type = post('type',$type,1);
        $list = model('enterprise_equipment')->where(['bid'=>$bid,'del'=>1,'eid'=>$type])->order('orders')->limit(999)->select();

        foreach($list as &$v){

            $id = $v['id'];
            if($v['bid'] == 1){
                $v['count'] = model('parts')->mapping('p')->add_table([
                    'enterprise_equipment'=>[
                        '_on'=>'e.id=p.bid','_mapping'=>'e','id','bid'=>'ebid'
                    ]
                ])->where(['ebid'=>$v['id'],'type'=>$type])->get_field();
            }else{
                $v['count'] = model('parts')->mapping('p')->where(['bid'=>$v['id'],'type'=>$type])->get_field();

            }
        }
        $this->success($list);

    }

    # 配件类表
    function partsList($bid = 0,$search = '',$type = 1){
        $bid = post('bid',$bid,0);
        $type = post('type',$type,1);
        $search = post('search',$search);
        if($bid)$where['bid'] = $bid;
        if($search)$where['name'] = array('contain','%'.$search.'%','LIKE');
        $where['type'] = $type;
        $list = model('parts')->where($where)->order('locate')->limit(999)->select();

        $this->success($list);
    }


    # 配件详情
    function partsInfo($id){

        // $id = post('id',$id,1);
        // $info = model('parts')->find($id);

        // $this->success($info);
        $id = post('id',$id,'%d');
        $info = model('parts')->find($id);
        $this->g->template['value'] = $info['content'];
        $this->g->template['title'] = $info['name'];
        $this->g->template['time'] = '库存：'.$info['stock'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;型号：'.$info['version'];
        T('tool:static');

    }


}
?>