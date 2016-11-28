<?php
/**
 * Created by PhpStorm.
 * User: ZhuXueSong
 * Date: 2016/10/17
 * Time: 下午1:39
 */

header("Content-type:text/html; charset=utf-8");
require("common.php");
require('weiXinLogin.class.php');
$code = $_GET['code'];
if (!$code) {
    header("Location:index.html");
}
if($code == $_SESSION['LG_WX_code']){
    header("Location:" . $_SESSION['firstUrl']);
    exit(0);
}
$_SESSION['LG_WX_code'] = $code;
//实例化微信接口
$weixin = new weiXinLogin();
//获取openid和access_token
$auth_info = $weixin->get_auth_info($code);
//获取用户信息
$user_info = $weixin->get_user_info($auth_info['openid']);
$_SESSION['user_openid'] = $user_info['openid'];
$_SESSION['unionid'] = $user_info['unionid'];

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta id="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"
          name="viewport">
    <meta name="apple-themes-web-app-capable" content="yes">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <meta content="email=no" name="format-detection">
    <meta name="format-detection" content="telephone=no">
    <title></title>
    <link rel="stylesheet" href="css/main.css" type="text/css" media="all">
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript">
        var is_weiLogin = true;
    </script>
    <script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript">

    var param = get_param();
    if(param.type == undefined || param.type == null || param.type == ""){
        param.type = sessionStorage.getItem("LG_type") ? sessionStorage.getItem("LG_type") : 0;
    }
    if(param.uid == undefined || param.uid == null || param.uid == ""){
        param.uid = sessionStorage.getItem("LG_parent_id") ? sessionStorage.getItem("LG_parent_id") : 1;
    }

    var headerImg = '<?php echo urlencode($user_info['headimgurl']); ?>';
    //getWeiXinHeader();
	requestData("app/in/login_third", {key: "<?php echo $auth_info['unionid']; ?>", platform: "wx"}, function (data) {
		if (data.code == 200) {
			data = data.data;
			if (data.new != 1) {
				var userObject = {"user_token": data.user_token, "uid": data.uid};
				sessionStorage.setItem("LG_User", JSON.stringify(userObject));
				redirect("<?php echo $_SESSION['firstUrl']; ?>");
			}else{
				//绑定手机号
				//alert("绑定手机号");
				$("#bind_mobile_body").removeClass("hidden");
			}
		} else {
			show_alert(data.desc);
		}
	});

    /**
     * 获取验证码
     */
    function getVerify(obj) {
        var object = $(obj);
        if (object.hasClass("no-click")) {
            return false;
        }
        var mobile = tirm($("#login_mobile").val());
        if (mobile.length != 11) {
            show_alert("请输入正确的手机号");
            return false;
        }
        requestData("tool/captcha/get_captcha", {phone: mobile}, function (json) {
            if (json.code == 200) {
                show_alert("发送成功");
                _new = json.data.new;

                var i = 60;
                $(".common-input .btn").html(i + " s");
                object.addClass("no-click");
                var x = setInterval(function () {
                    i--;
                    if (i < 0) {
                        clearInterval(x);
                        $(".common-input .btn").html("获取验证码");
                        object.removeClass("no-click");
                        return false;
                    }
                    $(".common-input .btn").html(i + " s");
                }, 1000);
            }
        });
    }

    /**
     * 绑定手机号
     */
    function bindMobileFunction(obj) {
        if($(obj).hasClass("no-click")){
            return false;
        }
        var mobile = tirm($("#login_mobile").val());
        if(mobile.length != 11){
            show_alert("请输入正确的手机号");
            return false;
        }
        var verify = $("#login_verify").val();
        if(verify == ""){
            show_alert("请输入验证码");
            return false;
        }
        var password = $("#login_password").val();
        if(password == ""){
            show_alert("请输入登录密码");
            return false;
        }
        requestData("app/in/add_account", {key: "<?php echo $auth_info['unionid']; ?>", platform: "wx", terminal: "pc", captcha: verify, phone: mobile, referee: param.uid, password:password}, function(data){
            if(data.code == 200){
                data = data.data;
                var userObject = {"user_token": data.user_token, "uid": data.uid};
                sessionStorage.setItem("LG_User", JSON.stringify(userObject));
                if(data.new == 1){
                    updateUserInfo(data.user_token);
                } else {
                    redirect("<?php echo $_SESSION['firstUrl']; ?>", true);
                }
            } else {
                show_alert(data.desc);
            }
        });
    }

    /**
     * 更新用户信息
     * @param token
     */
    function updateUserInfo(token) {
        var loading_html = '<div class="alert_dialog loading_dialog" style="position:fixed;top:0;left:0;height:100%;width:100%;z-index:999; background:rgba(0,0,0,0.3);"><div class="show_alert" style="background:transparent; padding: 0; border-radius: 0.1rem; overflow: hidden; box-shadow: none;"><img src="images/loading.gif" style="height:0.8rem; width:0.8rem; display:block; margin:0 auto;"/></div></div>';
        $("body").append(loading_html);
        $(".reg-next-btn").addClass("no-click").css("background-color", "#BCBCBC");
        $.ajax({
            type: "POST",
            url: config._host + "Upload/upload_user_news",
            data: "user_token="+token+"&username=<?php echo $user_info['nickname'] ?>&sex=<?php echo $user_info['sex'] ?>&file_name="+headerImg,
            dataType: "jsonp",
            jsonp: "callback",
            success : function(json){
                $(".loading_dialog").remove();
                show_alert("绑定成功", "", "<?php echo $_SESSION['firstUrl']; ?>");
                //if(json.code == 200){
                //    redirect("<?php echo $_SESSION['firstUrl']; ?>", true);
                //} else {
                //    show_alert(data.desc);
                //}
            },
            error : function(XMLHttpRequest){
                $(".loading_dialog").remove();
                //console.log(XMLHttpRequest);
                show_alert('请检查网络');
            }
        });
    }
</script>
</head>
<body>

<div id="bind_mobile_body" class="hidden">
    <header>
        <div class="head-left"></div>
        <div class="head-center">绑定手机号</div>
        <div class="head-right"></div>
    </header>
    <div class="head"></div>
    <div class="common-input">
        <div class="common-input-name">手机号：</div>
        <input type="number" class="common-input-text" id="login_mobile" placeholder="请输入手机号"/>
    </div>
    <div class="common-input">
        <div class="common-input-name">验证码：</div>
        <input type="number" class="common-input-text" id="login_verify" placeholder="请输入验证码" style="width: 3rem;"/>
        <span class="btn" onclick="getVerify(this);">获取验证码</span>
    </div>
    <div class="common-input">
        <div class="common-input-name">密码：</div>
        <input type="text" class="common-input-text" id="login_password" placeholder="请输入登录密码"/>
    </div>
    <span class="btn reg-next-btn" onclick="bindMobileFunction(this);">绑 定</span>
</div>
</body>
</html>