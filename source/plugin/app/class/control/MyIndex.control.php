<?php
namespace plugin\app\control;
defined('IN_PLAY') || die('Access Denied');
class MyIndex extends api\ajax{
    function _beginning(){
        
    }
    
    function _nomethod(){
        $this->user->_safe_login();
        $this->g->template['newfans'] = model('user_follow')->add_table(array(
            'user_info'=>array(
                '_on'=>'uid','nickname','avatar'
            )
        ))->where(array(
            'following'=>$this->user->uid,
            'ctime'=>array('logic',$this->user->me['last'],'>')
        ))->limit(30)->select();
        $dongtai = model('dongtai')->add_table(array(
            'user_info'=>array('_mapping'=>'i','avatar','nickname','_on'=>'uid'),
            'user_follow'=>array('_mapping'=>'f','following','uid'=>'zuid','_on'=>'f.following=i.uid')
            
        ))->where(array(
            'zuid'=>$this->user->uid,
        ))->order(array('ctime'=>'DESC'))->limit(7)->select();
        $this->g->template['dongtai'] = &$dongtai;
        foreach($dongtai as &$v){
            $v['date'] = date('Y-m-d H:i');
            $v['tags'] = explode(',',$v['tag']);
        }
        $this->g->template['banner'] = model('banner2')->order(array('id'))->limit(3)->select();
        $this->g->template['title'] = '动态首页';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        T();
    }
}




?>