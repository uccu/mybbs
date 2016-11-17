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


        $this->_alipay('expert',5000);


    }
    function _alipay($type,$money){

        //$this->_check_login();

        $nonce_str = md5 ( rand ( 1000000, 9999999 ) );

        $out_trade_no = date('YmdHis').rand ( 1000000, 9999999 );
        
        $uid = $this->uid;

        $data['app_id'] = '2016100900647998';//'2016110102468937';
        
        $data['biz_content'] = json_encode(array(
            'buyer_logon_id'=>'kitdrd3141@sandbox.com',
            "out_trade_no"=>$out_trade_no,
            "subject"=>"设备运维支付",
            "total_amount"=>$money
        ));
        $data['charset'] = 'utf-8';
        $data['method'] = 'alipay.trade.create';
        $data['notify_url'] = 'http://121.199.8.244:5000/app/pay/wcpay_c/'.$nonce_str;
        $data['sign_type'] = 'RSA';
        $data['timestamp'] = date('Y-m-d H:i:s');
        $data['version'] = '1.0';
        $_a = '';
        foreach($data as $k=>$v ){
            $query .= $_a.$k.'='.$v;
            $_a = "&";
        }

        $priKey = file_get_contents ( PLAY_ROOT . 'alipay/rsa_private_key.pem' );
        $res = openssl_get_privatekey ( $priKey );
        openssl_sign ( $query, $sign, $res );
        openssl_free_key ( $res );

        $data['sign']  = base64_encode($sign);
        //echo $sign;

        $ch = curl_init ();
        // set URL and other appropriate options
        curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
        curl_setopt ( $ch, CURLOPT_URL, 'https://openapi.alipaydev.com/gateway.do'  /*"https://openapi.alipay.com/gateway.do"*/ );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        $da = curl_exec ( $ch );
        var_dump($da);

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
        $sign .= 'key=6839885DC11C1D03E85357763CD6ABD9';

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