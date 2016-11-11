<?php
namespace plugin\tool\control;
defined('IN_PLAY') || exit('Access Denied');
class pay extends \control\ajax{



    function _alipay($d){
        $p['partner']           = '2088421747319415';       // 签约的支付宝账号对应的支付宝唯一用户号
        $p['seller_id']         = 'leshangbuluo@sina.com';  // 签约卖家支付宝账号
        $p['out_trade_no']      = $d['pay_id'];          // 商户网站唯一订单号
        $p['subject']           = '购买乐商部落商品';          // 商品名称
        $p['body']              = '乐商部落商品';             // 商品详情
        $p['total_fee']         = $d['money']  ;             // 商品金额
        $p['notify_url']        = 'http://www.leshangbuluo.com/app/item/alipay_c';// 服务器异步通知页面路径
        $p['service']           = 'mobile.securitypay.pay'; // 服务接口名称， 固定值
        $p['payment_type']      = '1';                      // 支付类型， 固定值
        $p['_input_charset']    = 'utf-8';                  // 参数编码， 固定值
        $p['it_b_pay']          = '30m';                    // 设置未付款交易的超时时间
        //$p['return_url']        = 'baka';                   // 支付宝处理完请求后，当前页面跳转到商户指定页面的路径，可空

        $info = array();
        foreach($p as $k=>$v)$info[] = $k.'="'.$v.'"';
        $info = implode('&',$info);
        $priKey = file_get_contents ( PLAY_ROOT . '.ssh/rsa_private_key.pem' );
        $res = openssl_get_privatekey ( $priKey );
        openssl_sign ( $info, $sign, $res );
        openssl_free_key ( $res );
        // base64编码
        $sign = base64_encode ( $sign );
        $sign = urlencode ( $sign );
        // 执行签名函数
        $info .= "&sign=\"" . $sign . "\"";
        $p['sign'] = $sign;

        $info .= "&sign_type=\"RSA\"";
        $p['sign_type'] = "RSA";
        $data['string'] = $info;
        $data['array'] = $p;
        return $data;
    }  
    function _wcpay($d){
        $array = array (
            'appid'             => 'wx6257377cf020d6e7',
            'body'              => '乐商部落商品',
            'mch_id'            => '1392240002',
            'nonce_str'         => md5 ( rand ( 1000000, 9999999 ) ),
            'notify_url'        => 'http://www.leshangbuluo.com/app/item/wcpay_c',
            'out_trade_no'      => $d['pay_id'],
            'spbill_create_ip'  => $_SERVER ["REMOTE_ADDR"],
            'total_fee'         => $d['money']*100 ,              //单位分
            'trade_type'        => 'APP' 
        );
        $xml = '<xml>';
        $sign = '';
        foreach ( $array as $key => $val ) {
            $sign .= trim ( $key ) . "=" . trim ( $val ) . "&";
            $xml .= "<" . trim ( $key ) . ">" . trim ( $val ) . "</" . trim ( $key ) . ">";
        }
        $sign .= 'key=7EA97FA5C1534CD91FE666690A60E927';
        // echo $sign;
        $sign = strtoupper ( md5 ( $sign ) );
        $xml .= "<sign>$sign</sign>";
        $xml .= '</xml>';
        // echo $xml;
        $ch = curl_init ();
        // set URL and other appropriate options
        curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
        curl_setopt ( $ch, CURLOPT_URL, "https://api.mch.weixin.qq.com/pay/unifiedorder" );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $xml );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        // grab URL, and print
        $data = curl_exec ( $ch );
        //var_dump($data);
        $result = simplexml_load_string ( $data );
        $json = $array;
        $json ['result'] = $result->err_code . '';
        $json ['prepayid'] = $result->prepay_id . '';
        $json ['codeurl'] = $result->code_url . '';
        return $json;
    }


}
?>
