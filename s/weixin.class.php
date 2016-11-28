<?php
/**
 * 微信登录接口
 * @author ZHUXUESONG
 *
 */
class weixinapi{
	private $appid = null;
	private $appsecret = null;
    private $redirect_uri = null;
	
	public function __construct(){
		$this->appid = "wxd9454f19394d5949";
		$this->appsecret = "78e2dab5b9824a3a690ac942a36b8763";
        $this->redirect_uri = "http://www.leshangbuluo.com/s/weixin_return.php";

	}
	
	/**
	 * 获取code,跳转回调地址
	 */
	public function get_code(){
		$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->appid.'&redirect_uri=' . $this->redirect_uri . '&response_type=code&scope=snsapi_userinfo&state=123&connect_redirect=1#wechat_redirect';
		header("Location:".$url);
	}
	
	/**
	 * 获取openid和access_token
	 * @param string $code
	 * @return array
	 */
	public function get_auth_info($code){
		$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->appid.'&secret='.$this->appsecret.'&code='.$code.'&grant_type=authorization_code';
		$token = @$this->request_post($url);
		$token = json_decode($token, true);
		$return_arr = array(
			"openid" => $token["openid"],
			//"access_token" => $token["access_token"]
		);
		return $return_arr;
	}
	
// 	/**
// 	 * 获取用户信息
// 	 * @param string $openid
// 	 * @param string $access_token
// 	 * @return array
// 	 */
// 	public function get_user_info($openid, $access_token){
// 		//https://api.weixin.qq.com/cgi-bin/user/info?access_token=ACCESS_TOKEN&openid=OPENID&lang=zh_CN
// 		$info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
// 		//$info_url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
// 		//$info = json_decode(@$this->request_post($info_url), true);
// 		$info = $this->request_post($info_url);
// 		//exit($info);
// 		$data['openid'] = $info["openid"];
// 		$data['sex'] = $info["sex"];
// 		$data['name'] = $info["nickname"];
// 		$data['image'] = $info["headimgurl"];
// 		//$data['subscribe'] = $info["subscribe"];
		
// 		return $data;
// 	}
	
	
	public function get_user_info($openid){
		//获取access_token
		$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appid.'&secret='.$this->appsecret;
		$result = json_decode($this->request_post($url), true);
		//获取用户信息
		$url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$result["access_token"].'&openid='.$openid.'&lang=zh_CN';
		$info = json_decode($this->request_post($url), true);
		return $info;
	}
	
	/**
	 * curl请求
	 * @param string $url
     * @param array $data
	 * @return mixed
	 */
	private function request_post($url, $data = array()) {
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