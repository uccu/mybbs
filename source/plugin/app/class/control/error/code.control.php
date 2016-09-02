<?php
namespace plugin\app\control\error;
defined('IN_PLAY') || exit('Access Denied');
class code extends \control\ajax{
    private $list = array(
        401=>'该手机号未注册',
        402=>'密码错误',
        403=>'未知第三方登录方式',
        404=>'不完整的第三方登录数据',
        405=>'该手机号已经注册',
        406=>'密码长度不够',
        407=>'手机格式错误',
        408=>'不存在该推荐人',
        409=>'创建用户失败',
        410=>'未登录',
        411=>'未知商品ID',
        412=>'已经收藏该商品',
        413=>'加入购物车数量不正确',


        700=>'安全错误警告',
    );
    public function errorCode($z){
        if(!$content = $this->list[$z]){
            $this->error('400','未知错误');
        }else $this->error($z,$content);
    }

}
?>