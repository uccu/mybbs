<?php
namespace plugin\seanime\control;
defined('IN_PLAY') || exit('Access Denied');
class page extends \control{
    function _beginning(){
        if(stripos($_SERVER["HTTP_REFERER"], $this->g->config['BASE_URL'])!==0)$this->error();
    }
    protected function _get_model(){
        return model('seanime:seanime_resource');
    }
    protected function _get_g(){
        return table('config');
    }
    function _get_user(){
        return control('user:base','api');
    }
    function sid($sid,$time){
        $table = array('seanime_theme'=>array('name','_on'=>'aid'));
        $table2 = array('user_info'=>array('username'=>'uname','_on'=>'seanime_sources.suid = user_info.uid'));
        $r = $this->model->add_table($table)->add_table($table2)->find($sid);
        //echo $r ;die();
        if(!$r||$time!=$r['stimeline']){
            //var_dump($r,$time);die();
            $this->error();
        }
        $r['date'] = date('Y-m-d H:i:s',$r['stimeline']);
        $img = 'data:image/gif;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVQImWNgYGBgAAAABQABh6FO1AAAAABJRU5ErkJggg==';
        $rr=array('/\[img_s\](.*\/.{16})[st]?\.(jpg|png|gif)\[\/img\]/','/\[img(_s)?\](.*?)\[\/img\]/');
		$p=array("<div><a href='$1.$2' target='_blank' class='plusshow'><img src='$img' data-original='$1t.jpg' /></a></div>",
        "<img src='$img' data-original='$2' style='max-width:80%' />");
        if($r['subtitle']=='Leopard-Raws'&&!$r['sdes'])$r['sdes'] = '[img]http://i4.piimg.com/1f2422a328733ab9.png[/img]';
		$r['sdes']=preg_replace($rr,$p,$r['sdes']);
        $right = $this->user->right;
        $t = template();
        $g = (array)$this->g;
        include $t;
    }
}

?>