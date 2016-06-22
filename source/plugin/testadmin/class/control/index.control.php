<?php
namespace plugin\testadmin\control;
defined('IN_PLAY') || exit('Access Denied');
class index extends na\ba{
    function _get_subnav(){
        return array(
            //'logo'=>'LOGO',
            'login'=>'登录页面背景',
            'banner'=>'banner设置',
            'stars'=>'推荐明星设置'
        );
    }

    protected function _beginning(){
        
    }
    function _get_defaultMethod(){
        return 'banner';
    }
    function login(){
        $this->_init();
        $this->g->template['list'] = model('login_background')->limit(20)->order(array('bid'))->select();
        T(CONTROL_NAME.'/'.__FUNCTION__);

    }
    function login_detail($id){
        if(is_null($id))$this->_header('login');
        if(!$id){
            $co = model('login_background')->get_field();
            if($co>19)$this->_header('login');
        }
        $this->subnav = array_merge($this->subnav,array('login_detail'=>'设置图片'));
        $this->_init();
        $info = model('login_background')->find($id);
        $this->g->template['id'] = $info ? $info['bid'] : 0;
        T(CONTROL_NAME.'/'.__FUNCTION__);
    }
    function del_login($id){
        $p = model('login_background')->remove($id);
        $this->success($p);
    }
    function get_login_detail($id){
        $info = model('login_background')->find($id);
        if(!$info)$this->error(400,'no data');
        if($info['pic'])$info['pic'] .= '.small.jpg';
        $this->success($info);
    }
    function save_login_detail($id){
        $_POST['ctime'] = TIME_NOW;
        $_POST['pic'] = str_ireplace(array('.small','.large','.jpg'),'',$_POST['pic']);
        if(!$id)$p = model('login_background')->data($_POST)->add();
        else $p = model('login_background')->data($_POST)->save($id);
        $this->success($p);
    }
    function banner(){
        $this->_init();
        $this->g->template['list'] = model('banner')->limit(9)->order(array('bid'))->select();
        T(CONTROL_NAME.'/'.__FUNCTION__);
    }
    function stars(){
        $this->_init();
        $table = array(
            'user_info'=>array('_on'=>'uid','nickname')
        );
        $this->g->template['list'] = model('recommend_stars')->add_table($table)->limit(4)->select();
        T(CONTROL_NAME.'/'.__FUNCTION__);
    }
    function stars_detail($id){
        $this->subnav = array_merge($this->subnav,array('stars_detail'=>'封面设置'));
        $this->_init();
        $info = model('recommend_stars')->find($id);
        if(!$info)$this->error(400,'no data');
        $this->g->template['id'] = $info['sid'];
        T(CONTROL_NAME.'/'.__FUNCTION__);
    }
    function get_stars_detail($id){
        $info = model('recommend_stars')->find($id);
        if(!$info)$this->error(400,'no data');
        if($info['pic'])$info['pic'] .= '.jpg';
        $this->success($info);
    }
    function save_stars_detail($id){
        $_POST['pic'] = str_ireplace(array('.small','.large','.jpg'),'',$_POST['pic']);
        $p = model('recommend_stars')->data($_POST)->save($id);
        $this->success($p);
    }
    function add_stars($uid){
        if(!$uid)$this->error(400,'参数错误');
        if(!$u = $this->userInfo->find($uid))$this->error(401,'未找到用户');
        $sid = post('sid',1);
        $data['uid'] = $u['uid'];
        $s = model('recommend_stars')->data($data)->save($sid);
        $this->success($s);
    }
    function banner_detail($id){
        if(is_null($id))$this->_header('banner');
        $this->subnav = array_merge($this->subnav,array('banner_detail'=>'banner设置'));
        $this->_init();
        if(!$id){
            $co = model('banner')->get_field();
            if($co>4)$this->_header('banner');
            $this->g->template['id'] = 0;
            T(CONTROL_NAME.'/'.__FUNCTION__);die();
        }
        if(!$b = model('banner')->find($id))$this->_header('banner');
        
        $this->g->template['id'] = $b['bid'];
        T(CONTROL_NAME.'/'.__FUNCTION__);
    }
    function save_banner_detail($id){
        $_POST['pic'] = str_ireplace(array('.small','.large','.jpg'),'',$_POST['pic']);
        if($_POST['bid'] && $_POST['bid']!=$id){
            if(model('banner')->find($_POST['bid'])){
                $this->error(300,'BID不能重复');
            }
        }
        $_POST['ctime'] = time();
        if(!$id){
            $p = model('banner')->data($_POST)->add();
        }
        else $p = model('banner')->data($_POST)->save($id);
        $this->success($p);
    }
    function get_banner_detail($id){
        $info = model('banner')->find($id);
        if(!$info)$this->error(400,'no data');
        if($info['pic'])$info['pic'] .= '.small.jpg';
        $this->success($info);
    }
    function del_banner($id){
        $p = model('banner')->remove($id);
        $this->success($p);
    }

}