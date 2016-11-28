<?php
/**
 * Created by PhpStorm.
 * User: ZhuXueSong
 * Date: 2016/9/28
 * Time: 下午2:33
 */

header("Content-type:text/html; charset=utf-8");
include "common.php";
include 'weixin.class.php';
$code = $_GET['code'];
//实例化微信接口
$weixin = new weixinapi();
//获取openid和access_token
$auth_info = $weixin->get_auth_info($code);
//获取用户信息
$user_info = $weixin->get_user_info($auth_info['openid']);
$_SESSION['user_openid'] = $user_info['openid'];

header("Location:weixinpay_class.php");
