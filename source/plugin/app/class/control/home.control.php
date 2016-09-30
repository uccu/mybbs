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
        if($this->outter)$this->success($z);
        return $z;
    }
    function top_line(){
        $z = model('top_line')->limit(99)->order(array('tid'))->select();
        if($this->outter)$this->success($z);
        return $z;
    }
    // function inquiry_list(){
    //     $z = model('inquiry')->limit(4)->order(array('ctime'=>'DESC'))->select();
    //     if($this->outter)$this->success($z);
    //     return $z;
    // }
    
    function expert(){
        $where['type'] = 2;
        $where['recommend'] = 1;
        $z = model('user')->field(array('uid','nickname','thumb','label'))->where($where)->order(array('top'=>'DESC','uid'))->limit(999)->select();
        if($this->outter)$this->success($z);
        return $z;
    }

    function repository(){
        $this->uid;
        $z = model('repository')->mapping('r')->add_table(array(
            'repository_list'=>array(
                'name','del','_on'=>'r.bid=i.rid','_mapping'=>'i'
            )
        ));
        if($bid = $this->userInfo['plant']){
            $where['bid'] = $bid;
            $z = model('repository')->where($where)->limit(15)->order('rand()')->select();
        }else{
            $z = model('repository')->limit(15)->order('rand()')->select();
        }
        if($this->outter)$this->success($z);
        return $z;
    }

    function all(){
        $this->outter = false;
        $data['banner'] = $this->banner();
        $data['top_line'] = $this->top_line();
        $data['expert'] = $this->expert();
        $data['repository'] = $this->repository();
        $data['message'] = 0;
        $this->success($data);
    }

    



}
?>