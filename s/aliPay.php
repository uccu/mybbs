<?php
/**
 * Created by PhpStorm.
 * User: ZhuXueSong
 * Date: 2016/10/14
 * Time: 下午2:48
 */

define("ROOT_PATH", str_replace('aliPay.php', '', str_replace('\\', '/', __FILE__)));
require (ROOT_PATH . "aliPay/alipay_submit.class.php");
$appId = "2016092001934331";
$private_key = "MIICWwIBAAKBgQDTrHk1rq21SnYEiOsKUVK3pQh4EshlsmPaxeJWF5RlM9YW5oepCpYUJfJBmSLfQU3KWYqvHWW9HPhkj2Xc24DjGw+7DnJNvfj81bic46stkGrofcrojM8+YFDjTVOeQ7ihaIsNpcfZCQhbn5O2fSjkgWJZvBlpdXXE9LniUeGWkQIDAQABAoGAH4HNrPLqQlDqDjS/H5MJR/KVtyG8mH6cJGVOEliCKyozFMeNq9i6jBc13xPHQAn9ZUA8x2IN0b9tLbK2i9BUd7QXQj65QZOpiV4I7kzWwXO3wyMih0q7DSSjIK1AoyH8G/6XV+b4XExQhchF4K41R1gdlMj/L95rM7AB3uzQAAECQQD2XWO+VNNJ4P2/oJi8kpVZOKiyHenEe07omhoOy15UE8b4gYUYBmydUsez8D3XqpVj9XWOiqM8L+qspdl4TeaRAkEA2/PBhMWHwsRitz50DweiToVJJAtn+9VynKF39bnddMtaK4IN6YUwW/Elkv+wsvu8YVgVUNrvVJ28ziOLwhCwAQJAY3XMgNiJ/HeCucxCHU8oUD7ZjB8bcyE8+BbOkk50JIlfeJABhXOCgfkben9w2BKcASDldshtoizOFylVpIX+oQJAaVHFxyKiiDNrJV1FS3EXWcveouDHUMH7GF8ExufRz7wTmCO1L60z48KLgGDopjt+D4qS4l2DHhxNrNM+d5VwAQJAHlOAYwFauIgSpQX7sU9oQQr1oMa3miBe2QLYQBMG7WUc3ap4yuKBrZ1bzp0jIZYM/0XysoEK0bbSZXypYMuzAA==";
$aliPay_public_key = "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCnxj/9qwVfgoUh/y2W89L6BkRAFljhNhgPdyPuBV64bfQNN1PjbCzkIM6qRdKBoLPXmKKMiFYnkd6rAoprih3/PrQEB/VsW8OoM8fxn67UDYuyBTqA23MML9q1+ilIZwBC2AQ2UBVOrFXfFl75p6/B5KsiNG9zpgmLCUYuLkxpLQIDAQAB";

$param = $_POST;

$config = array(
    "partner" => $param['partner'],
    "seller_id" => $param['seller_id'],
    "private_key" => $private_key,
    "alipay_public_key" => $aliPay_public_key,
    "notify_url" => $param['notify_url'],
    "return_url" => $param['return_url'],
    "sign_type" => strtoupper($param['sign_type']),
    "input_charset" => strtolower($param['charset']),
    "cacert" => getcwd().'\\cacert.pem',
    "transport" => "http",
    "payment_type" => 1,
    "service" => "alipay.wap.create.direct.pay.by.user",
);

$sign_param = array(
    "service" => $config['service'],
    "partner" => $config['partner'],
    "seller_id" => $config['seller_id'],
    "payment_type" => $config['payment_type'],
    "notify_url" => $config['notify_url'],
    "return_url" => $config['return_url'],
    "_input_charset" => $config['input_charset'],
    "out_trade_no" => $param['out_trade_no'],
    "subject" => $param['subject'],
    "total_fee" => $param['total_fee'],
    "show_url" => $param['show_url'],
    "body" => $param['body'],
    "it_b_pay" => $param['timeout_express'],
    "app_pay" => "Y",
);

$apipay_submit = new AlipaySubmit($config);
$pay_html = $apipay_submit->buildRequestForm($sign_param, "GET", "确认");
echo $pay_html;
