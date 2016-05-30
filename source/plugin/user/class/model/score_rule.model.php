<?php
namespace plugin\user\model;
defined('IN_PLAY') || exit('Access Denied');
class score_rule extends \model{
    protected $tableMap = array(
        'score_rule'=>array(
                'uid',
                'name',
                'time',
                'times'

        ),
        'score_setting'=>array(
                '_on'=>'name',
                'score',
                'type',
                'stimes',
        )
    );
    function time($uid,$name){
        $r = $this->where(array('name'=>$name,'uid'=>$uid))->find();
        if(!$r)return model('user:score_setting')->where(array('name'=>$name))->find();
        if(date($r['type'])==$r['time']){
            if($r['stimes']<=$r['times'])return false;
        }elseif($r['type']=='s'){
            return false;
        }
        return $r;
        
    }
   
}

?>