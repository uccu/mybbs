<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class lession extends base\e{//运维
    function _beginning(){
        //$this->_check_login();
    }
    function lists($type = 0,$lid = 0){


        # 获取请求参数
        $type = post('type',$type,'%d');
        $lid = post('lid',$lid,'%d');

        if($lid)$course = model('course')->where(['lid'=>$lid]);
        else $course = model('course');

        if($type==1)
            $t = $course->where(array('open_time'=>array('logic',TIME_NOW,'>')))->order(array('open_time'))->limit(999)->select();
        elseif($type==2)
            $t = $course->where(array('open_time'=>array('logic',TIME_NOW,'<'),'etime'=>array('logic',TIME_NOW,'>')))->order(array('open_time'=>'DESC'))->limit(999)->select();
        elseif($type==3)
            $t = $course->where(array('etime'=>array('logic',TIME_NOW,'<')))->limit(999)->order(array('open_time'=>'DESC'))->select();
        else $t = $course->limit(999)->select();

        foreach($t as &$v)$v['now'] = TIME_NOW;

        $data['list'] = $t;

        $this->success($data);

    }
    function info($id=0){
        $id = post('id',$id,'%d');
        $t = model('course')->find($id);
        if(!$t)$this->errorCode(418);
        // if($t['open_time']<TIME_NOW && $t['etime']>TIME_NOW){
            //if($t['look_nums']<=$t['nums'])$this->errorCode(419);
            model('course')->data(array('nums'=>array('add',1),'watch'=>array('add',1)))->save($id);
            $t['nums']++;
        // }
        
        //     
        // }
        $t['now'] = TIME_NOW;
        $data['info'] = $t;
        $data['collect'] = model('collect')->where(array('type'=>'k','uid'=>$this->uid,'id'=>$t['cid']))->find() ? '1' :'0';
        $this->success($data);
    }
    function leave($id=0){
        $id = post('id',$id,'%d');
        $t = model('course')->find($id);
        if(!$t)$this->errorCode(418);
        if(!$t['nums'])$this->success();
        if($t['open_time']<TIME_NOW && $t['etime']>TIME_NOW)
            model('course')->data(array('nums'=>array('add',-1)))->save($id);
        $this->success();
    }
    function collect($id=0){
        $this->_check_login();
        $this->_check_phone();
        $id = post('id',$id,'%d');
        $data['uid'] = $this->uid;
        $data['type'] = 'k';


        $i = model('course')->find($id);
        if(!$i)$this->errorCode(418);

        $data['id'] = $id;
        $f = model('collect')->where($data)->find();
        if($f){
            model('collect')->where($data)->remove();
            $z['collected'] = '0';
        }else{
            model('collect')->data($data)->add();
            $z['collected'] = '1';
        }
        $this->success($z);
    }
    function test(){
        $z['list_r'] = model('paper')->mapping('p')->add_table(array(
            'paper_paid'=>array('_join'=>'LEFT JOIN','_mapping'=>'i','_on'=>'i.pid=p.pid AND i.uid='.$this->uid,'ctime'=>'paid')
        ))->where(array('states'=>1))->limit(1)->order(array('location'))->select();
        $z['list_y'] = model('paper')->mapping('p')->add_table(array(
            'paper_paid'=>array('_join'=>'LEFT JOIN','_mapping'=>'i','_on'=>'i.pid=p.pid AND i.uid='.$this->uid,'ctime'=>'paid')
        ))->where(array('states'=>2))->limit(2)->order(array('location'))->select();
        $z['list_p'] = model('paper')->mapping('p')->add_table(array(
            'paper_paid'=>array('_join'=>'LEFT JOIN','_mapping'=>'i','_on'=>'i.pid=p.pid AND i.uid='.$this->uid,'ctime'=>'paid')
        ))->where(array('states'=>3))->limit(2)->order(array('location'))->select();
        foreach($z['list_r'] as &$v){
            $v['paid'] = $v['paid']?'1':'0';
        }
        foreach($z['list_y'] as &$v){
            $v['paid'] = $v['paid']?'1':'0';
        }
        foreach($z['list_p'] as &$v){
            $v['paid'] = $v['paid']?'1':'0';
        }
        $this->success($z);
    }
    function test_list($states=0,$bid = 0){
        $states = post('states',$states,'%d');
        $bid = post('bid',$bid,'%d');
        $z['list'] = model('paper')->mapping('p')->add_table(array(
            'paper_paid'=>array('_join'=>'LEFT JOIN','_mapping'=>'i','_on'=>'i.pid=p.pid AND i.uid='.$this->uid,'ctime'=>'paid')
        ))->where(array('states'=>$states,'bid'=>$bid))->order(array('location'))->limit(9999)->select();
        foreach($z['list'] as &$v){
            $v['paid'] = $v['paid']?'1':'0';
        }
        
        $this->success($z);
    }
    function test_type($states=0){
        $states = post('states',$states,'%d');

        $z['list'] = model('paper_list')->where(array('bid'=>$states,'del'=>1))->limit(9999)->select();
    
        $this->success($z);
    }
    function paper($id=0){
        $this->_check_login();
        $this->_check_phone();
        $id = post('id',$id,'%d');
        $paper = model('paper')->find($id);
        if($paper['states']==3){
            $p = model('paper_paid')->where(array(
                'uid'=>$this->uid,
                'pid'=>$id
            ))->find();
        }
        $t['list'] = model('question')->where(array('bid'=>$paper['lid1']?$paper['lid1']:$paper['lid']))->order('rand()')->limit(20)->select();
        $this->success($t);

    }
    function submit($pid,$result=0,$time=''){
        $this->_check_login();
        $this->_check_phone();
        $result = post('result',$result,'%d');
        $time = post('time',$time);
        $pid = post('pid',$pid,'%d');
        $qids = post('qids');
        $qids = explode(',',$qids);
        $answers = post('answers');
        $answers = explode(',',$answers);
        $data['rank'] = model('paper_result')->where(array('pid'=>$pid,'result'=>array('logic',$result,'>')))->get_field() + 1;
        $data['all'] = model('paper_result')->where(array('pid'=>$pid))->get_field() + 1;
        $data['percent'] = floor((1 - $data['rank']/$data['all'])*100);
        $data['id'] = $id = model('paper_result')->data(array('pid'=>$pid,'result'=>$result,'uid'=>$this->uid,'ctime'=>TIME_NOW,'time'=>$time))->add();


        $data2['rid'] = $id;
        $data2['uid'] = $this->uid;
        foreach($qids as $k=>$qid){

            $data2['qid'] = $qid;
            $data2['answer'] = $answers[$k];

            model('paper_result_detail')->data($data2)->add();

        }

        $this->success($data);
    }


    function pay($id=0){
        $this->_check_login();
        $this->_check_phone();
        $id = post('id',$id,'%d');
        $type = post('type',0);
        $p = model('paper_paid')->where(array(
            'uid'=>$this->uid,
            'pid'=>$id
        ))->find();
        if($p)$this->errorCode(431);
        if($type==0){
            if($this->userInfo['score']<100)$this->errorCode(442);
            $this->_handle_score(-100,'支付考卷');
            model('paper_paid')->data(array(
                'uid'=>$this->uid,
                'ctime'=>TIME_NOW,
                'pid'=>$id
            ))->add();
            $this->success();
        }elseif($type==2){
            control('pay')->__wcpay('paper',100,$id);
        }elseif($type==1){
            control('pay')->__alipay('paper',1,$id);
        }else{

            $this->errorCode(430);
        }

    }





    # 二期

    # 题目列表
    function exam_question_list($id=0){

        # 验证登录
        $this->_check_login();

        # 验证手机号是否完善
        $this->_check_phone();

        # 获取考卷
        $id = post('id',$id,'%d');

        $paper = model('paper')->find($id);

        !$paper && $this->error('考卷不存在！');
        $data['paper'] = $paper;

        # 如果是付费考卷，则判断是否付费
        // if($paper['states']==3){
        //     $p = model('paper_paid')->where(
        //         [
        //             'uid'=>$this->uid,
        //             'pid'=>$id
        //         ]
        //     )->find();
        // }

        # 获取分类ID
        $bid = $paper['lid1']?$paper['lid1']:$paper['lid'];
        !$bid && $this->error('题库不存在！');


        # 随机获取列表中的20个
        $list = model('exam_question')->where(['bid'=>$bid])->order('rand()')->limit(20)->select();

        $str = 'ABCDEFGHIJKLMN';

        foreach($list as &$q){

            $q['options'] = [];

            # 如果是非填空题获取选项
            if($q['type'] != 3){
                $q['options'] = model('exam_question_option')->where(['qid'=>$q['qid']])->order('rand()')->limit(20)->select();
                $num = 0;
                foreach($q['options'] as &$o){
                    $o['select'] = $str[$num];
                    $num++;
                }
            }
        }

        $data['list'] = $list;

        $this->success($data);

    }

    # 视频分类
    function video_category(){

        $list = model('course_list')->order('id')->limit(99)->select();

        # 数量统计
        foreach($list as &$v){

            $v['count'] = model('course')->where(['lid'=>$v['id']])->get_field();
            $v['precount'] = model('course')->where(['lid'=>$v['id'],'open_time'=>['logic',TIME_NOW,'>']])->order('open_time')->get_field();

        }

        $data['list'] = $list;
        $this->success($data);

    }


    function submit_v2($pid,$result=0,$time='',$data = ''){
        // $this->_check_login();
        // $this->_check_phone();
        $result = post('result',$result,'%d');
        $pid = post('pid',$pid,'%d');
        $time = post('time',$time);
        $data3 = $_REQUEST['data']?$_REQUEST['data']:$data;

        $data = [];
        
        // $data['rank'] = model('paper_result')->where(array('pid'=>$pid,'result'=>array('logic',$result,'>')))->get_field() + 1;
        // $data['all'] = model('paper_result')->where(array('pid'=>$pid))->get_field() + 1;
        // $data['percent'] = floor((1 - $data['rank']/$data['all'])*100);
        $data['id'] = $id = model('paper_result')->data(array('pid'=>$pid,'result'=>$result,'uid'=>$this->uid,'ctime'=>TIME_NOW,'time'=>$time))->add();
        
        $data['rank'] = '0';
        $data['all'] = '0';
        $data['percent'] = '0';

        $data['time'] = $time;
        $data['scoreTotal'] = '?';
        $data['scoreS'] = $result;
        $data['scoreT'] = '?';


        $json = json_decode($data3);


        !$json && $this->error('错误！');

        $data2['rid'] = $id;
        $data2['uid'] = $this->uid;
        foreach($json as $q){

            $data2['qid'] = $q->qid;
            $data2['answer'] = $q->answer;
            $data2['img'] = $q->img;
            $data2['states'] = $q->states;
            $data2['edit_time'] = TIME_NOW;

            model('paper_result_detail')->data($data2)->add();

        }

        $this->success($data);
    }


}
?>