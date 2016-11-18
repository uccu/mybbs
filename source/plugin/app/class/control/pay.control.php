<?php
namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class pay extends base\e{
    function _beginning(){
        //$this->_check_login();
    }

    function wcpay_c($nonce_str){
        $postStr = file_get_contents ( 'php://input' );
        $a =  simplexml_load_string ( $postStr );
        //model('cache')->replace('wcpay_1',$a->result_code.'');
        if($a->result_code.'' == 'SUCCESS'){
            $h = 'appid='.$a->appid;
            $h .= '&bank_type='.$a->bank_type;
            $h .= '&cash_fee='.$a->cash_fee;
            $h .= '&fee_type='.$a->fee_type;
            $h .= '&is_subscribe='.$a->is_subscribe;
            $h .= '&mch_id='.$a->mch_id;
            $h .= '&nonce_str='.$nonce_str;
            $h .= '&openid='.$a->openid;
            $h .= '&out_trade_no='.$a->out_trade_no;
            $h .= '&result_code='.$a->result_code;
            $h .= '&return_code='.$a->return_code;
            $h .= '&time_end='.$a->time_end;
            $h .= '&total_fee='.$a->total_fee;
            $h .= '&trade_type='.$a->trade_type;
            $h .= '&transaction_id='.$a->transaction_id;
            $h .= '&key=6839885DC11C1D03E85357763CD6ABD9';
            //model('cache')->replace('wcpay_2',$h);
            if($a->sign.'' === strtoupper ( md5 ( $h ) )){

                $log = model('pay_log')->where(array('out_trade_no'=>$a->out_trade_no.''))->find();

                if(!$log){
                    model('pay_log')->where(array('out_trade_no'=>$a->out_trade_no.''))->data(array('success'=>-2))->save();
                    echo "FAIL";die();
                }
                if($log['success']!=0){
                    die();
                }

                model('pay_log')->where(array('out_trade_no'=>$a->out_trade_no.''))->data(array('success'=>1,'stime'=>TIME_NOW))->save();
                if($log['type']=='inquiry'){

                    model('inquiry_paid')->data(array(
                        'uid'=>$log['uid'],
                        'ctime'=>TIME_NOW,
                        'id'=>$log['gid']
                    ))->add(true);

                }elseif($log['type']=='expert'){

                    model('expert_paid')->data(array(
                        'uid'=>$log['uid'],
                        'ctime'=>TIME_NOW,
                        'id'=>$log['gid']
                    ))->add(true);
                }elseif($log['type']=='paper'){

                    model('paper_paid')->data(array(
                        'uid'=>$log['uid'],
                        'ctime'=>TIME_NOW,
                        'pid'=>$log['gid']
                    ))->add(true);

                }elseif($log['type']=='vip'){

                    $time = $log['gid'];

                    $userInfo = model('user')->find($log['uid']);
                    if($time == 1)$add = 3600*24*30;
                    elseif($time == 2)$add = 3600*24*91;
                    else $add = 3600*24*365;
                    $data['vip_type'] = $time;
                    if($userInfo['vip']>TIME_NOW)$data['vip'] += $add;
                    else $data['vip'] = TIME_NOW + $add;
                    model('user')->data($data)->save($log['uid']);

                }else{

                    echo "FAIL";die();

                }

                echo "SUCCESS";die();
            }

            model('pay_log')->where(array('out_trade_no'=>$a->out_trade_no.''))->data(array('success'=>-1))->save();
        }
        echo "FAIL";



    }
    function alipay_c($nonce_str){

        //file_put_contents ('ALIPAY_SERVER.txt' ,json_encode($_POST) );
        $out_trade_no = $_POST ['out_trade_no'];
        if(post('trade_status')!='TRADE_SUCCESS')return;
        
        $log = model('pay_log')->where(array('out_trade_no'=>$out_trade_no.''))->find();

        if(!$log){
            model('pay_log')->where(array('out_trade_no'=>$a->out_trade_no.''))->data(array('success'=>-2))->save();
            echo "FAIL";die();
        }
        if($log['success']!=0){
            die();
        }
        model('pay_log')->where(array('out_trade_no'=>$a->out_trade_no.''))->data(array('success'=>1,'stime'=>TIME_NOW))->save();
        if($log['type']=='inquiry')
            model('inquiry_paid')->data(array(
                'uid'=>$log['uid'],
                'ctime'=>TIME_NOW,
                'id'=>$log['gid']
            ))->add(true);
        elseif($log['type']=='expert')
            model('expert_paid')->data(array(
                'uid'=>$log['uid'],
                'ctime'=>TIME_NOW,
                'id'=>$log['gid']
            ))->add(true);
        elseif($log['type']=='paper')
            model('paper_paid')->data(array(
                'uid'=>$log['uid'],
                'ctime'=>TIME_NOW,
                'pid'=>$log['gid']
            ))->add(true);
        elseif($log['type']=='vip'){
            $time = $log['gid'];
            $userInfo = model('user')->find($log['uid']);
            if($time == 1)$add = 3600*24*30;
            elseif($time == 2)$add = 3600*24*91;
            else $add = 3600*24*365;
            $data['vip_type'] = $time;
            if($userInfo['vip']>TIME_NOW)$data['vip'] += $add;
            else $data['vip'] = TIME_NOW + $add;
            model('user')->data($data)->save($log['uid']);
        }else{
            return;
    
        }
            

        echo "SUCCESS";die();



    }


    function __wcpay($type,$money,$gid,$return = false){

        $data['prepay_id'] = $this->_wcpay($type,1,$gid);
        
        if($return)return $data;

        $this->success($data);

    }



    function alipay(){


        $data = $this->_alipay('expert',0.01,1);

        $this->success($data);

    }
    function _alipay($type,$money,$gid){

        $nonce_str = md5 ( rand ( 1000000, 9999999 ) );

        $out_trade_no = date('YmdHis').rand ( 1000000, 9999999 );
        
        $uid = $this->uid;

        $p['partner']           = '2088521069857975';       // 签约的支付宝账号对应的支付宝唯一用户号
        $p['seller_id']         = 'qingcesh@163.com';  // 签约卖家支付宝账号
        $p['out_trade_no']      = $out_trade_no;          // 商户网站唯一订单号
        $p['subject']           = '运维卫士支付';          // 商品名称
        $p['body']              = '运维卫士支付';             // 商品详情
        $p['total_fee']         = $money;             // 商品金额
        $p['notify_url']        = 'http://121.199.8.244:5000/app/pay/alipay_c/'.$nonce_str;// 服务器异步通知页面路径
        $p['service']           = 'mobile.securitypay.pay'; // 服务接口名称， 固定值
        $p['payment_type']      = '1';                      // 支付类型， 固定值
        $p['_input_charset']    = 'utf-8';                  // 参数编码， 固定值
        $p['it_b_pay']          = '30m';                    // 设置未付款交易的超时时间
        

        $info = array();
        foreach($p as $k=>$v)$info[] = $k.'="'.$v.'"';
        $info = implode('&',$info);
        $priKey = file_get_contents ( PLAY_ROOT . 'alipay/rsa_private_key.pem' );
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
        $data2['string'] = $info;
        $data2['array'] = $p;

        $data['uid'] = $uid;
        $data['ctime'] = TIME_NOW;
        $data['nonce_str'] = $nonce_str;
        $data['type'] = $type;
        $data['gid'] = $gid;
        $data['total_fee'] = $money*100;
        $data['out_trade_no'] = $out_trade_no;
        $data['pay_type'] = 'alipay';
        $data['prepay_success'] = 1;
        model('pay_log')->data($data)->add();


        return $data2;
    }
    function _alipay2($type,$money,$id){

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

    function _wcpay($type,$money,$gid){
        $this->_check_login();

        $nonce_str = md5 ( rand ( 1000000, 9999999 ) );

        $out_trade_no = date('YmdHis').rand ( 1000000, 9999999 );
        
        $uid = $this->uid;

        $array = array (
            'appid'             => 'wx74ee35941bdfb302',
            'body'              => '运维卫士支付',
            'mch_id'            => '1406390402',
            'nonce_str'         => $nonce_str,
            'notify_url'        => 'http://121.199.8.244:5000/app/pay/wcpay_c/'.$nonce_str,
            'out_trade_no'      => $out_trade_no,
            'spbill_create_ip'  => $_SERVER ["REMOTE_ADDR"],
            'total_fee'         => $money,              //单位分
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

        $data['uid'] = $uid;
        $data['ctime'] = TIME_NOW;
        $data['nonce_str'] = $nonce_str;
        $data['type'] = $type;
        $data['gid'] = $gid;
        $data['total_fee'] = $money;
        $data['out_trade_no'] = $out_trade_no;
        $data['pay_type'] = 'wcpay';
        

        if(!$da){
            $data['error'] = '微信服务器访问超时/无法访问';
            model('pay_log')->data($data)->add();
            $this->errorCode(501);
        }
        $result = simplexml_load_string ( $da );

        //var_dump($result);

        if($result->return_code.'' == 'FAIL'){
            $data['error'] = '微信通信失败';
            model('pay_log')->data($data)->add();
            $this->errorCode(502);
        }
        if($result->result_code.'' == 'FAIL'){
            $data['error'] = '微信预支付交易失败';
            model('pay_log')->data($data)->add();
            $this->errorCode(503);
        }
        $data['prepay_id'] = $result->prepay_id.'';
        $data['prepay_success'] = 1;
        model('pay_log')->data($data)->add();

        return $data['prepay_id'];
    }
    


}
?>