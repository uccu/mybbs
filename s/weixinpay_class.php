<?php
/**
 * 微信支付
 */
include "common.php";
include "WxPayPubHelper/WxPayPubHelper.php";
$appId = "wxd9454f19394d5949";
$appSecret = "78e2dab5b9824a3a690ac942a36b8763";
$notify_url = "http://". $_SERVER["HTTP_HOST"] . "/app/item/wcpay_c";
$mch_id = "1394351202";
//$order_id = $_GET['order_id'];
//$total_fee = 1;

//订单信息

$total_fee = $_SESSION['LG_wPayMoney'] * 100;

$JsApi = new JsApi_pub();


$createOrderURL = "https://api.mch.weixin.qq.com/pay/unifiedorder";
$noncestr = strtolower(md5('LSBL'.time()));	//随机字符串
$timestamp = time();				//时间戳

//获取access_token
$tokenParam = "grant_type=client_credential&appid=".$appId."&secret=".$appSecret;
$tokenJsonStr = curl_request("https://api.weixin.qq.com/cgi-bin/token?" . $tokenParam, "", "POST");
$tokenJsonStr = json_decode($tokenJsonStr, true);
$access_token = $tokenJsonStr["access_token"];
//获取jsapi_ticket
$ticketParam = "access_token=".$access_token."&type=jsapi";
$ticketJsonStr = curl_request("https://api.weixin.qq.com/cgi-bin/ticket/getticket?" . $ticketParam, "", "POST");
$ticketJsonStr = json_decode($ticketJsonStr, true);
$ticket = $ticketJsonStr["ticket"];

//执行统一下单接口 获得预支付id
$preapy_param = array(
	'appid' 			=> $appId,							//公众号唯一标示
	'body' 				=> '乐商部落',							//商品描述
	'mch_id' 			=> $mch_id,						//商户id
	'nonce_str'	 		=> $noncestr,					//随机字符串
	'notify_url' 		=> $notify_url,   //异步回调地址
	'openid'			=> $_SESSION["user_openid"],
	'out_trade_no' 		=> $_SESSION['LG_wPayOutTradeNo'], 	//商家订单号
	'spbill_create_ip' 	=> '127.0.0.1',			//用户的公网ip
	'total_fee' 		=> $total_fee,							//商品价格(以分为单位)
	'trade_type' 		=> 'JSAPI'						//支付方式
);

$preapy_param["sign"] = $JsApi->getSign($preapy_param);


//数组转换xml
$preapy_xml = $JsApi->arrayToXml($preapy_param);

//post请求,获得预支付id
$preapay_result = curl_xml($createOrderURL, $preapy_xml);
$preapay_result = $JsApi->xmlToArray($preapay_result);
$return_code = $preapay_result["return_code"];
$prepay_id = $preapay_result["prepay_id"];  //预支付id

//拼接参数,生成支付签名,这个签名 给 微信支付的调用使用
$params = array(
	'appId' 	=> $appId,
	'nonceStr' 	=> $noncestr,
	'package' 	=> 'prepay_id='.$prepay_id,
	'signType' 	=> 'MD5',
	'timeStamp' => $timestamp,
);
//生成签名
$paySign = $JsApi->getSign($params);


$request = array(
	'appId' 		=> $appId,
	'nonceStr'		=> $noncestr,
	'out_trade_no'	=> $_SESSION['LG_wPayOutTradeNo'],
	'package'		=> 'prepay_id='.$prepay_id,
	'paySign' 		=> $paySign,
	'signType'		=> 'MD5',
	'timeStamp' 	=> $timestamp,
);

//拼接参数,生成签名;这个签名.主要是给加载微信js使用.别和上面的搞混了.
$request_url = "http://". $_SERVER["HTTP_HOST"] ."/s/weixinpay_class.php";
$signValue = "jsapi_ticket=".$ticket."&noncestr=".$noncestr."&timestamp=".$timestamp."&url=".$request_url;

$signature = sha1($signValue);

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta id="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
	<meta name="apple-themes-web-app-capable" content="yes">
	<meta content="yes" name="apple-mobile-web-app-capable">
	<meta content="black" name="apple-mobile-web-app-status-bar-style">
	<meta content="telephone=no" name="format-detection">
	<meta content="email=no" name="format-detection">
	<meta name="format-detection" content="telephone=no">
	<title>微信支付</title>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" charset="UTF-8" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script type="text/javascript">
		pay();
		function pay(){
			wx.config({
				debug : false,	// 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
				appId : "<?php echo $appId ?>",	// 必填，公众号的唯一标识
				timestamp : "<?php echo $timestamp ?>",	// 必填，生成签名的时间戳
				nonceStr : "<?php echo $noncestr ?>",	// 必填，生成签名的随机串
				signature : "<?php echo $signature ?>",	// 必填，签名，见附录1
				jsApiList : [
					"checkJsApi",
					"chooseWXPay"
				]	// 必填，需要使用的JS接口列表，所有JS接口列表见附录2
			});
			wx.ready(function(){
				wx.chooseWXPay({
					timestamp : "<?php echo $timestamp; ?>",
					nonceStr : "<?php echo $request["nonceStr"]; ?>",
					package : "<?php echo $request["package"]; ?>",
					signType : "MD5",
					paySign : "<?php echo $request["paySign"]; ?>",
					success : function (res) {
						// 支付成功后的回调函数
						WeixinJSBridge.log(res.err_msg);
						//alert("支付接口:"+res.err_code + res.err_desc + res.err_msg);
						if(!res.err_msg){
							//支付完后.跳转到成功页面.
							window.location.replace("download.html");
						}
					}
				});
			});
			wx.error(function(res){
				// config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
			});
			wx.checkJsApi({
				jsApiList: ['chooseWXPay'], // 需要检测的JS接口列表，所有JS接口列表见附录2,
				success: function(res) {
					//alert("检测接口:"+res.err_msg);
				}
			});
		}
	</script>
</head>
<body>
</body>
</html>












