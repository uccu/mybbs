<?php
namespace plugin\app\control;
defined('IN_PLAY') || die('Access Denied');
class Album extends api\ajax{
    function _beginning(){
        
    }
    function _picture($aid){
        $where['aid'] = $aid;
        return $this->picture->where($where)->limit(9999)->select();
    }
    function _album($aid){
        return $this->album->find($aid);
    }
    function _get_picture(){
        return model('app:Picture');
    }

    function index($aid){
        $this->picture->add_table(array(
            'character'=>array('_on'=>'cid','pid','name'=>'cname','_mapping'=>'c','_join'=>'LEFT JOIN'),
            'provenance'=>array('_on'=>'c.pid=p.pid','name'=>'pname','_mapping'=>'p','_join'=>'LEFT JOIN')
        ));
        $this->g->template['album'] = $album = $this->_album($aid);
        if(!$album)$this->error(401,'相册不存在');
        $this->album->data(array('view'=>array('add',1)))->save($aid);
        $p = $this->_picture($aid);
        $this->g->template['pictures'] = &$p;
        $this->g->template['count'] = count($p);
        
        foreach($p as &$v){
            if($v['cname'] && $v['tag'])$v['tag'] .= ','.$v['cname'];
            if($v['pname'] && $v['tag'])$v['tag'] .= ','.$v['pname'];
            
            $v['tag'] = $v['tag']?explode(',',$v['tag']):array();
            
        }
        $this->g->template['title'] = $album['title'];
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        T('Album/index');
    }

    function create($title){
        $this->user->_safe_login();
        $title = $data['title'] = post('title',$title);
        if(!$title)$this->error(401,'标题不允许为空');
        if(strlen($title)>30)$this->error(400,'标题长度过长');
        $data['thumb'] = '';
        $data['uid'] = $this->user->uid;
        $data['tid'] = $this->user->tid;
        $data['ctime'] = TIME_NOW;
        $aid = $this->album->data($data)->add();
        $array['aid'] = $aid;
        $this->success($array);
    }
    function creationphoto(){
        $this->user->_safe_login();
        $this->g->template['title'] = '个人中心-相册创建';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        T('album/creationphoto');

    }

    function delete($aid){
        $where['aid'] = $aid = post('aid',$aid);
        $album = $this->album->find($aid);
        if(!$album)$this->success(array('count'=>0));
        $this->user->_safe_right($album['uid']);
        $c = $this->album->remove($aid);
        $c2 = $this->picture->where($where)->remove();
        model('dongtai')->where($where)->remove();
        $this->success(array('count'=>$c2));
    }
    function upload($aid){
        $this->user->_safe_login();
        $aid = post('aid',$aid);
        $album = $this->album->find($aid);
        if(!$album)$this->error(401,'没有找到相册');
        $this->user->_safe_right($album['uid']);
        $src = control('tool:upload','picture')->parsing_one('album',1,1,1);
        if(!$src)$this->success(array('count'=>0));
        $data['src'] = $src['e'];
        $data['aid'] = $aid;
        $data['cid'] = post('cid');
        $data['des'] = post('des');
        $data['ctime'] = TIME_NOW;
        $tag = post('tags');
        if(is_array($tag)){
            $data['tag'] = implode(',',$tag);
        }
        $data['uid'] = $this->user->uid;
        $c = $this->picture->data($data)->add();
        if($c){
            $count = $this->picture->where(array('aid'=>$aid))->get_field();
            $data = array(
                'count'=>$count
            );
            if(!$album['thumb'] || $cover = post('cover')){
                $data['thumb'] = $src['e'];
            }
            $this->album->data($data)->save($aid);
        }
        $this->success(array('pid'=>$c));
    }
    function admin(){
        $this->user->_safe_login();
        $where['uid'] = $this->user->uid;
        $this->g->template['list'] = $this->album->where($where)->limit(9999)->select();
        if(!$this->g->template['list'])header('Location:/app/album/creationphoto');
        $this->g->template['title'] = '个人中心-相册管理';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        T('album/admin');
    }
    function admin_pic($aid){
        if(!$aid)header('Location:/app/album/admin');
        $this->user->_safe_login();
        $where['uid'] = $this->user->uid;
        $this->g->template['list'] = $this->album->where($where)->limit(9999)->select();
        if(!$this->g->template['list'])header('Location:/app/album/creationphoto');
        $this->g->template['title'] = '个人中心-相册管理';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        T('album/admin_pic');
    }
    function get_pic($aid){
        $this->user->_safe_login();
        $aid = post('aid',$aid);
        $album = $this->album->find($aid);
        if(!$album)$this->error(401,'没有找到相册');
        $this->user->_safe_right($album['uid']);
        $p = $this->_picture($aid);
        $this->success($p);
    }
    function del_pic($pid){
        $this->user->_safe_login();
        $p = model('app:Picture')->find($pid);
        $this->user->_safe_right($p['uid']);
        model('app:Picture')->remove($pid);
        $c = model('app:Picture')->where(array('aid'=>$p['aid']))->get_field();
        $this->album->data(array('count'=>$c))->save($p['aid']);
        $this->success();
    }
    function lists($uid){
        $where['uid'] = $uid?$uid:$this->user->uid;
        $this->g->template['list'] = $this->album->where($where)->limit(9999)->select();
         $this->g->template['thisuid'] = $where['uid'];
        $this->g->template['title'] = '相册列表';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        T('album/lists');
    }
    function teamlists($tid){
        $where['tid'] = $tid;
        $this->g->template['list'] = $this->album->where($where)->limit(9999)->select();
         $this->g->template['thisuid'] = -1;
        $this->g->template['title'] = '相册列表';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        T('album/lists');
    }
    function photoupdate(){
        $this->user->_safe_login();
        $this->g->template['title'] = '个人中心-相册上传';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        $this->g->template['albums'] = model('album')->where(array('uid'=>$this->user->uid))->limit(9999)->select();
        if(!$this->g->template['albums'])header('Location:/app/album/creationphoto');
        $this->g->template['provenance'] = model('provenance')->order(array('fans'=>'DESC'))->limit(9999)->select();
         $this->g->template['tags'] = model('tag')->limit(9999)->select();
        T('album/photoupdate');
    }
    function dongtai($aid,$num){
        $aid = floor($aid);
        $nn = $num = floor($num);
        if(!$num)$this->success();
        if($num>3)$num = 3;
        $this->user->_safe_login();
        $a = model('album')->find($aid);
        if(!$a)$this->error(404,'，没有找到相册');
        $data['uid'] = $this->user->uid;
        $data['type'] = 1;
        $data['des'] = '更新了相册"'.$a['title'].'"';
        $data['href'] = '/app/album/index/'.$aid;
        $n = 'img';
        $pp = model('picture')->limit($num)->order(array('ctime'=>'DESC'))->where(array('aid'=>$aid))->select();
        $data['pic1'] = $pp[0]['src'];
        $data['pic2'] = $pp[1]['src'];
        $data['pic3'] = $pp[2]['src'];
        $data['aid'] = $aid;
        $data['tag'] = array();
        foreach($pp as $p){
            if($p['tag'])$data['tag'][]=$p['tag'];
        }
        $data['tag'] = implode(',',$data['tag']);
        $data['ctime'] = TIME_NOW;
        model('dongtai')->data($data)->add();
    }

}




?>