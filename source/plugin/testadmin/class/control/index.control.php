<?php
namespace plugin\testadmin\control;
defined('IN_PLAY') || exit('Access Denied');
class index extends na\ba{
    function _get_subnav(){
        return array(
            'pictures_wall'=>'照片墙',
            'banner'=>'banner设置',
            'stars'=>'推荐明星设置'
        );
    }

    protected function _beginning(){
        
    }
    function _get_defaultMethod(){
        return 'banner';
    }
    function pictures_wall(){
        $this->_init();
        T(CONTROL_NAME.'/'.__FUNCTION__);
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
        $this->success($info);
    }
    function save_stars_detail($id){
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
    function banner_detail($bid){
        $this->subnav = array_merge($this->subnav,array('banner_detail'=>'banner设置'));
        $this->_init();
        if(!$bid){
            $co = model('banner')->get_field();
            if($co>4)$this->_header('banner');
            T(CONTROL_NAME.'/'.__FUNCTION__);die();
        }
        if(!$b = model('banner')->find($bid))$this->_header('banner');
        
        $this->g->template['id'] = $b['bid'];
        T(CONTROL_NAME.'/'.__FUNCTION__);
    }
    function save_banner_detail($id){
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
        $this->success($info);
    }
    function del_banner($id){
        $p = model('banner')->remove($id);
        $this->success($p);
    }

}