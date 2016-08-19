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
        }else $z = model('anli_pc')->data($_POST)->add();
        if($z)$this->success();
        else $this->error(400,'创建失败');
    }
    function set_anli_app(){
        if(!$aid = post('aid',0,'%d'))$this->error(400,'未知案例');
        if(!$anli = model('anli')->find($aid))$this->error(400,'未找到案例');
        if(model('anli_app')->find($aid)){
            $z = model('anli_app')->data($_POST)->where(array('aid'=>$aid))->save();
        }else $z = model('anli_app')->data($_POST)->add();
        if($z)$this->success();
        else $this->error(400,'创建失败');
    }
    function set_anli_wx(){
        if(!$aid = post('aid',0,'%d'))$this->error(400,'未知案例');
        if(!$anli = model('anli')->find($aid))$this->error(400,'未找到案例');
        if(model('anli_wx')->find($aid)){
            $z = model('anli_wx')->data($_POST)->where(array('aid'=>$aid))->save();
        }else $z = model('anli_wx')->data($_POST)->add();
        if($z)$this->success();
        else $this->error(400,'创建失败');
    }
    function set_pic($pid){
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
}