<?php
namespace plugin\admin\control;
defined('IN_PLAY') || exit('Access Denied');
class article extends \control\ajax{
    function _beginning(){
        if($this->user->type<2)header('Location:/admin/login');
        table('config')->template['userType'] = $this->user->type;
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
    function _get_area(){
        return model('tool:area');
    }
    function _get_theme(){
        return model('article:theme');
    }
    function _get_article(){
        return model('article:article');
    }
    function _get_work(){
        return model('tool:work_list');
    }
    
    
    //--------------------------------
    function theme_lists(){
        $where['tid']=array('logic',0,'>');
        $list = $this->theme->where($where)->limit(9999)->order(array('tctime'=>'DESC'))->select();
        foreach($list as &$p){
            $p['cdate'] = date('Y-m-d',$p['tctime']);
        }
        table('config')->template['list'] = $list;
        T('admin:article/theme_lists');
    }
    function add_theme(){
        $data = array(
                'tname'=>'资料库',
                'tctime'=>time(),
        );
        $this->theme->data($data)->add();
        $this->success();
    }
    function del_theme($id){
        $m = $this->theme->remove($id);
        $this->success($m);
    }
    function change_theme(){
        $d = $this->theme->data($_POST)->save(post('tid'));
        $this->success($d);
    }
    function get_theme_detail($id){
        $d = $this->theme->find($id);
        if(!$d)$this->error(411,'获取失败');
        $this->success($d);
    }
    
    
    //--------------------------------
    function article_lists($page=1,$n=0,$h=0){
        
        $table = array('theme'=>array('_join'=>'LEFT JOIN','tname','_on'=>'zr_theme.tid=zr_article.atype'));
        $this->article->add_table($table);
        $where['atype'] = array('logic',0,'>');
        if($n)$where['tname'] = $n;
        if($h)$where['atitle'] = $h;
        $maxRow= $this->article->where($where)->limit(99999999)->get_field();
        $maxPage = floor(($maxRow-1)/10)+1;
        table('config')->template['maxRow'] = $maxRow;
        table('config')->template['maxPage'] = $maxPage;
        table('config')->template['currentPage'] = $page;
        
        $list = $this->article->where($where)->page($page,10)->order(array('actime'=>'DESC'))->select();
        foreach($list as &$p){
            $p['cdate'] = date('Y-m-d',$p['actime']);
        }
        $where2['tid']=array('logic',0,'>');
        $themes = $this->theme->where($where2)->limit(9999)->order(array('tctime'=>'DESC'))->select();
        table('config')->template['list'] = $list;
        table('config')->template['themes'] = $themes;
        T('admin:article/article_lists');
        
    }
    function media_lists($page=1,$h=0){
        $where['atype'] = 0;
        if($h)$where['atitle'] = $h;
        $maxRow= $this->article->where($where)->limit(99999999)->get_field();
        $maxPage = floor(($maxRow-1)/10)+1;
        table('config')->template['maxRow'] = $maxRow;
        table('config')->template['maxPage'] = $maxPage;
        table('config')->template['currentPage'] = $page;
        $table = array('theme'=>array('tname','_on'=>'zr_theme.tid=zr_article.atype'));
        $this->article->add_table($table);
        $list = $this->article->where($where)->page($page,10)->order(array('actime'=>'DESC'))->select();
        foreach($list as &$p){
            $p['cdate'] = date('Y-m-d',$p['actime']);
        }
        table('config')->template['list'] = $list;
        T('admin:article/media_lists');
        
    }
    function add_article(){
        $data = array(
                'atitle'=>'文章资料',
                'athumb'=>'no_article_thumb.png',
                'apic'=>'no_article_pic.png',
                'adescription'=>'',
                'atype'=>'1',
                'actime'=>time(),
        );
        $m = $this->article->data($data)->add();
        $this->success($m);
    }
    function add_media(){
        $data = array(
                'atitle'=>'视频资料',
                'athumb'=>'no_article_thumb.png',
                'apic'=>'no_article_pic.png',
                'adescription'=>'',
                'atype'=>'0',
                'actime'=>time(),
        );
        $m = $this->article->data($data)->add();
        $this->success($m);
    }
    function del_article($id){
        $m = $this->article->remove($id);
        $this->success($m);
    }
    function change_article(){
        $_POST['amedia'] = str_ireplace(array('&lt;','&gt;','&quot;','&#39;'),array('<','>','"',"'"),$_POST['amedia']);
        $d = $this->article->data($_POST)->save(post('aid'));
        $this->success($d);
    }
    function get_article_detail($id){
        $d = $this->article->find($id);
        if(!$d)$this->error(411,'获取失败');
        $this->success($d);
    }
    
    function get_detail($jid){
        $tt = post('jid',0,'%d');
        if($tt)$jid = $tt;
        $d = $this->project->find($jid);
        if(!$d)$this->error(411,'获取失败');
        $this->success($d);
    }
    
    function add_project(){
        $data=array(
                
                "jthumb"=>'nopic.png',
                "jname"=>'未知项目',
                "jpic"=>'nopic.png',
                "introduction"=>'',
                "expert"=>'',
                "fealture"=>'',
                "attention"=>'',
                "jctime"=>time(),
  
        );
        $d = $this->project->data($data)->add();
        $this->success($d);
    }
    function del_project(){
        $d = $this->project->remove(post('jid'));
        $this->success($d);
    }
    function _nomethod(){
        $this->theme_lists();
    }

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>