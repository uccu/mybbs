<?php

/**
 * Created by PhpStorm.
 * User: ZhuXueSong
 * Date: 2016/10/17
 * Time: 下午1:23
 */
class weiXinLogin
{
    private $appId = null;
    private $appSecret = null;
    private $redirect_uri = null;

    public function __construct()
    {
        /*$this->appId = "wx6c5ad3f9c596ffac";
        $this->appSecret = "fe57a3c7591299b846950891559152d9";*/
        $this->appId = "wxd9454f19394d5949";
        $this->appSecret = "78e2dab5b9824a3a690ac942a36b8763";
        $this->redirect_uri = urlencode("http://www.leshangbuluo.com/s/login_return.php");

    }

    /**
     * 获取code,跳转回调地址
     */
    public function get_code()
    {
        //$url = 'https://open.weixin.qq.com/connect/qrconnect?appid=' . $this->appId . '&redirect_uri=' . $this->redirect_uri . '&response_type=code&scope=snsapi_login&state=' . md5("LSBl") . '#wechat_redirect';
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->appId.'&redirect_uri=' . $this->redirect_uri . '&response_type=code&scope=snsapi_userinfo&state=123&connect_redirect=1#wechat_redirect';
        header("Location:" . $url);
    }

    /**
     * 获取openid和access_token
     * @param string $code
     * @return array
     */
    public function get_auth_info($code)
    {
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this->appId . '&secret=' . $this->appSecret . '&code=' . $code . '&grant_type=authorization_code';
        $token = @$this->request_post($url);
        $token = json_decode($token, true);
        $return_arr = array(
            "openid" => $token["openid"],
            "access_token" => $token["access_token"],
            "unionid" => $token['unionid']
        );
        return $return_arr;
    }

    /**
     * 获取用户详细信息
     * @param $openid
     * @return mixed
     */
    public function get_user_info($openid)
    {
        //获取access_token
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $this->appId . '&secret=' . $this->appSecret;
        $result = json_decode($this->request_post($url), true);
        //获取用户信息
        $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=' . $result["access_token"] . '&openid=' . $openid . '&lang=zh_CN';
        $info = json_decode($this->request_post($url), true);
        return $info;
    }

    /**
     * curl请求
     * @param string $url
     * @param array $data
     * @return mixed
     */
    private function request_post($url, $data = array())
    {
        //初始化
        $ch = curl_init();
        $header = array("content-type: application/x-www-form-urlencoded;charset=UTF-8");
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $temp = curl_exec($ch);
        return $temp;
    }
}

?>