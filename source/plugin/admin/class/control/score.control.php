<?php
namespace plugin\admin\control;
defined('IN_PLAY') || exit('Access Denied');
class score extends \control\ajax{
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
    function _get_product(){
        return model('project:product');
    }
    function _get_productView(){
        return model('project:project_link_product');
    }
    function _get_area(){
        return model('tool:area');
    }
    function _get_gift(){
        return model('user:gift');
    }
    function _get_score(){
        return model('user:score_detail');
    }
    function _get_setting(){
        return model('user:score_setting');
    }
    function _get_work(){
        return model('tool:work_list');
    }


    function lists($page=1,$s=0){
        $where=array();
        if($s)$where['nickname'] = $s;
        $userMap = array('user_info'=>array('_on'=>'uid','nickname','phone'));
        $this->score->add_table($userMap);
        $maxRow= $this->score->where($where)->limit(99999999)->get_field();
        $maxPage = floor(($maxRow-1)/10)+1;
        table('config')->template['maxRow'] = $maxRow;
        table('config')->template['maxPage'] = $maxPage;
        table('config')->template['currentPage'] = $page;
        $list = $this->score->where($where)->page($page,10)->order(array('stime'=>'DESC'))->select();
        foreach($list as &$p){
            $p['cdate'] = date('Y-m-d',$p['stime']);
            $p['zscore'] = ($p['type']=='out'?'-':'+').$p['score'];
        }
        table('config')->template['list'] = $list;
        //table('config')->template['projects'] = $this->project->field(array('jid','jthumb','jname'))->limit(999)->order(array('jorder'))->select();
        T('admin:score/lists');
        
    }
    function setting(){
        
        $list = $this->setting->limit(9999)->select();
        
        table('config')->template['list'] = $list;
        //table('config')->template['projects'] = $this->project->field(array('jid','jthumb','jname'))->limit(999)->order(array('jorder'))->select();
        T('admin:score/setting');
        
    }
    function change_setting(){
        $id = post('name');
        $d = $this->setting->data($_POST)->save($id);
        
        $this->success($d);
    }

    function _nomethod(){
        $this->lists();
    }

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>