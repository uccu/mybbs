<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class pay extends base\e{
    function _beginning(){
        //$this->_check_login();
    }

    function wcpay_c($nonce_str){





    }
    function alipay_c(){





    }


    function wcpay(){


        $this->_wcpay('expert',1);


    }

    function alipay(){


        $this->_alipay('expert',1);


    }
    function _alipay($type,$money){
        require_once PLAY_ROOT.'alipay/aop/AopClient.php';
        require_once PLAY_ROOT.'alipay/aop/request/AlipayTradeCreateRequest.php';
        $aop = new \AopClient ();
        $aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
        $aop->appId = '2016100900647998';
        $aop->rsaPrivateKeyFilePath = PLAY_ROOT.'alipay/rsa_private_key.pem';
        $aop->alipayPublicKey= PLAY_ROOT.'alipay/alipay_public_key.pem';
        $aop->apiVersion = '1.0';
        $aop->postCharset='UTF-8';
        $aop->format='json';
        $request = new \AlipayTradeCreateRequest ();
        $request->setBizContent("{" .
        "    \"out_trade_no\":\"20150320010101001\"," .
        "    \"seller_id\":\"2088102146225135\"," .
        "    \"total_amount\":88.88," .
        "    \"discountable_amount\":8.88," .
        "    \"undiscountable_amount\":80.00," .
        "    \"buyer_logon_id\":\"15901825620\"," .
        "    \"subject\":\"Iphone6 16G\"," .
        "    \"body\":\"Iphone6 16G\"," .
        "    \"buyer_id\":\"2088102146225135\"," .
        "      \"goods_detail\":[{" .
        "                \"goods_id\":\"apple-01\"," .
        "        \"alipay_goods_id\":\"20010001\"," .
        "        \"goods_name\":\"ipad\"," .
        "        \"quantity\":1," .
        "        \"price\":2000," .
        "        \"goods_category\":\"34543238\"," .
        "        \"body\":\"特价手机\"," .
        "        \"show_url\":\"http://www.alipay.com/xxx.jpg\"" .
        "        }]," .
        "    \"operator_id\":\"Yx_001\"," .
        "    \"store_id\":\"NJ_001\"," .
        "    \"terminal_id\":\"NJ_T_001\"," .
        "    \"extend_params\":{" .
        "      \"sys_service_provider_id\":\"2088511833207846\"," .
        "      \"hb_fq_num\":\"3\"," .
        "      \"hb_fq_seller_percent\":\"100\"" .
        "    }," .
        "    \"timeout_express\":\"90m\"," .
        "    \"royalty_info\":{" .
        "      \"royalty_type\":\"ROYALTY\"," .
        "        \"royalty_detail_infos\":[{" .
        "                    \"serial_no\":1," .
        "          \"trans_in_type\":\"userId\"," .
        "          \"batch_no\":\"123\"," .
        "          \"out_relation_id\":\"20131124001\"," .
        "          \"trans_out_type\":\"userId\"," .
        "          \"trans_out\":\"2088101126765726\"," .
        "          \"trans_in\":\"2088101126708402\"," .
        "          \"amount\":0.1," .
        "          \"desc\":\"分账测试1\"," .
        "          \"amount_percentage\":\"100\"" .
        "          }]" .
        "    }," .
        "    \"alipay_store_id\":\"2016041400077000000003314986\"," .
        "    \"sub_merchant\":{" .
        "      \"merchant_id\":\"19023454\"" .
        "    }" .
        "  }");
        var_dump("{" .
        "    \"out_trade_no\":\"20150320010101001\"," .
        "    \"seller_id\":\"2088102146225135\"," .
        "    \"total_amount\":88.88," .
        "    \"discountable_amount\":8.88," .
        "    \"undiscountable_amount\":80.00," .
        "    \"buyer_logon_id\":\"15901825620\"," .
        "    \"subject\":\"Iphone6 16G\"," .
        "    \"body\":\"Iphone6 16G\"," .
        "    \"buyer_id\":\"2088102146225135\"," .
        "      \"goods_detail\":[{" .
        "                \"goods_id\":\"apple-01\"," .
        "        \"alipay_goods_id\":\"20010001\"," .
        "        \"goods_name\":\"ipad\"," .
        "        \"quantity\":1," .
        "        \"price\":2000," .
        "        \"goods_category\":\"34543238\"," .
        "        \"body\":\"特价手机\"," .
        "        \"show_url\":\"http://www.alipay.com/xxx.jpg\"" .
        "        }]," .
        "    \"operator_id\":\"Yx_001\"," .
        "    \"store_id\":\"NJ_001\"," .
        "    \"terminal_id\":\"NJ_T_001\"," .
        "    \"extend_params\":{" .
        "      \"sys_service_provider_id\":\"2088511833207846\"," .
        "      \"hb_fq_num\":\"3\"," .
        "      \"hb_fq_seller_percent\":\"100\"" .
        "    }," .
        "    \"timeout_express\":\"90m\"," .
        "    \"royalty_info\":{" .
        "      \"royalty_type\":\"ROYALTY\"," .
        "        \"royalty_detail_infos\":[{" .
        "                    \"serial_no\":1," .
        "          \"trans_in_type\":\"userId\"," .
        "          \"batch_no\":\"123\"," .
        "          \"out_relation_id\":\"20131124001\"," .
        "          \"trans_out_type\":\"userId\"," .
        "          \"trans_out\":\"2088101126765726\"," .
        "          \"trans_in\":\"2088101126708402\"," .
        "          \"amount\":0.1," .
        "          \"desc\":\"分账测试1\"," .
        "          \"amount_percentage\":\"100\"" .
        "          }]" .
        "    }," .
        "    \"alipay_store_id\":\"2016041400077000000003314986\"," .
        "    \"sub_merchant\":{" .
        "      \"merchant_id\":\"19023454\"" .
        "    }" .
        "  }");die();
        $result = $aop->execute ( $request); 
        
        $responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
        $resultCode = $result->$responseNode->code;
        if(!empty($resultCode)&&$resultCode == 10000){
        echo "成功";
        } else {
        echo "失败";
        }

    }

    function _wcpay($type,$money){
        $this->_check_login();

        $nonce_str = md5 ( rand ( 1000000, 9999999 ) );

        $out_trade_no = date('YmdHis').rand ( 1000000, 9999999 );
        
        $uid = $this->uid;

        $array = array (
            'appid'             => 'wx74ee35941bdfb302',
            'body'              => '设备运维支付',
            'mch_id'            => '1406390402',
            'nonce_str'         => $nonce_str,
            'notify_url'        => 'http://121.199.8.244:5000/app/pay/wcpay_c/'.$rand,
            'out_trade_no'      => $out_trade_no,
            'spbill_create_ip'  => $_SERVER ["REMOTE_ADDR"],
            'total_fee'         => $money_f,              //单位分
            'trade_type'        => 'APP' 
        );
        $xml = '<xml>';
        $sign = '';
        foreach ( $array as $key => $val ) {
            $sign .= trim ( $key ) . "=" . trim ( $val ) . "&";
            $xml .= "<" . trim ( $key ) . ">" . trim ( $val ) . "</" . trim ( $key ) . ">";
        }
        $sign .= 'key=7EA97FA5C1534CD91FE666690A60E927';

        $sign = strtoupper ( md5 ( $sign ) );
        $xml .= "<sign>$sign</sign>";
        $xml .= '</xml>';

        $ch = curl_init ();
        // set URL and other appropriate options
        curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
        curl_setopt ( $ch, CURLOPT_URL, "https://api.mch.weixin.qq.com/pay/unifiedorder" );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $xml );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        // grab URL, and print
        $da = curl_exec ( $ch );
        var_dump($da);
        $data['uid'] = $uid;
        $data['ctime'] = TIME_NOW;
        $data['nonce_str'] = $nonce_str;
        $data['type'] = $type;

        $data['total_fee'] = $money;
        $data['	out_trade_no'] = $out_trade_no;
        $data['pay_type'] = 'wcpay';

        if(!$da){
            $data['error'] = '微信服务器访问超时/无法访问';
            model('pay_log')->data($data)->add();
            $this->errorCode(501);
        }
        $result = simplexml_load_string ( $da );

        if($result->return_code == 'FAIL'){
            $data['error'] = '微信通信失败';
            model('pay_log')->data($data)->add();
            $this->errorCode(502);
        }
        if($result->result_code == 'FAIL'){
            $data['error'] = '微信预支付交易失败';
            model('pay_log')->data($data)->add();
            $this->errorCode(503);
        }
        $data['prepay_success'] = 1;
        model('pay_log')->data($data)->add();

        return $result;
    }
    


}
?>