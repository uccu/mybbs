<?php
namespace plugin\app\model;
defined('IN_PLAY') || die('Access Denied');
class UserInfo extends \model{
    protected $tableMap = array(
        'user_info'=>array(
            'uid','nickname','area','age','constel','interest','password','salt','phone','avatar','ctime','cover','tid','sign','thumb','last','last_login','type'
        ),
    );
    protected $countMap = array(
        'user_count'=>array(
            'follow','fans','_on'=>'uid'
        )
    );
    protected $teamMap = array(
        'user_team'=>array(
            'captain','_on'=>'uid','_join'=>'LEFT JOIN'
        )
    );
    function _beginning(){

    }
    function safe_info(){
        $this->tableMap['user_info'] = array(
            'uid','nickname','area','age','constel','interest','phone','avatar','cover','tid','sign','thumb','last','last_login','type'
        );return $this;
    }
    function add_count(){
        return $this->add_table($this->countMap);
    }
    function add_team(){
        return $this->add_table($this->teamMap);
    }


}
?>