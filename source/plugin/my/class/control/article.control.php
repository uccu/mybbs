<?php
namespace plugin\my\control;
defined('IN_PLAY') || exit('Access Denied');
class article extends \control\ajax{
    function _beginning(){

    }
    function _get_article(){
        return model('my:article');
    }
    function _get_reply(){
        return model('my:reply');
    }
    private function unseri(&$n){
        $n = preg_replace_callback('/\{(?:(center):)?img:([0-9]{1,2})\/([a-z0-9]{16})\.(jpg|png|gif):\}/i',function($e){
            return '<p><img src="s'.$e[2].'/'.$e[3].'.'.$e[4].'" class="img-responsive '.($e[1]?'center-block':'').'" /></p>';
        },$n);
        $ae = array();
        $callback = function($e) use (&$ae){
            if($e[5]){
                if(!$ae)return $e[5];
                $c = substr_count($e[0],$e[6]);$d = $e[5];
                for($i=0;$i<$c;$i++){
                    $o = end($ae);
                    unset($ae[array_search($o,$ae)]);
                    $d .= "</$o>";
                }
                return $d;
            }else{
                if($e[1]){
                    $k='';
                    while(array_search('p',$ae)!==false){
                        $o = end($ae);
                        unset($ae[array_search($o,$ae)]);
                        $k .= "</$o>";
                    }
                    $p = $e[1];
                    if($e[2]=='pre'){
                        $o = $ae[] = $e[2];
                        $k.="<$o class=\"text-$p\" ";
                    }else{
                        $ae[] = 'p';
                        $o = $ae[] = $e[2];
                        $k.="<p class=\"text-$p\"><$o ";
                    }
                }else{
                    $o = $ae[] = $e[2];
                    $k = "<$o ";
                }
                if($e[3]){
                    $k .='style="'.$e[3].':'.$e[4].'"';
                }
                return $k.'>';
            }
        };
        $n = preg_replace_callback(
            '#\{(?:(center|left|right|justify|nowrap):)?(strong|code|pre|mark|del|u|small|big|em)(?:\[(color|font-size)=([\#a-z0-9]+)\])?:|([^-])(:\})+#i',
            $callback,$n);
        while($ae){
            $o = end($ae);
            unset($ae[array_search($o,$ae)]);
            $n .= "</$o>";
        }  
        $n .= '<br />';
        
    }
    private function serpic($n){
        preg_match_all('/\{(?:(center):)?img:([0-9]{1,2})\/([a-z0-9]{16})\.(jpg|png|gif):\}/i',$n,$r,PREG_SET_ORDER);
        if(!$r)return array();
        $t = array();
        foreach($r as $e)$t[] = $e[2].'/'.$e[3].'.'.$e[4];
        return $t;
    }
    private function serword($n){
        $n = preg_replace('#\{(?:(center):)?img:([0-9]{1,2})\/([a-z0-9]{16})\.(jpg|png|gif):\}#i','',$n);
        $n = preg_replace(
            '#\{(?:(center|left|right|justify|nowrap):)?(strong|code|pre|mark|del|u|small|big|em)(?:\[(color|font-size)=([\#a-z0-9]+)\])?:#i',
            '',$n);
        $n = preg_replace('#([^-])(:\})+#i','$1',$n);
        $n = mb_substr($n,0,200);
        $n = preg_replace('#\n#i','<br />',$n);
        $n = str_replace(' ','&nbsp;',$n);
        return $n;
    }
    function aid($aid,$page=1){
        $m = $this->article;
        if(!$f = $m->find($aid))$this->error(401,'no article');
        $f['date'] = date('Y-m-d H:i:s',$f['ctime']);
        $f['description'] = preg_replace('/\n/','<br>',$f['description']);
        $f['passage'] = explode('<br>',$f['description']);
        foreach($f['passage'] as &$n)$this->unseri($n);
        $this->g->template['title'] = $f['title'];
        $this->g->template['article'] = $f;
        $this->g->template['rows'] = $rows = $f['reply_count'];
        $this->g->template['maxPage'] = floor(($rows-1)/10)+1;
        $this->g->template['currentPage'] = $page;
        $where2['aid'] = $aid;$r = $this->reply->where($where2)->page($page,10)->select();
        foreach($r as &$v){
            $v['md5'] = 'https://secure.gravatar.com/avatar/'.md5($v['email']);
        }
        $this->g->template['reply'] = $r;
        T();
    }
    function list($page=1){
        $m = $this->article;
        
        $this->g->template['rows'] = $rows = model('cache')->get('article_count','%d');
        $this->g->template['maxPage'] = floor(($rows-1)/10)+1;
        $this->g->template['currentPage'] = $page;
        $f = $m->order(array('ctime'))->page($page,10)->select();
        foreach($f as &$v){
            $v['pic'] = $this->serpic($v['description']);
            $v['summary'] = $this->serword($v['description']);
             $v['date'] = date('Y-m-d H:i:s',$v['ctime']);
        }
        $this->g->template['title'] = 'Hello,Bye';
        
        $this->g->list = $f;
        //var_dump($f);die();
        T('list');
        
    }
    function reply($aid=0){
        if(!$_POST['email'] || !$_POST['nickname'] || !$_POST['content'])$this->error(403,'参数不正确');
        if(!$a = $this->article->find($aid))$this->error(400,'不存在文章');
        $_POST['aid'] = $aid;
        if(!$r = $this->reply->data($_POST)->add())$this->error(401,'创建评论失败');
        $data['reply_count'] = array('add',1);
        if(!$d = $this->article->data($data)->save($aid))$this->error(402,'增加评论数量失败');
        $this->success();
    }
    function _nomethod(){
        $this->error('401','no article');
        
    }
}


?>