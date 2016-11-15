<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class home extends base\e{
    private $outter = true;
    function _beginning(){
        //$this->_check_login();
    }
    function banner(){
        $z = model('banner')->limit(99)->order(array('bid'))->select();
        foreach($z as &$v){
            $v['url'] = 'app/h5/banner/'.$v['bid'];
        }
        if($this->outter)$this->success($z);
        return $z;
    }
    function top_line(){
        $z = model('top_line')->limit(99)->order(array('tid'))->select();
        foreach($z as &$v){
            $v['url'] = 'app/h5/top/'.$v['tid'];
        }
        if($this->outter)$this->success($z);
        return $z;
    }
    function inquiry(){
        $z['unfinish'] = model('inquiry')->where(array('finish'=>0))->get_field();
        $z['finish'] = model('inquiry')->where(array('finish'=>array('logic',0,'!=')))->get_field();
        if($this->outter)$this->success($z);
        return $z;
    }
    
    function expert(){
        $where['type'] = 2;
        $where['recommend'] = 1;
        $z = model('user')->field(array('uid','nickname','thumb','nametrue','label'))->where($where)->order(array('top'=>'DESC','uid'))->limit(999)->select();
        if($this->outter)$this->success($z);
        return $z;
    }

    function repository(){
        $this->uid;
        $z = model('repository')->mapping('r')->add_table(array(
            'repository_list'=>array(
                'name','del','_on'=>'r.bid=i.rid','_mapping'=>'i'
            ),
            'collect'=>array('_join'=>'LEFT JOIN','_mapping'=>'c','_on'=>'r.rid=c.id AND c.type=\'z\' AND c.uid='.$this->uid,'uid'=>'collected')
        ));
        if($bid = $this->userInfo['plant']){
            $where['bid'] = $bid;
            $z = model('repository')->where($where)->limit(15)->order('rand()')->select();
        }else{
            $z = model('repository')->limit(15)->order('rand()')->select();
        }
        foreach($z as &$v){
            $v['collected'] = $v['collected']?'1':'0';
            $v['url'] = 'app/h5/repository/'.$v['rid'];
        }
        if($this->outter)$this->success($z);
        return $z;
    }


    function repository_list($bid){
        $where['bid'] = post('bid',$bid,'%d');
        if(!$where['bid'])$where['bid'] = model('repository')->where(array('del'=>1))->order(array('rid'))->get_field('rid');
        $limit = post('limit',20,'%d');
        $page = post('page',1,'%d');
        $z['count'] = model('repository')->where($where)->get_field();
        $z['list'] = model('repository')->mapping('r')->add_table(array(
            'repository_list'=>array(
                'name','del','_on'=>'r.bid=i.rid','_mapping'=>'i'
            ),
            'collect'=>array('_join'=>'LEFT JOIN','_mapping'=>'c','_on'=>'r.rid=c.id AND c.type=\'z\' AND c.uid='.$this->uid,'uid'=>'collected')
        ))->where($where)->order(array('location'))->page($page,$limit)->select();
        foreach($z['list'] as &$v){
            $v['collected'] = $v['collected']?'1':'0';
            $v['url'] = 'app/h5/repository/'.$v['rid'];
        }
        //if(!$z['list'])$this->errorCode(427);
        $this->success($z);
    }
    function repository_search($search){
        $search = post('search',$search,'');
        if($search)$where['title'] = array('contain','%'.$search.'%','LIKE');
        else $where = '1=2';
        $limit = post('limit',20,'%d');
        $page = post('page',1,'%d');
        $z['count'] = model('repository')->where($where)->get_field();
        $z['list'] = model('repository')->mapping('r')->add_table(array(
            'repository_list'=>array(
                'name','del','_on'=>'r.bid=i.rid','_mapping'=>'i'
            ),
            'collect'=>array('_join'=>'LEFT JOIN','_mapping'=>'c','_on'=>'r.rid=c.id AND c.type=\'z\' AND c.uid='.$this->uid,'uid'=>'collected')
        ))->where($where)->order(array('location'))->page($page,$limit)->select();
        foreach($z['list'] as &$v){
            $v['collected'] = $v['collected']?'1':'0';
            $v['url'] = 'app/h5/repository/'.$v['rid'];
        }
        //if(!$z['list'])$this->errorCode(427);
        $this->success($z);
    }
    function repository_type(){
         $z['list'] = model('repository_list')->where(array('del'=>1))->limit(99)->order(array('rid'))->select();
         $this->success($z);
    }
    

    function all(){
        $this->outter = false;
        $data['banner'] = $this->banner();
        $data['top_line'] = $this->top_line();
        $data['expert'] = $this->expert();
        $data['repository'] = $this->repository();
        $data['inquiry'] = $this->inquiry();
        $data['message'] = 0;
        $this->success($data);
    }

    function fast(){
        $this->_check_login();
        $_POST['uid'] = $this->uid;
        $z = model('fast_call')->data($_POST)->add();
        if(!$z)$this->errorCode(415);
        $this->success();
    }


    function collect($id=0){
        $this->_check_login();
        $id = post('id',$id,'%d');
        $data['uid'] = $this->uid;
        $data['type'] = 'z';


        $i = model('repository')->find($id);
        if(!$i)$this->errorCode(424);

        $data['id'] = $id;
        $f = model('collect')->where($data)->find();
        if($f){
            model('collect')->where($data)->remove();
            $z['collected'] = '0';
            model('repository')->data(array('collection'=>array('add',-1)))->save($id);
        }else{
            model('collect')->data($data)->add();
            $z['collected'] = '1';
            model('repository')->data(array('collection'=>array('add',1)))->save($id);
        }
        $this->success($z);
    }



}
?>