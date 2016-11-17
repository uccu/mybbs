<?php
namespace plugin\h5\control;
use plugin\app\control\base\e;
defined('IN_PLAY') || exit('Access Denied');
class fuli extends e{
    

    function lists(){


        $this->g->template['list'] = model('weixin')->order(array('ctime'=>'DESC'))->limit(999)->select();

        foreach($this->g->template['list'] as &$v){
            
            if($v['thumb'])$v['thumb'] = $this->imgDir.$v['thumb'];
            $v['content'] = preg_replace('#<.*?>#','',$v['content']);
            if($v['content'])$v['content'] = mb_substr($v['content'],0,20);
            if(mb_strlen($v['content'])==20)$v['content'] .= '...';
        }

        
        $this->g->template['title'] = '活动与福利';

        T('fuli/lists');
    }

    function info($id){
        $info = model('weixin')->find($id);

        if(!$info)return;

        foreach($info as $k=>$v){
            $this->g->template[$k] = $v;
        }
        $this->g->template['name'] = $this->g->template['title'];

        $this->g->template['date'] = date('Y-m-d',$info['ctime']);

        $this->g->template['title'] = '活动与福利';

        T('fuli/info');


    }

}
?>