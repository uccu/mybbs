<?php
namespace plugin\admin\control;
defined('IN_PLAY') || exit('Access Denied');
class common extends \control\ajax{
    function _beginning(){
        $this->user->_safe_type(2);
    }
    function _get_user(){
        return control('user:base','api');
    }
    function _get_model(){
        return model('common:opition');
    }
    function _get_userModel(){
        return model('user:user_info');
    }
    function _get_project(){
        return model('project:project');
    }
    function pic(){
        $m = $this->model->find('logo_pic');
        if(!$m)$m = array();
        else $m = unserialize($m['content']);
        table('config')->template['pic'] = $m;
        T('admin:common/pic');
    }
    function change_pic(){
        $m = $this->model->find('logo_pic');
        if(!$m)$m = array();
        else $m = unserialize($m['content']);
        $id = post('id');
        $m[$id] = array('type'=>post('type'),'value'=>post('value'),'pic'=>post('pic'));
        $move = post('move');
        if(strlen($move)){
            foreach($m as $k=>$v){
                if($k==$move)$mm[] = $m[post('id')];
                if($k==$id)continue;
                $mm[] = $v;
            }
            if(count($mm)!=count($m))$mm[] = $m[post('id')];
            $m = $mm;
        }
        $data['content'] = array('logic',$m,'%s');
        $m = $this->model->data($data)->save('logo_pic');
        $this->success($m);
    }
    function del_pic(){
        $m = $this->model->find('logo_pic');
        if(!$m)$m = array();
        else $m = unserialize($m['content']);
        unset($m[post('id')]);
        $m =  array_values($m);
        $data['content'] = array('logic',$m,'%s');
        $m = $this->model->data($data)->save('logo_pic');
        $this->success($m);
    }
    function add_pic(){
        $m = $this->model->find('logo_pic');
        if(!$m)$m = array();
        else $m = unserialize($m['content']);
        $m[] = array('type'=>'none','value'=>'','pic'=>'no_pic');
        $data['content'] = array('logic',$m,'%s');
        $m = $this->model->data($data)->save('logo_pic');
        $this->success($m);
    }
    function shop(){
        $m = $this->model->find('shop_pic');
        if(!$m)$m = array();
        else $m = unserialize($m['content']);
        table('config')->template['pic'] = $m;
        T('admin:common/shop');
    }
    function change_shop(){
        $m = $this->model->find('shop_pic');
        if(!$m)$m = array();
        else $m = unserialize($m['content']);
        $id = post('id');
        $m[$id] = array('type'=>post('type'),'value'=>post('value'),'pic'=>post('pic'));
        $move = post('move');
        if(strlen($move)){
            foreach($m as $k=>$v){
                if($k==$move)$mm[] = $m[post('id')];
                if($k==$id)continue;
                $mm[] = $v;
            }
            if(count($mm)!=count($m))$mm[] = $m[post('id')];
            $m = $mm;
        }
        $data['content'] = array('logic',$m,'%s');
        $m = $this->model->data($data)->save('shop_pic');
        $this->success($m);
    }
    function del_shop(){
        $m = $this->model->find('shop_pic');
        if(!$m)$m = array();
        else $m = unserialize($m['content']);
        unset($m[post('id')]);
        $m =  array_values($m);
        $data['content'] = array('logic',$m,'%s');
        $m = $this->model->data($data)->save('shop_pic');
        $this->success($m);
    }
    function add_shop(){
        $m = $this->model->find('shop_pic');
        if(!$m)$m = array();
        else $m = unserialize($m['content']);
        $m[] = array('type'=>'none','value'=>'','pic'=>'no_pic');
        $data['content'] = array('logic',$m,'%s');
        $m = $this->model->data($data)->save('shop_pic');
        $this->success($m);
    }
    function save_ad(){
        $m = array('type'=>post('type'),'desc'=>post('desc'),'content'=>post('content'),'pic'=>post('pic'));
        $data['content'] = array('logic',$m,'%s');
        $m = $this->model->data($data)->save('logo_ad');
        $this->success($m);
    }
    function ad(){
        $m = $this->model->find('logo_ad');
        if(!$m)$m = array();
        else $m = unserialize($m['content']);
        table('config')->template['ad'] = $m;
        T('admin:common/ad');
    }
    function _nomethod(){
        $this->pic();
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>