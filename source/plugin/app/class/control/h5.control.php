<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class h5 extends base\e{
    function _beginning(){
        //$this->_check_login();
    }

    function shuoming($id=0){
        $id = post('id',$id,'%d');
        $this->g->template['value'] = model('user_instruction')->where(array('type'=>$id))->get_field('instruction');
        T('tool:static');
    }

    function tequan($id=0){
        $id = post('id',$id,'%d');
        $this->g->template['value'] = model('user_instruction')->where(array('type'=>$id))->get_field('title');
        T('tool:static');
    }

    function banner($id=0){
        $id = post('id',$id,'%d');
        $this->g->template['value'] = model('banner')->find($id,false)->get_field('content');
        T('tool:static');
    }

    function user($id=1){
        $id = post('id',$id,'%d');
        $this->g->template['value'] = model('html')->find($id,false)->get_field('content');
        T('tool:static');

    }


    function top($id=0){
        $id = post('id',$id,'%d');
        $r = model('top_line')->find($id);
        $this->g->template['value'] = $r['content'];
        $this->g->template['title'] = $r['title'];
        $this->g->template['time'] = date('Y-m-d H:i:s',$r['ctime']);
        T('tool:static');
    }
    
    function vip($id=0){
        $id = post('id',$id,'%d');

        if($id == 0){
            $this->g->template['value'] .= model('member')->find(1,false)->get_field('content');
            $this->g->template['value'] .= model('member')->find(2,false)->get_field('content');
            $this->g->template['value'] .= model('member')->find(3,false)->get_field('content');

        }else
        $this->g->template['value'] = model('member')->find($id,false)->get_field('content');
        T('tool:static');

    }

    function sale($id=0){
        $id = post('id',$id,'%d');
        $this->g->template['value'] = model('sale')->find($id,false)->get_field('details');
        T('tool:static');
    }


    function index(){

        T('app:index');

    }

    function repository($id){
        $id = post('id',$id,'%d');
        $r = model('repository')->find($id);
        model('repository')->data(array('reading'=>array('add',1)))->save($id);


        


        $this->g->template['value'] = $r['content'];
        $this->g->template['title'] = $r['title'];
        $this->g->template['time'] = date('Y-m-d H:i:s',$r['ctime']);

        $this->g->template['footer'] .= '<hr style="height:20px;background:#f1f1f1">';

        $this->g->template['footer'] .= '<div class="container" style="margin-bottom: 15px;"><p class="describe">如果您有相关的知识信息或视频想要与大家分享，请将您的资料发送至我们的邮箱：<a>ywws@qingce.com</a>，
我们会免费帮您上传。</p></div>';



        T('tool:static');


    }

    function tesst($content='测试~'){
        $z = $this->_pusher($content,$uid=214);
        var_dump($z);
    }

}
?>