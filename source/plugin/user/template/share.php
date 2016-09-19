<!DOCTYPE html5>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta id="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
<meta name="apple-themes-web-app-capable" content="yes">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="telephone=no" name="format-detection">
<meta content="email=no" name="format-detection">
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="{g.template.keywords}">
<meta name="description" content="{g.template.description}">
<title>{g.template.title}</title>
<base href="{g.template.baseurl}">
<link rel="stylesheet" href="//apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css">
<!--{eval addcss('m',0,'tool')}-->
<script src="//apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js" type="text/javascript"></script>

<script src="//apps.bdimg.com/libs/jquery-lazyload/1.9.5/jquery.lazyload.min.js" type="text/javascript"></script>
<script src="//apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script>
<script>window.j=jQuery.noConflict();</script>
<!--{eval addjs('p',0,'tool')}-->
<!--{eval addjs('p2')}-->
<style>
input.form-control{
    border:none;border-bottom:1px solid #ccc;box-shadow:none;outline:0
}
input.form-control:hover,input.form-control:focus{
    box-shadow:none;border-bottom:1px solid #F586A1;
}
button.get_captcha{
    right:0;background:#fff;color:#F586A1;bottom:5px;border:1px solid #F586A1;padding-left:30px;padding-right:30px;
}
button.get_captcha:hover,button.get_captcha:focus{
    background:#F586A1;color:#fff;border:1px solid #F586A1
}
label{
    color:#ccc
}
button.register{
    background:#F586A1;color:#fff;outline:0;box-shadow:none;border:none
}
button.register:hover,button.register:focus{
    background:#F586A1;color:#fff;outline:0;box-shadow:none;border:none
}
.help-block{
    color:#F586A1;
}
</style>
</head>
<body>
<div class="container tc" style="padding:40px 0;">
<img src="/pic/register_03.jpg" class="img-responsive center-block" style="width:33%">
</div>
<div class="container">
                <form>
                    <input type="hidden" class="form-control" id="phone" name="invate" >
                        
                    <div class="form-group pr">
                        <label for="phone">账号</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="请输入手机号">
                        <button type="button" class="t pa btn btn-success get_captcha">获取验证码</button>
                    </div>
                    <div class="form-group">
                        <label for="pdw">验证码</label>
                        <input type="text" class="form-control" id="captcha" name="captcha" placeholder="请输入验证码">
                    </div>
                    <div class="form-group">
                        <label for="pdw">密码</label>
                        <input type="password" class="form-control" id="pdw" name="pwd" placeholder="请输入6~16位字符密码">
                    </div>
                </form>
</div>
            <div class="container">
                <p class="help-block tc">　</p>
                <button type="button" class="btn btn-primary register btn-lg btn-block">注册</button>
            </div>



<!--{subtemplate tool:footer}-->