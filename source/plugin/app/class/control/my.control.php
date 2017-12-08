<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class my extends base\e{
    function _beginning(){
        // $this->_check_login();
    }

    function _change_info($info,$v){
        if($v)$info = array($info=>$v);
        return model('user')->data($info)->save($this->uid);
    }

    function choose_char($type){
        //$this->_check_type(-1);
        //$type = post('type',$type,'0');
        $type = 0;
        $data['count'] = model('user')->data(array('type'=>$type))->save($this->uid);
        $this->success($data);
    }

    function change_u_info($nickname,$sex,$city,$plant){
        //$this->_check_type(0);
        $data['nickname'] && $data['nickname'] = $data['nametrue'] = post('nickname',$nickname);
        $data['sex'] && $data['sex'] = post('sex',$sex);
        $data['city'] && $data['city'] = post('city',$city);
        if(!is_numeric($data['city']))$data['city'] && $data['city'] = model('manager_organ')->where(array('jgmc'=>$data['city'],'bid'=>array('logic',0,'!=')))->get_field('id');
        $data['plant'] && $data['plant'] = post('plant',$plant);
        $data['thumb'] = post('thumb');
        if(!$data['thumb'])unset($data['thumb']);
        $data['complete'] = 1;
        if($this->userInfo['type']<0)$data['type'] = 0;
        $this->_change_info($data);
        $this->success();
    }
    function change_o_info($nickname,$sex,$city,$plant){
        $this->_check_phone();
        $data['nickname'] = $data['nametrue'] = post('nametrue',post('nickname',''));
        $data['sex'] = post('sex',0,'%d');
        $data['city'] = post('city',$city);
        if(!is_numeric($data['city']))$data['city'] = model('manager_organ')->where(array('jgmc'=>$data['city'],'bid'=>array('logic',0,'!=')))->get_field('id');
        $data['plant'] = post('plant','');
        $data['company'] = post('company','');
        $data['at_start'] = post('at_start','');
        $data['at_end'] = post('at_end','');
        // $this->_dateline_format($data,'at_start');
        // $this->_dateline_format($data,'at_end');
        $data['experience'] = post('experience','');
        $data['generator'] = post('generator','');
        $data['label'] = post('label','');
        $data['field'] = post('field','');
        $data['thumb'] = post('thumb','');
        $data['post'] = post('post','');
        if($this->userInfo['type']<0)$data['type'] = 0;
        $data['apply'] = 1;
        $data['apply_time'] = TIME_NOW;
        $data['complete'] = 1;
        if(!$data['thumb'])unset($data['thumb']);
        $this->_change_info($data);
        $this->success();
    }

    function my_info(){
        // $this->uid = 526;
        // $u = $this->userInfo;
        // unset($u['password']);
        $t['info'] = model('user')/*->field(array('uid','nickname','type','label','thumb','sex','score','vip'))*/->find($this->uid);
        unset($t['info']['password']);
        $t['info']['isvip'] = $t['info']['vip']>TIME_NOW ?'1':'0';
        $t['info']['city_name'] = $this->_city_name($t['info']['city']);
        $t['info']['plant_name'] = $this->_rtype_name($t['info']['plant']);
        $t['info']['field_name'] = $this->_equip_name_m($t['info']['field']);
        
        # 部门名
        $t['info']['did_name'] = model('department')->find($t['info']['did']);
        if(!$t['info']['did_name']){
            $t['info']['did_name'] = '';
        }else{
            $t['info']['did_name'] = $t['info']['did_name']['name'];
        }
        # 企业名
        $t['info']['enterprise'] = model('enterprise')->find($t['info']['bid']);
        if(!$t['info']['enterprise']){
            $t['info']['enterprise'] = '';
        }else{
            $t['info']['enterprise'] = $t['info']['enterprise']['name'];
        }
        

        $t['fans'] = model('fans')->where(array('uid'=>$this->uid))->get_field();
        $t['follow'] = model('fans')->where(array('fans_id'=>$this->uid))->get_field();
        $t['collect'] = model('collect')->where(array('uid'=>$this->uid))->get_field();
        $t['message'] = model('message')->where(array('uid'=>$this->uid,'read'=>0))->get_field();
        $t['wx'] = $this->userInfo['wx_pay']?1:0;
        $t['sign'] = model('sign')->where(array('uid'=>$this->uid,'sign_time'=>array('logic',$this->today,'>')))->find() ? 1 : 0 ;
        $this->success($t);
    }

    function shop(){

        $page = post('page',1);
        $limit = post('limit',20);

        $list = model('goods')->field(['goods_id','goods_name','thumb','score'])->page($page,$limit)->order(['location'=>'DESC','goods_id'=>'DESC'])->select();

        $out['list'] = $list;
        $out['score'] = $this->userInfo['score'];
        $this->success($out);

    }

    function shop_detail($id = 0){

        $id = post('id',$id,'%d');
        $info = model('goods')->find($id);
        if(!$info)$this->errorCode(443);
        $info['content'] = '<style>img{max-width:100% !important;display:block !important;height:auto !important}</style>'.$info['content'];
        $out['info'] = $info;
        $this->success($out);

    }

    function shop_log(){

        $page = post('page',1);
        $limit = post('limit',20);

        $list = model('goods_list')->add_table(array(
            'goods'=>array(
                '_on'=>'goods_id','goods_name','thumb'
            )
        ))->where(['uid'=>$this->uid])->page($page,$limit)->order(['ctime'=>'DESC'])->select();

        $out['list'] = $list;

        $this->success($out);
    }

    function shop_log_detail($id){

        $id = post('id',$id,'%d');

        $out['log'] = $info = model('goods_list')->find($id);

        if(!$info){
            $this->errorCode(446);
        }

        $out['goods'] = $goods = model('goods')->find($info['goods_id']);

        if(!$info){
            $this->errorCode(443);
        }

        $this->success($out);

    }

    function shop_get($id,$addr_id){

        $id = post('id',$id,'%d');

        $addr_id = post('addr_id',$addr_id,'%d');

        $info = model('goods')->find($id);
        if(!$info)$this->errorCode(443);

        if($this->userInfo['score']<$info['score']){
            $this->errorCode(442);
        }

        if(!$info['nums']){
            $this->errorCode(434);
        }

        $this->_handle_score(-1*$info['score'],'兑换商品',0,$this->uid);

        $addr = model('address')->find($addr_id);

        if(!$addr){
            $this->errorCode(444);
        }

        $data['uid'] = $this->uid;
        $data['goods_id'] = $id;
        $data['receiver'] = $addr['name'];
        $data['phone'] = $addr['phone'];
        $data['address'] = $addr['province'].' '.$addr['city'].' '.$addr['region'].' '.$addr['address'];
        $data['mail'] = $addr['postcode'];
        $data['ctime'] = TIME_NOW;
        

        $out['id'] = model('goods_list')->data($data)->add();

        model('goods')->data([
            'nums'=>['add',-1],'sale_nums'=>['add',1]
        ])->save($id);

        $this->success($out);



    }

    function addr_list(){

        $list = model('address')->where(['uid'=>$this->uid])->order(['id'=>'DESC'])->limit(999)->select();

        $out['list'] = $list;
        $this->success($out);

    }

    function add_addr(){

        $data['name'] = post('name','');
        $data['phone']= post('phone','');
        $data['main'] = post('main','0');
        $addr = model('address')->where(['uid'=>$this->uid,'main'=>1])->find();

        if(!$addr)$data['main'] = 1;
        $data['ctime'] = TIME_NOW;

        $data['uid'] = $this->uid;
        $data['address'] = post('address','');
        $data['city'] = post('city','');
        $data['postcode'] = post('postcode','');
        $data['province'] = post('province','');
        $data['region'] = post('region','');

        $addr = model('address')->data($data)->add();

        $this->success();

    }


    function remove_addr($id=0){

        $id = post('id',$id);

        $addr = model('address')->where(['id'=>$id,'uid'=>$this->uid])->find();

        if(!$addr){
            $this->errorCode(444);
        }
        if($addr['main']){
            $this->errorCode(445);
        }

        $addr = model('address')->remove($id);
        $this->success();


    }


    function change_addr($id=0){

        $id = post('id','');

        $data['name'] = post('name','');
        $data['phone']= post('phone','');
        $data['main'] = post('main','0');
        $addr = model('address')->where(['uid'=>$this->uid,'main'=>1])->find();

        if(!$addr)$data['main'] = 1;

        if($data['main']){
            model('address')->where(['uid'=>$this->uid])->data(['main'=>0])->save();
        }
        $data['ctime'] = TIME_NOW;
        $data['address'] = post('address','');
        $data['city'] = post('city','');
        $data['postcode'] = post('postcode','');
        $data['province'] = post('province','');
        $data['region'] = post('region','');

        $addr = model('address')->data($data)->save($id);

        $this->success();


    }



    # 我的粉丝
    function my_fans(){
        model('fans')->mapping('f');
        $t['fans'] = model('fans')->add_table(array(
            'user'=>array('_on'=>'f.fans_id=u.uid','uid'=>'fuid','nametrue','_mapping'=>'u','type','nickname','label','thumb'),
            '_table'=>array('_join'=>'LEFT JOIN','_on'=>'f.fans_id=f2.uid AND f2.fans_id='."'{$this->uid}'",'_mapping'=>'f2','fans_id'=>'follow')
        ))->where(array('uid'=>$this->uid))->limit(999)->select();
        foreach($t['fans'] as &$v)$v['follow'] = $v['follow']?'1':'0';
        $this->success($t);
    }

    /** 我关注的人
     * my_follow
     * @param mixed $type 部门ID
     * @return mixed 
     */
    function my_follow($type){
        $type = post('type',$type,'%d');

        $where['fans_id'] = $this->uid;
        $type && $where['did'] = $type;
        model('fans')->mapping('f');
        $t['follow'] = model('fans')->add_table(array(
            'user'=>array('_on'=>'uid','_mapping'=>'u','uid'=>'fuid','nickname','did','nametrue','type','label','thumb'),
        ))->where($where)->limit(999)->select();
        foreach($t['follow'] as &$v)$v['follow'] = '1';
        $this->success($t);
    }
    function my_inquiry(){
        $page = post('page',1);
        $limit = post('limit',10);
        $t['list'] = model('inquiry')->mapping('i')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname','type'),
            'equipment_list@2'=>array('_mapping'=>'e2','name'=>'ename2','_on'=>'e2.id=i.bid'),
            'equipment_list@1'=>array('_mapping'=>'e1','name'=>'ename1','_on'=>'e2.bid=e1.id'),
        ))->where(array('uid'=>$this->uid))->order(array('ctime'=>'DESC'))->page($page,$limit)->select();
        foreach($t['list'] as &$v){
            $v['answer'] = model('inquiry_list')->where(array('bid'=>$v['id']))->get_field().'';
        }
        $this->success($t);
    }

    function take_reply($id=0,$thank=''){
        $id = post('id',$id,'%d');
        $r= model('inquiry_list')->find($id);
        if(!$r)$this->errorCode(439);
        $i= model('inquiry')->find($r['bid']);
        if(!$i)$this->errorCode(439);
        if($i['finish'])$this->errorCode(426);
        if($i['uid']!=$this->uid)$this->errorCode(411);
        $thank = post('thank',$thank);
        $z['r'] = $r;
        $z['i'] = $i;
        $z['il'] = model('inquiry_list')->data(array('adopt'=>1,'thank'=>$thank))->save($id);
        model('inquiry')->data(array('finish'=>TIME_NOW))->save($r['bid']);


        $this->_pusher('恭喜您！您的答案被作者采纳了，点击查看！',$r['uid'],array('type'=>array(
            "id"=>$r['bid'],
            'title'=>'',
            'key'=>1,
        )));
        $this->_handle_score(600,'回答被采纳',0,$r['uid']);
        $this->success($z);
    }

    function del_inquiry($id){
        $id = post('id',$id,'%d');
        $i= model('inquiry')->find($id);
        if(!$i)$this->errorCode(439);
        if($i['uid']!==$this->uid)$this->errorCode(411);
        model('inquiry')->remove($id);
        model('inquiry_list')->where(array('bid'=>$id))->remove();
        $this->success();
    }


    function my_reply(){
        if($this->userInfo['type']<1)$this->errorCode(420);

        $uid = $this->uid;
        $page = post('page',1);
        $limit = post('limit',10);

        $t['list'] = model('inquiry_list')->mapping('r')->add_table(array(
            'inquiry'=>array('_on'=>'r.bid=i.id','uid'=>'iuid','_mapping'=>'i','title','content'=>'icontent','img'=>'iimg'),
            'user@1'=>array('_on'=>'u.uid=r.uid','thumb','nametrue'=>'nickname','type','_mapping'=>'u'),
            'user@2'=>array('_on'=>'u2.uid=i.uid','thumb'=>'ithumb','nickname'=>'inickname','type'=>'itype','_mapping'=>'u2'),
            
        ))->where(array('uid'=>$uid))->order(array('ctime'=>'DESC'))->page($page,$limit)->select();
        foreach($t['list'] as &$v){
            $v['quest'] = $this->quest_list($v['id']);
        }

        $this->success($t);

    }

    private function quest_list($id){

        return model('inquiry_reply')->mapping('r')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname','type')
        ))->where(['reply_id'=>$id])->order('create_time')->limit(999)->select();

    }

    function feedback($content=''){
        $content = post('content',$content);
        if(!$content)$this->errorCode(416);
        $data['uid'] = $this->uid;
        $data['content'] = $content;
        $data['ctime'] = TIME_NOW;
        model('feedback')->data($data)->add();
        $this->success();
    }
    function sign(){
        $this->_check_phone();
        $u = model('sign')->find($this->uid);
        if(!$u)model('sign')->data(array('uid'=>$this->uid,'sign_time'=>TIME_NOW,'times'=>1))->add();
        else{
            if($u['sign_time']>$this->today)$this->errorCode(423);
            model('sign')->data(array('sign_time'=>TIME_NOW,'times'=>array('add',1)))->save($this->uid);
        }
        if($this->userInfo['type']==0){
            if($this->userInfo['vip']<TIME_NOW)$this->_handle_score(100,'签到');
            else $this->_handle_score(150,'签到');
        }elseif($this->userInfo['type']==1){
            $this->_handle_score(100,'签到');
        }elseif($this->userInfo['type']==2){
            $this->_handle_score(300,'签到');
            
        }
        
        $this->success();
    }



    //————————

    function my_equip(){
        $t['list'] = model('mine_equipment')->mapping('u')->add_table(array(
            'equipment_list@2'=>array('_mapping'=>'e2','name'=>'ename2','_on'=>'e2.id=u.bid'),
            'equipment_list@1'=>array('_mapping'=>'e1','name'=>'ename1','_on'=>'e2.bid=e1.id'),
        ))->where(array('uid'=>$this->uid))->order(array('ctime'=>'DESC'))->limit(999)->select();
        $this->success($t);
    }
    function my_equip_remove($id){
        $id = post('id',$id,'%d');
        model('mine_equipment')->remove($id);
        $this->success();
    }
    function my_equip_info($id=0){
        $id = post('id',$id,'%d');
        $t['info'] = model('mine_equipment')->mapping('u')->add_table(array(
            'equipment_list@2'=>array('_mapping'=>'e2','name'=>'ename2','_on'=>'e2.id=u.bid'),
            'equipment_list@1'=>array('_mapping'=>'e1','name'=>'ename1','_on'=>'e2.bid=e1.id'),
        ))->order(array('ctime'=>'DESC'))->find($id);
        if(!$t['info'])$this->error(421);
        $this->success($t);


    }
    function score(){
        $z['score'] = $this->userInfo['score'];
        $z['wx'] = $this->userInfo['wx_pay']?1:0;
        $this->success($z);

    }

    function score_log(){
        $page = post('page',1);
        $limit = post('limit',10);
        $where['uid'] = $this->uid;
        $t['list'] = model('score_log')->where($where)->page($page,$limit)->order(array('ctime'=>'DESC'))->select();
        foreach($t['list'] as &$v){
            $v['num'] = $v['score'];
        }
        $this->success($t);
    }

    function cash_bind(){
        $this->_check_phone();
        $wx_pay = post('wx_pay','');
        model('user')->data(array('wx_pay'=>$wx_pay))->save($this->uid);
        $this->success();
    }

    function cash_apply($money=0){
        $this->_check_phone();
        if(!$this->userInfo['wx_pay'])$this->errorCode(417);
        $data['money'] = $money = post('money',$money,'%d');
        if(!$money)$this->errorCode(416);
        if($this->userInfo['score']<$money*100)$this->errorCode(442);
        control('pay')->_mmpay($money*100);
        $data['uid'] = $this->uid;
        $data['ctime'] = TIME_NOW;
        model('cash_apply')->data($data)->add();
        model('user')->data(array('score'=>array('add',-1*$money*100)))->save($this->uid);
        $this->success();
    }

    function cash_log(){
        $page = post('page',1);
        $limit = post('limit',10);
        $where['uid'] = $this->uid;
        $t['list'] = model('cash_apply')->where($where)->page($page,$limit)->order(array('ctime'=>'DESC'))->select();
        foreach($t['list'] as &$v){
            $v['num'] = $v['money'];
            $v['content'] = '积分提现';
        }
        $this->success($t);
    }
    function paper_list(){
        $page = post('page',1);
        $limit = post('limit',10);
        $t['list'] = model('paper_result')->add_table(array(
            'paper'=>array('_on'=>'pid','name','img')
        ))->where(array('uid'=>$this->uid))->order(array('ctime'=>'DESC'))->page($page,$limit)->select();
        $this->success($t);
    }
    function paper_info($id=0){
        $id = post('id',$id,'%d');
        $r = model('paper_result')->find($id);
        if(!$r)$this->errorCode(422);
        $result = $r['result'];
        $pid = $r['pid'];
        $type = $r['type'];
        $data['time'] = $r['time'];
        if($type){
            $data['scoreS'] = $r['result_select'];
            $data['scoreT'] = $r['result_blank'];
            $data['scoreTotal'] = $data['result'];
            $data['rank'] = model('paper_result')->where(array('pid'=>$pid,'result'=>array('logic',$result,'>')))->get_field() + 1;
            $data['all'] = model('paper_result')->where(array('pid'=>$pid))->get_field() + 1;
            $data['percent'] = floor((1 - $data['rank']/$data['all'])*100);
        }else{
            $data['scoreTotal'] = '?';
            $data['scoreS'] = $r['result_select'];
            $data['scoreT'] = '?';
            $data['rank'] = '0';
            $data['all'] = '0';
            $data['percent'] = '0';
        }
        
        $this->success($data);
    }

    function paper_detail($id=0){
        $id = post('id',$id,'%d');
        $d = model('exam_question')->add_table([
            'paper_result_detail'=>[
                'id','uid','rid','answer','img','states'=>'is_right','_on'=>'qid'
            ]
        ])->where(['rid'=>$id])->order(['id'])->limit(99)->select($id);

        $str = 'ABCDEFGHIJKLMN';

        foreach($d as &$q){

            $q['options'] = [];
            $q['options'] = model('exam_question_option')->where(['qid'=>$q['qid']])->order('id')->limit(20)->select();
            $num = 0;
            foreach($q['options'] as &$o){
                $o['select'] = $str[$num];
                $num++;
            }
            # 如果是非填空题获取选项
            if($q['type'] == 3){
                $q['true_answer'] = $q['options'][0]['content'];
                $q['true_img'] = $q['options'][0]['img'];
                
            }
        }

        $data['list'] = $d;

        $this->success($data);

    }
    function message(){
        $page = post('page',1);
        $limit = post('limit',10);
        model('message')->where(array('uid'=>$this->uid))->data(array('read'=>1))->save();
        $t['list'] = model('message')->where(array('uid'=>$this->uid))->order(array('ctime'=>'DESC'))->page($page,$limit)->select();
        $this->success($t);
    }
    function collect_inquiry(){
        $page = post('page',1);
        $limit = post('limit',10);
        $t['list'] = model('inquiry')->mapping('i')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname','type'),
            'collect'=>array('_join'=>'JOIN','_mapping'=>'c','_on'=>'i.id=c.id AND c.type=\'w\' AND c.uid='.$this->uid,'uid'=>'collected'),
        ))->order(array('ctime'=>'DESC'))->page($page,$limit)->select();
        foreach($t['list'] as &$v){
            $v['collected'] = $v['collected']?'1':'0';
            $v['answer'] = model('inquiry_list')->where(array('bid'=>$v['id']))->get_field().'';
        }
        $this->success($t);
    }
    function collect_lession(){
        $page = post('page',1);
        $limit = post('limit',10);
        $t['list'] = model('course')->mapping('i')->add_table(array(
            'collect'=>array('_join'=>'JOIN','_mapping'=>'c','_on'=>'i.cid=c.id AND c.type=\'k\' AND c.uid='.$this->uid,'uid'=>'collected')
        ))->order(array('open_time'))->page($page,$limit)->select();
        foreach($t['list'] as &$v){
            $v['collected'] = $v['collected']?'1':'0';
            $v['now'] = TIME_NOW;
        }
        $this->success($t);
        

    }
    function collect_repository(){

        $limit = post('limit',20,'%d');
        $page = post('page',1,'%d');

        $t['list'] = model('repository')->mapping('r')->add_table(array(
            'repository_list'=>array(
                'name','del','_on'=>'r.bid=i.rid','_mapping'=>'i'
            ),
            'collect'=>array('_join'=>'JOIN','_mapping'=>'c','_on'=>'r.rid=c.id AND c.type=\'z\' AND c.uid='.$this->uid,'uid'=>'collected')
        ))->page($page,$limit)->select();
        foreach($t['list'] as &$v){
            $v['collected'] = $v['collected']?'1':'0';
            $v['url'] = 'app/h5/repository/'.$v['rid'];
        }
        $this->success($t);


    }
    function share(){
        $this->_check_phone();
        
        if($this->userInfo['type']==0){
            if($this->userInfo['vip']<TIME_NOW)$c = $this->_handle_score(100,'分享',-1);
            else $c = $this->_handle_score(150,'分享',-1);
        }elseif($this->userInfo['type']==1){
            $c = $this->_handle_score(150,'分享',-1);
            
        }elseif($this->userInfo['type']==2){
            $c = $this->_handle_score(450,'分享',-1);
            
        }
        

        if(!$c)$this->errorCode(428);

        $this->success();
    }
    function vip_info(){

        $data['nickname'] = $this->userInfo['nickname'];
        $data['thumb'] = $this->userInfo['thumb'];
        $data['vip'] = $this->userInfo['vip']>TIME_NOW?'1':'0';
        $data['date'] = $this->userInfo['vip'];
        $data['vip_type'] = $data['vip']?$this->userInfo['vip_type']:'0';
        $data['list'] =model('member')->limit(99)->select();
        $this->success($data);
    }
    function pay($time=3){
        $this->_check_phone();
        $type = post('type',0);
        $id = $time = post('time',3); 
        $score = model('member')->find($time,false)->get_field('postage');
        if(!$score)$this->errorCode(416);

        if($type==0){
            
            $score *= 100;
            if($this->userInfo['score']<$score)$this->errorCode(442);

            if($time == 1)$add = 3600*24*30;
            elseif($time == 2)$add = 3600*24*91;
            else $add = 3600*24*365;
            $data['vip_type'] = $time;
            if($this->userInfo['vip']>TIME_NOW)$data['vip'] = $this->userInfo['vip'] + $add;
            else $data['vip'] = TIME_NOW + $add;

            model('user')->data($data)->save($this->uid);
            $this->_handle_score(-1*$score,'支付VIP');

            $f['vip'] = $data['vip'];
            $this->success($f);
        }elseif($type==2){

            if($time == 1)$add = 3600*24*30;
            elseif($time == 2)$add = 3600*24*91;
            else $add = 3600*24*365;

            if($this->userInfo['vip']>TIME_NOW)$data['vip'] = $this->userInfo['vip'] + $add;
            else $data['vip'] = TIME_NOW + $add;

            $data2 = control('pay')->__wcpay('vip',$score*100,$id,true);

            $data = array_merge($data,$data2);

            $this->success($data);
        }elseif($type==1){

            if($time == 1)$add = 3600*24*30;
            elseif($time == 2)$add = 3600*24*91;
            else $add = 3600*24*365;

            if($this->userInfo['vip']>TIME_NOW)$data['vip'] = $this->userInfo['vip'] + $add;
            else $data['vip'] = TIME_NOW + $add;

            $data2 = control('pay')->__alipay('vip',$score,$id,true);

            $data = array_merge($data,$data2);

            $this->success($data);

        }else{

            $this->errorCode(430);
        }

    }




    function ios_pay($sandbox = 0){

        $sandbox = post('sandbox',$sandbox);
        $receiptData = post('receiptData','');
        $url = $sandbox ? "https://sandbox.itunes.apple.com/verifyReceipt" : "https://buy.itunes.apple.com/verifyReceipt";
        $jsonData = ['receipt-data'=>($receiptData)];
        $data_string = json_encode($jsonData);
        $curl_handle=curl_init();
        curl_setopt($curl_handle,CURLOPT_URL, $url);
        curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle,CURLOPT_HEADER, 0);
        curl_setopt($curl_handle,CURLOPT_POST, true);
        curl_setopt($curl_handle,CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl_handle,CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl_handle,CURLOPT_SSL_VERIFYPEER, 0);
        $response_json =curl_exec($curl_handle);
        $response = json_decode($response_json);
        curl_close($curl_handle);
        if(!$sandbox && $response_json && $response->status == 21007){
            $url =  "https://sandbox.itunes.apple.com/verifyReceipt";
            $curl_handle=curl_init();
            curl_setopt($curl_handle,CURLOPT_URL, $url);
            curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl_handle,CURLOPT_HEADER, 0);
            curl_setopt($curl_handle,CURLOPT_POST, true);
            curl_setopt($curl_handle,CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($curl_handle,CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl_handle,CURLOPT_SSL_VERIFYPEER, 0);
            $response_json =curl_exec($curl_handle);
            $response = json_decode($response_json);
            curl_close($curl_handle);
        }
        
        if($response_json && $response->status == 0){
            if($response->receipt->bundle_id != "com.hanyu.OperationGuards")$this->error('400','信息验证错误');

            $product_id = $response->receipt->in_app[0]->product_id;

            $gd['prepay_id'] = $response->receipt->in_app[0]->transaction_id;

            if(model('pay_log')->where($gd)->find()){
                $this->error('400','付款失败！');
            }
            
            switch($product_id){
                case 'ywwssh201701':
                    $type = post('type','');
                    $id = post('id','0');
                    $score = $total_fee = '100';
                    if($type =='inquiry')
                        model('inquiry_paid')->data(array(
                            'uid'=>$this->uid,
                            'ctime'=>TIME_NOW,
                            'id'=>$id
                        ))->add(true);
                    elseif($type=='expert')
                        model('expert_paid')->data(array(
                            'uid'=>$this->uid,
                            'ctime'=>TIME_NOW,
                            'id'=>$id
                        ))->add(true);
                    elseif($type=='paper')
                        model('paper_paid')->data(array(
                            'uid'=>$this->uid,
                            'ctime'=>TIME_NOW,
                            'pid'=>$id
                        ))->add(true);
                    
                    break;
                case 'ywwsvip43200':
                    $type = 'vip';
                    $total_fee = model('member')->find(1);
                    $score = $total_fee = $total_fee['postage']*100;
                    $add = 3600*24*30;
                    $data['vip_type'] = 1;
                    if($this->userInfo['vip']>TIME_NOW)$data['vip'] = $add + $this->userInfo['vip'];
                    else $data['vip'] = TIME_NOW + $add;
                    model('user')->data($data)->save($this->uid);
                    break;
                case 'ywwsvip129600':
                    $type = 'vip';
                    $total_fee = model('member')->find(2);
                    $score = $total_fee = $total_fee['postage']*100;
                    $add = 3600*24*90;
                    $data['vip_type'] = 2;
                    if($this->userInfo['vip']>TIME_NOW)$data['vip'] = $add + $this->userInfo['vip'];
                    else $data['vip'] = TIME_NOW + $add;
                    model('user')->data($data)->save($this->uid);
                    break;
                case 'ywwsvip518400':
                    $type = 'vip';
                    $total_fee = model('member')->find(3);
                    $score = $total_fee = $total_fee['postage']*100;
                    $add = 3600*24*365;
                    $data['vip_type'] = 3;
                    if($this->userInfo['vip']>TIME_NOW)$data['vip'] = $add + $this->userInfo['vip'];
                    else $data['vip'] = TIME_NOW + $add;
                    model('user')->data($data)->save($this->uid);
                    break;
                default:
                    $this->error('400','错误:'.$response->status);
                    break;
            }

            

            $gd['gid'] = $id?$id:0;
            $gd['uid'] = $this->uid;
            $gd['ctime'] = TIME_NOW;
            $gd['type'] = $type;
            $gd['total_fee'] = $total_fee;
            $gd['prepay_success'] = '1';
            $gd['success'] = '0';
            $gd['pay_type'] = 'ios';
            
            model('pay_log')->data($gd)->add();

            $this->_handle_score($score,'恭喜您！支付成功，并获得了'.$score.'积分！',0,$this->uid);
            $this->_pusher('恭喜您！支付成功，并获得了'.$score.'积分！',$this->uid,array('type'=>array(
                "id"=>'0',
                'title'=>'',
                'key'=>3,
            )));

            $this->success(['total_fee'=>$total_fee]);

        }else{

            $this->error('400','错误:'.$response->status);
        
        }

           



    }


    # 获取部门列表
    function getDepartment(){
        $data['list'] = model('department')->limit(99)->select();
        $data['list'] = array_merge([['id'=>'0','name'=>'全部']],$data['list']);
        $this->success($data);
    }
    
    /** 获取好友
     * getFriends
     * @param mixed $type 部门ID
     * @return mixed 
     */
    function getFriends($type){

        $this->my_follow($type);

    }

    /** 搜索好友 */
    function searchFriends($search){

        $search = post('search',$search);
        
        if($search){
            $where['usercode'] = $search;
            $where['nickname'] = $search;
            $where['e_wx'] = $search;
        }else{
            $this->error('没有搜索内容！');
        }
        $t['follow'] = model('user')->mapping('uid','fuid')->field(['bid','gid','fuid','nickname','did','nametrue','type','label','thumb'])->limit(30)->where($where,0,'OR')->select();
        foreach($t['follow'] as &$v)$v['follow'] = '1';
        $this->success($t);

    }


    function searchFriends_0($search){

        $search = post('search',$search);
        $where['bid'] = 0;
        if($search){
            $where['usercode'] = $search;
            $where['nickname'] = $search;
        }else{
            $this->error('没有搜索内容！');
        }
        $t['follow'] = model('user')->mapping('uid','fuid')->field(['bid','gid','fuid','nickname','did','nametrue','type','label','thumb'])->limit(999)->where($where,0,'OR')->select();
        foreach($t['follow'] as &$v)$v['follow'] = '1';
        $this->success($t);

    }



    public function getFirstChar($s){  
       return Hanzi\Hanzi::pinyin($s)['pinyin'];
    }

    public function orderByName($userName){  
        // $userName = array('张三','李四','王五','小二','猫蛋','狗蛋','王花','三毛','小明','Mary','李刚','张飞','Lucy');  
        sort($userName);
        $charArray = [];
        foreach($userName as $name){  
            $char = substr( $this->getFirstChar($name['nickname']),0,1);
            // var_dump($char);
            $nameArray = array();
            if(count($charArray[$char])!=0){  
                $nameArray = $charArray[$char];  
            }  
            array_push($nameArray,$name);   
            $charArray[$char] = $nameArray;  
        }  
        
        return $charArray;  
    }


    function my_follow_sort($type){
        $type = post('type',$type,'%d');
        $where['fans_id'] = $this->uid;
        $type && $where['did'] = $type;
        model('fans')->mapping('f');
        $t['follow'] = model('fans')->add_table(array(
            'user'=>array('_on'=>'uid','_mapping'=>'u','uid'=>'fuid','nickname','did','nametrue','type','label','thumb'),
        ))->where($where)->limit(999)->select();
        foreach($t['follow'] as &$v)$v['follow'] = '1';

        $t['follow'] = $this->orderByName($t['follow']);
        if(!$t['follow'])$t['follow'] = new \stdClass;
        $this->success($t);
    }
}
?>