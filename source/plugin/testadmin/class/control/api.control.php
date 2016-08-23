<?php
namespace plugin\testadmin\control;
defined('IN_PLAY') || exit('Access Denied');
class api extends \control\ajax{
    function del_anli($aid){
        model('anli')->remove($aid);
        model('anli_pc')->remove($aid);
        model('anli_wx')->remove($aid);
        model('anli_app')->remove($aid);
        model('anli_pic')->where(array('aid'=>$aid))->remove();
        $this->success();
    }
    function set_anli($aid){
        if($aid){
            $z = model('anli')->find($aid);
            $_POST['ctime'] = time();
            if(!$z)$this->error(400,'案例不存在');
            else $z = model('anli')->data($_POST)->save($aid);
            if($z)$this->success();
            else $this->error(400,'修改失败');
        }
        //var_dump($_POST);
        $_POST['ctime'] = time();
        $z = model('anli')->data($_POST)->add();
        if($z)$this->success(array('aid'=>$z));
        else $this->error(400,'创建失败');
    }
    function get_anli($aid){
        $z = model('anli')->find($aid);
        $this->success($z);
    }

    function get_anli_pc($aid){
        $z = model('anli_pc')->find($aid);
        $this->success($z);
    }
    function get_anli_app($aid){
        $z = model('anli_app')->find($aid);
        $this->success($z);
    }
    function get_anli_wx($aid){
        $z = model('anli_wx')->find($aid);
        $this->success($z);
    }
    function del_anli_pc($aid){
        $z = model('anli_pc')->remove($aid);
        $this->success($z);
    }
    function del_anli_app($aid){
        $z = model('anli_app')->remove($aid);
        $this->success($z);
    }
    function del_anli_wx($aid){
        $z = model('anli_wx')->remove($aid);
        $this->success($z);
    }
    function set_anli_pc(){
        if(!$aid = post('aid',0,'%d'))$this->error(400,'未知案例');
        if(!$anli = model('anli')->find($aid))$this->error(400,'未找到案例');
        if(model('anli_pc')->find($aid)){
            $z = model('anli_pc')->data($_POST)->where(array('aid'=>$aid))->save();
        }else $z = model('anli_pc')->data($_POST)->add(true);
        if($z)$this->success();
        else $this->error(400,'创建失败');
    }
    function set_anli_app(){
        if(!$aid = post('aid',0,'%d'))$this->error(400,'未知案例');
        if(!$anli = model('anli')->find($aid))$this->error(400,'未找到案例');
        if(model('anli_app')->find($aid)){
            $z = model('anli_app')->data($_POST)->where(array('aid'=>$aid))->save();
        }else $z = model('anli_app')->data($_POST)->add(true);
        if($z)$this->success();
        else $this->error(400,'创建失败');
    }
    function set_anli_wx(){
        if(!$aid = post('aid',0,'%d'))$this->error(400,'未知案例');
        if(!$anli = model('anli')->find($aid))$this->error(400,'未找到案例');
        if(model('anli_wx')->find($aid)){
            $z = model('anli_wx')->data($_POST)->where(array('aid'=>$aid))->save();
        }else $z = model('anli_wx')->data($_POST)->add(true);
        if($z)$this->success();
        else $this->error(400,'创建失败');
    }
    function get_pic($aid){
        $z = model('anli_pic')->find($aid);
        if($z)$z['path'] .= '.small.jpg';
        $this->success($z);
    }
    function set_pic($pid){
        if($_POST['path']){
            $_POST['path'] = str_replace('.small.jpg','',$_POST['path']);
        }
        if($pid){
            $z = model('anli_pic')->find($pid);
            if(!$z)$this->error(400,'图片不存在');
            else $z = model('anli_pic')->data($_POST)->save($pid);
            if($z)$this->success();
            else $this->error(400,'修改失败');
        }
        $z = model('anli_pic')->data($_POST)->add();
        if($z)$this->success(array('pid'=>$z));
        else $this->error(400,'创建失败');
    }
    function del_pic($pid){
        model('anli_pic')->where()->remove($pid);
        $this->success();
    }
    function up_pic(){
        $z = control('tool:upload','picture')->_get_srcs();
        $this->success($z);
    }


    function set_navc(){
        $z = model('subnav')->data($_POST)->add(true);
        $this->success($z);
    }
    function get_navc($tid){
        $z = model('subnav')->find($tid);
        $this->success($z);
    }
    function del_navc($tid){
        if(!$tid)$this->error(400,'参数错误');
        $z = model('subnav')->where(array('sid'=>$tid))->remove();
        $z = model('subnav')->remove($tid);
        $this->success($z);
    }
}