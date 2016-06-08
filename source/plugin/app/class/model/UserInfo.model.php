<?php
namespace plugin\app\model;
defined('IN_PLAY') || die('Access Denied');
class UserInfo extends \model{
    protected $tableMap = array(
        'user_info'=>array(
            'uid','nickname','area','age','constel','interest','password','salt','phone','avatar'
        ),
    );
    protected $countMap = array(
        'user_count'=>array(
            'follower','fans','_on'=>'uid'
        )
    );
    function safe_info(){
        $this->tableMap['user_info'] = array(
            'uid','nickname','area','age','constel','interest','phone','avatar'
        );return $this;
    }
    function add_count(){
        return $this->add_table($this->countMap);
    }


}
?>