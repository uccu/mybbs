<!DOCTYPE html5>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
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

</head>
<body>
<div class="modal db" style="display:block" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">注册</h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" class="form-control" id="phone" name="invate" >
                    <div class="form-group">
                        <label for="phone">账号</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="手机号">
                    </div>
                    <div class="form-group">
                        <label for="pdw">密码</label>
                        <input type="password" class="form-control" id="pdw" name="pwd" placeholder="密码">
                    </div>
                    <div class="form-group">
                        <label for="pdw">重复密码</label>
                        <input type="password" class="form-control" id="pdw" name="pwd2" placeholder="重复密码">
                    </div>
                        <label for="pdw">验证码</label>
                    <div class="form-group form-inline">
                        <input type="password" class="form-control" id="captcha" name="captcha" placeholder="">
                        <button type="button" class="btn btn-success get_captcha">获取验证码</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p class="help-block"></p>
                <button type="button" class="btn btn-primary register">注册</button>
            </div>
        </div>
    </div>
</div>


<!--{subtemplate tool:footer}-->