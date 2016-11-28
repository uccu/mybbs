<?php
/**
 * Created by PhpStorm.
 * User: ZhuXueSong
 * Date: 2016/9/28
 * Time: 上午11:26
 */
include "common.php";
include "weixin.class.php";
$money = $_GET['m'];
$out_trade_no = $_GET['out_trade_no'];
$_SESSION['LG_wPayMoney'] = $money;
$_SESSION['LG_wPayOutTradeNo'] = $out_trade_no;
if($_SESSION['user_openid'] != ""){
    header("Location:weixinpay_class.php");
} else {
    $api = new weixinapi();
    $api->get_code();
}
