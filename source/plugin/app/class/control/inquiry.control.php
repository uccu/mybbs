<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class inquiry extends base\e{
    function _beginning(){
        //$this->_check_login();
    }


    function info($id){
        $id = post('id',$id,'%d');
 
        model('inquiry')->data(array('read'=>array('add',1)))->save($id);

        $t['info'] = model('inquiry')->mapping('i')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname','type'),
            'collect'=>array('_join'=>'LEFT JOIN','_mapping'=>'c','_on'=>'i.id=c.id AND c.type=\'w\' AND c.uid='.$this->uid,'uid'=>'collected')
        ))->find($id);
        if(!$t['info'])$this->errorCode(439);
        $t['info']['collected'] = $t['info']['collected']?'1':'0';


        $t['follow'] = model('fans')->where(array('uid'=>$t['info']['uid'],'fans_id'=>$this->uid))->get_field();
        $t['collect'] = model('collect')->where(array('type'=>'w','uid'=>$this->uid,'id'=>$t['info']['id']))->get_field();

        $t['paid'] = model('inquiry_paid')->where(array('uid'=>$this->uid,'id'=>$id))?'1':'0';

        $t['replyCount'] = model('inquiry_list')->where(array('bid'=>$id))->get_field();

        

        $t['adopt'] = model('inquiry_list')->mapping('r')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','type','nametrue'=>'nickname'),
            'inquiry_zan'=>array('_join'=>'LEFT JOIN','_on'=>'r.id=z.id AND z.uid='.$this->uid,'_mapping'=>'z','uid'=>'iszan')
        ))->where(array('bid'=>$id,'adopt'=>1))->limit(999)->order(array('ctime'=>'DESC'))->select();
        foreach($t['adopt'] as &$v){
            $v['iszan'] = $v['iszan']?'1':'0';
            $v['quest'] = $this->quest_list($v['id']);
        }
        $t['reply'] = model('inquiry_list')->where(array('bid'=>$id,'adopt'=>0))->limit(3)->order(array('ctime'=>'DESC'))->select();
        foreach($t['reply'] as &$v){
            $v['iszan'] = $v['iszan']?'1':'0';
            $v['quest'] = $this->quest_list($v['id']);
        }

        
        $this->success($t);
    }

    function reply($id){

        
        
        $id = post('id',$id,'%d');
        $page = post('page',1);
        $limit = post('limit',10);
        $p = model('inquiry_paid')->where(array(
            'uid'=>$this->uid,
            'id'=>$id
        ))->find();
        $inquiry = model('inquiry')->find($id);
        $this->_check_phone();
        if($inquiry['uid'] != $this->uid){

            // if(!$p)$this->_check_access();
        }
        

        $t['reply'] = model('inquiry_list')->mapping('r')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nametrue'=>'nickname','type'),
            'inquiry_zan'=>array('_join'=>'LEFT JOIN','_on'=>'r.id=z.id AND z.uid='.$this->uid,'_mapping'=>'z','uid'=>'iszan'),
            'inquiry_paid'=>array('_join'=>'LEFT JOIN','_on'=>'r.id=p.id AND p.uid='.$this->uid,'_mapping'=>'p','uid'=>'ispaid')
        ))->where(array('bid'=>$id))->page($page,$limit)->order(array('adopt'=>'DESC','ctime'=>'DESC'))->select();
        foreach($t['reply'] as &$v){
            $v['iszan'] = $v['iszan']?'1':'0';
            $v['ispaid'] = $v['ispaid']?'1':'0';
            $v['quest'] = $this->quest_list($v['id']);
        }

        $this->success($t);
    }


    function quest($id,$content){

        $this->_check_login();
        $this->_check_phone();
        $id = post('id',$id,'%d');
        $content = post('content',$content);
        $uid = $this->uid;

        $reply = model('inquiry_list')->find($id);

        if(!$reply)$thi->error('没毛病！');

        $data['reply_id'] = $id;
        $data['content'] = $content;
        $data['create_time'] = TIME_NOW;
        $data['uid'] = $uid;

        model('inquiry_reply')->data($data)->add();
        
        $this->success();

    }

    private function quest_list($id){

        return model('inquiry_reply')->mapping('r')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname','type')
        ))->where(['reply_id'=>$id])->order('create_time')->limit(999)->select();

    }


    function lists($bid){
        $bid = post('bid',$bid,'%d');
        if($bid)$where['bid'] = $bid;
        $page = post('page',1);
        $limit = post('limit',10);
        $t['list'] = model('inquiry')->mapping('i')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname','type'),
            'collect'=>array('_join'=>'LEFT JOIN','_mapping'=>'c','_on'=>'i.id=c.id AND c.type=\'w\' AND c.uid='.$this->uid,'uid'=>'collected'),
            'inquiry_paid'=>array('_join'=>'LEFT JOIN','_mapping'=>'p','_on'=>'i.id=p.id AND p.uid='.$this->uid,'ctime'=>'paid')
        ))->where($where)->order(array('ctime'=>'DESC'))->page($page,$limit)->select();
        foreach($t['list'] as &$v){
            $v['collected'] = $v['collected']?'1':'0';
            $v['paid'] = $v['paid']?'1':'0';
            $v['answer'] = model('inquiry_list')->where(array('bid'=>$v['id']))->get_field().'';
        }
        $t['uid'] = $this->uid;
        $this->success($t);

    }
    
    function answer(){
        $this->_check_login();
        $this->_check_phone();
        $ty = $this->userInfo['type'];
        if($ty<1)$this->errorCode(411);
        $data['uid'] = $this->uid;
        $data['bid'] = post('bid',0);
        if(!$i = model('inquiry')->find($data['bid']))$this->errorCode(413);
        $data['content'] = post('content','');
        $data['img'] = post('img','');
        $data['ctime'] = TIME_NOW;
        $r = model('inquiry_list')->data($data)->add();
        if(!$r)$this->errorCode(413);
        model('inquiry')->data(array('answer'=>array('add',1)))->save($data['bid']);
        model('user')->data(array('answer'=>array('add',1)))->save($this->uid);


        $user = model('user')->find($i['uid']);
        if($user)$this->_pusher($user['nickname'].'回答了您发布的问诊',$i['uid']);
        $this->_handle_score(5,'发布问诊',3);
        $this->success();
    }

    function publish(){
        $this->_check_login();
        $this->_check_phone();
        $z = model('inquiry')->data($_POST)->add();
        if(!$z)$this->errorCode(415);
        $e2 = model('equipment_list')->find($_POST['bid']);
        $e1 = model('equipment_list')->find($e2['bid']);
        if(!$e1)$this->errorCode(415);
        $data['count'] = array('add',1);
        $data['utime'] = TIME_NOW;
        if($e2['utime']<$this->today)$data['today_count'] = 1;
        else $data['today_count'] = array('add',1);
        model('equipment_list')->data($data)->save($e2['id']);
        if($e1['utime']<$this->today)$data['today_count'] = 1;
        else $data['today_count'] = array('add',1);
        model('equipment_list')->data($data)->save($e1['id']);

        $this->_handle_score(5,'回答问题');
        $this->success();

    }

    function search($search){
        $search = post('search',$search);
        if($search)$where['title'] = array('contain','%'.$search.'%','LIKE');
        else $where = '1=2';
        $page = post('page',1);
        $limit = post('limit',10);
        $t['list'] = model('inquiry')->mapping('i')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname','type'),
            'collect'=>array('_join'=>'LEFT JOIN','_mapping'=>'c','_on'=>'i.id=c.id AND c.type=\'w\' AND c.uid='.$this->uid,'uid'=>'collected'),
            'inquiry_paid'=>array('_join'=>'LEFT JOIN','_mapping'=>'p','_on'=>'i.id=p.id AND p.uid='.$this->uid,'ctime'=>'paid')
        ))->where($where)->order(array('ctime'=>'DESC'))->page($page,$limit)->select();
        foreach($t['list'] as &$v){
            $v['collected'] = $v['collected']?'1':'0';
            $v['paid'] = $v['paid']?'1':'0';
            $v['answer'] = model('inquiry_list')->where(array('bid'=>$v['id']))->get_field().'';
        }
        $this->success($t);
    }

    # 专家搜索
    function expert_search($search){
        $search = post('search',$search);
        $where['type'] = 2;
        if($search)$where['nametrue'] = array('contain','%'.$search.'%','LIKE');
        // else $where['uid'] = '0';
        //else $where['is_login'] = '1';
        $page = post('page',1);
        $limit = post('limit',10);
        $t['list'] = model('user')->mapping('u')->add_table(array(
             'fans'=>array('_join'=>'LEFT JOIN','_on'=>'u.uid=f.uid AND f.fans_id='."'{$this->uid}'",'_mapping'=>'f','fans_id'=>'followed')
        ))->field(array(
            "uid","thumb","nickname","experience","label","type","is_login","answer",'nametrue',"fans","follow","followed",'is_free'
        ))->where($where)->page($page,$limit)->order('location')->select();
        foreach($t['list'] as &$v){
            $v['followed'] = $v['followed']?'1':'0';
        }
        $this->success($t);
    }




    function collect($id){
        $this->_check_login();
        $this->_check_phone();
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
    function zan($id){
        $this->_check_login();
        
        $id = post('id',$id,'%d');
        $data['uid'] = $this->uid;


        $i = model('inquiry_list')->find($id);
        if(!$i)$this->errorCode(439);

        $data['id'] = $id;
        $f = model('inquiry_zan')->where($data)->find();
        if($f){
            if($i['zan'])model('inquiry_list')->data(array('zan'=>array('add',-1)))->save($id);
            model('inquiry_zan')->where($data)->remove();
            $this->_handle_score(-100,'点赞被取消',0,$i['uid']);
            $z['collected'] = '0';
        }else{
            model('inquiry_list')->data(array('zan'=>array('add',1)))->save($id);
            model('inquiry_zan')->data($data)->add();
            $this->_handle_score(100,'回答被点赞',0,$i['uid']);
            $z['collected'] = '1';
        }
        $this->success($z);
    }

    # 专家列表
    function expert_list($id = 0){

        $id = post('id',$id,'%d');

        $inquiry = model('inquiry')->find($id);

        $d2 = model('equipment_list')->find($inquiry['bid']);

        $d1 = model('equipment_list')->find($d2['bid']);

        $where['type'] = 2;
        
        if($d1){

            $where['field'] = array('contain','%'.$d1['name'].'%','LIKE');
        }
        model('cache')->replace('test1',$id.'|'.implode(',',$where));
        $z['list'] = model('user')->field(array('uid','nickname','thumb','nametrue','label','is_free'))->where($where)->order(array('location','uid'))->limit(999)->select();
        if(!$z['list']){

            unset($where['field']);
            $z['list'] = model('user')->field(array('uid','nickname','thumb','nametrue','label','is_free'))->where($where)->order(array('location','uid'))->limit(3)->select();

        }
        $this->success($z);

    }

    function expert_answer($uid = 0){
        $this->_check_login();

        $where['uid'] = post('uid',$uid,'%d');
        $where['id'] = $this->uid;
        $where['ctime'] = array('logic',TIME_NOW-24*3600,'>');

        model('expert_paid')->where($where)->data(array('answer'=>1))->save();

        $this->success();

    }


    function pay($id=0){
        $this->_check_login();
        $this->_check_phone();
        $id = post('id',$id,'%d');
        $type = post('type',0);

        $p = model('inquiry_paid')->where(array(
            'uid'=>$this->uid,
            'id'=>$id
        ))->find();
        if($p)$this->errorCode(431);

        if($type==0){
            if($this->userInfo['score']<100)$this->errorCode(442);
            $this->_handle_score(-100,'支付问诊');
            model('inquiry_paid')->data(array(
                'uid'=>$this->uid,
                'ctime'=>TIME_NOW,
                'id'=>$id
            ))->add();
            $this->success();
        }elseif($type==2){
            control('pay')->__wcpay('inquiry',100,$id);
        }elseif($type==1){
            control('pay')->__alipay('inquiry',1,$id);
        }else{
            $this->errorCode(430);
        }

    }

    function ex_pay($id=0){
        $this->_check_login();
        $this->_check_phone();
        $id = post('id',$id,'%d');
        $type = post('type',0);

        // $p = model('expert_paid')->where(array(
        //     'uid'=>$this->uid,
        //     'id'=>$id
        // ))->find();
        // if($p)$this->errorCode(431);

        if($type==0){
            if($this->userInfo['score']<100)$this->errorCode(442);
            $this->_handle_score(-100,'支付专家咨询');
            model('expert_paid')->data(array(
                'uid'=>$this->uid,
                'ctime'=>TIME_NOW,
                'id'=>$id
            ))->add();
            $this->success();
        }elseif($type==2){
            control('pay')->__wcpay('expert',100,$id);
        }elseif($type==1){
            control('pay')->__alipay('expert',1,$id);
        }else{
            $this->errorCode(430);
        }

    }



    function _auto(){

        // $where['eanswer'] = 0;
        // $where['ectime'] = array('logic',TIME_NOW-24*3600,'<');

        // model('user')->add_table(array(
        //     'expert_paid'=>array('_on'=>'uid','answer'=>'eanswer','ctime'=>'ectime')
        // ))->where($where)->data(array('score'=>array('add',100)))->save();

        // $where2['answer'] = 0;
        // $where2['ctime'] = array('logic',TIME_NOW-24*3600,'<');

        if(rand()<0.1)model('cache')->plus('finish_inquiry');
        if(rand()<0.1)model('cache')->plus('unfinish_inquiry');

        // $list = model('expert_paid')->where($where2)->limit(999)->select();

        // foreach($list as $v){

        //     $this->_handle_score(100,'咨询退款',0,$v['uid']);

        //     $this->_pusher('很抱歉！您咨询的专家24小时内未回复您的问题，我们已经退款到您的积分账户。',$v['uid'],array('type1'=>array(
        //         "id"=>'0',
                
        //     )));

        // }

        // ;

        // model('expert_paid')->where($where2)->data(array('answer'=>1))->save();
        
        $o1 = date('H',TIME_NOW + 300)+24 . ':'.date('i',TIME_NOW + 300);
        $o2 = date('H',TIME_NOW)+24 . ':'.date('i',TIME_NOW );

        $o3 = date('H',TIME_NOW + 300) . ':'.date('i',TIME_NOW + 300);
        $o4 = date('H',TIME_NOW) . ':'.date('i',TIME_NOW );
        $where = [];
        $where['end_time@1'] = ['between',[$o1,$o2]];
        $where['end_time@2'] = ['between',[$o3,$o4]];

        $z = model('inspection_time')->where($where,false,'OR')->limit(99)->select();

        foreach($z as $inspection_time){

            $inspection_time_id = $inspection_time['id'];
            $inspection_id = $inspection_time['bid'];/** 线路id */
            $inspection = model('inspection')->find($inspection_id);

            $xj_ids = [];
            if($inspection['uid']){
                $xj_ids = explode(',',$inspection['uid']);
            }

            $where = [];
            $where['id'] = ['contain',explode(',',$inspection['value']),'IN'];
            $where['del'] = 1;
            $qy = model('enterprise_equipment')->where($where)->limit(9999)->select();
            
            $last_final_log = model('enterprise_xuanjian_final_log')->where(['inspection_time_id'=>$inspection_time_id])->find();

            if(strtotime($last_final_log['create_time']) > strtotime($inspection_time['start_time']) - $inspection_time['effective_time']){
                
                if($last_final_log['state']!=1){
                    // 巡检未及时完成
                    $user = model('user')->find($last_final_log['user_id']);

                    $msg = '巡检员'.$user['nametrue'].'于'.date('Y年m月d日H:i:s',$last_final_log['start_time']).'在巡检'.$inspection['title'].'时，未按时完成巡检，请尽快与巡检员联系并尽快处理！';

                    foreach($qy as $qyv ){

                        $log = model('enterprise_xuanjian_log')->limit(999)->where(['user_id'=>$user_id,'area_id'=>$qyv['id'],'final_log_id'=>$last_final_log['id']])->find();
                        
                        if(!$log){
                            $ids = $qyv['uid']?explode(',',$qyv['uid']):[];
                            foreach($ids as $v)$this->_pusher($msg,$v);
                        }
                    }


                    $this->_pusher($msg,$last_final_log['user_id']);

                }

            }else{
                // 未巡检
                $msg = '巡检'.$inspection['title'].date('Y年m月d日').'的'.$inspection_time['start_time'].'～'.$inspection_time['end_time'].'的巡检时间段，没有巡检人员进行巡检，请尽快与巡检员联系并尽快处理！';

                foreach($xj_ids as $v)$this->_pusher($msg,$v);

                foreach($qy as $q){

                    $ids = $q['uid']?explode(',',$q['uid']):[];
                    foreach($ids as $v)$this->_pusher($msg,$v);
                }

            }
            
        }

    }

    function tet(){

        
    }
    


}
?>