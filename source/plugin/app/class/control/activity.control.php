<?php
namespace plugin\app\control;
defined('IN_PLAY') || die('Access Denied');
class activity extends api\ajax{
    function _beginning(){
        
    }
    
    function index($cid){
        $c = model('activity')->find($cid);
        $this->g->template['activity'] = &$c;
        if(!$c)header('Location:404.html');
        $c['date'] = date('Y-m-d H:i:s',$c['ctime']);
        $c['content'] = preg_replace('#\n#','<br>',$c['content']);
        $this->g->template['title'] = $c['title'];
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = $c['description'];
        T('activity/index');
    }
    function lists($tid){
        $c = model('activity')->where(array('tid'=>$tid))->limit(999)->order(array('ctime'=>'DESC'))->select();
        $this->g->template['activity'] = &$c;
        $this->g->template['title'] = '社团活动列表';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = $c['description'];
        T('activity/lists');
    }
    
}




?>