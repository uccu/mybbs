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
        $this->g->template['album'] = $album = $this->_album($aid);
        if(!$album)$this->error(401,'相册不存在');
        $p = $this->_picture($aid);
        $this->g->template['pictures'] = &$p;
        foreach($p as &$v){
            $v['tag'] = $v['tag']?explode(',',$v['tag']):array();
        }
        T('Album/index');
    }

    function create($title){
        $this->user->_safe_login();
        $title = $data['title'] = post('title',$title);
        if(!$title)$this->error(401,'标题不允许为空');
        $data['thumb'] = 'no_album_thumb.jpg';
        $data['uid'] = $this->user->uid;
        $data['tid'] = $this->user->tid;
        $data['ctime'] = TIME_NOW;
        $aid = $this->album->data($data)->add();
        $array['aid'] = $aid;
        $this->success($array);
    }
    function creationphoto(){
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
        $tag = post('tags');
        if(is_array($tag)){
            $data['tag'] = implode(',',$tag);
        }
        $data['uid'] = $this->user->uid;
        $c = $this->picture->data($data)->add();
        if($c){
            $data = array(
                'count'=>array('add',1)
            );
            if($cover = post('cover')){
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
        $this->g->template['title'] = '个人中心-相册管理';
        $this->g->template['keywords'] = 'COS,炫漫';
        $this->g->template['description'] = '炫漫重视所有的的coser，尊重coser的自主意愿和需求，致力将您打造成高人气的二次元明星';
        T('album/admin');
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
        $this->g->template['provenance'] = model('provenance')->order(array('fans'=>'DESC'))->limit(9999)->select();
         $this->g->template['tags'] = model('tag')->limit(9999)->select();
        T('album/photoupdate');
    }

}




?>