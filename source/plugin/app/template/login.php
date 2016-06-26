<!--{subtemplate tool:header}-->
<style>
body{}
.back{z-index:-1;background-size:cover;top:0;left:0;width:100%;height:100%}
.lo{z-index:2;padding-top:200px}
.lo>div{
    width:400px;background:#f0f0f0;border-radius:5px;box-shadow: 0 0 100px;top:0
}
.lo h3{font-weight:normal;padding:40px 0 20px 0;margin-top:0}
input.form-control{border-radius:0;height:50px;color:#ccc}
input.form-control:focus{color:#555;z-index:13}
.lo span:first-child{
    right:16px;top:10px
}
.show_alert_box{top:0;left:0;opacity:0;display:table;position: fixed;z-index:20;width: 100%;height: 100%;background-color:rgba(0,0,0,0.5)}
.show_alert_box>div{display: table-cell;vertical-align: middle;text-align: center}
.show_alert_box>div>span{font-size: 20px;position:relative;padding:30px 70px 30px 100px;z-index: 21;background-color: #FFF;border-radius: 5px;border: #f8f8f8 solid 2px;}
.show_alert_box>div>span::before{content:'';background-image:url(/images/dg_03.png);position:absolute;width:48px;height:48px;top:16px;left:40px}
</style>
<script>
function show_alert(status,words,f){
    var d = '<div class="show_alert_box"><div><span>'+words+'</span></div></div>';
    j('body').append(d);
    j('.show_alert_box').animate({'opacity':1}).one('click',function(){
        j(this).fadeOut(function(){j(this).remove();if(f)f(this)})
    })
}
j(function($){
    var r = 0,l=$('.back').length,t=function(){
        $('.back').eq(r).fadeOut(1000);
        if(r==l-1)r=0;else r++;
        $('.back').eq(r).fadeIn(1000);
        setTimeout(t,10000);
    };
    $('.back').eq(0).fadeIn(1000);
    $('.lo').fadeIn(1000);
    setTimeout(t,10000);
    $('[name=pwd],[name=pwd2]').on({focus:function(){
        if (this.value ==j(this).attr('data-value')){
            $(this).attr('type','password');
            this.value =''
        }
    },blur:function(){
        if (this.value ==''){
            $(this).attr('type','text');
            this.value=j(this).attr('data-value')
        }
    }});
    $('.toRegister').click(function(){
        $('.los').slideUp();$('.los2').slideDown()
    });
    $('.los2 .toLogin').click(function(){
        $('.los2').slideUp(); $('.los').slideDown()
    });
    $('.toForgot').click(function(){
        $('.los').slideUp();$('.los3').slideDown()
    });
    $('.los3 .toLogin').click(function(){
        $('.los3').slideUp(); $('.los').slideDown()
    });
    
});

</script>
<!--{loop $list $p}-->
<div class="back pa dn" style="background-image:url(/pic/{p.pic}.jpg)"></div>
<!--{/loop}-->
<div class="container lo text-center dn">

    <!-- 登录  -->
    <div class="center-block pr los">
        <a onclick="j('.los').fadeOut()"><span class="pa cp" aria-hidden="true">×</span></a>
        <h3 class="">登录</h3>
        <form id="loginForm">
            <div class="form-group" style="padding:5px 20px 0 20px">
                <input class="form-control pr t" type="text" name="phone" value="请输入您的手机号" onfocus="if (value =='请输入您的手机号'){value =''}" onblur="if (value ==''){value='请输入您的手机号'}">
                <input class="form-control pr t" type="text" name="pwd" data-value="6-16位密码，区分大小写" value="6-16位密码，区分大小写" style="top:-1px">
                
            </div>
        </form>
        <p class="text-left cp toForgot" style="padding:0 20px"><a><strong style="color:#999">忘记密码</strong></a>
        <label class="fr cp"><small class="login_error" style="color:red"></small></label></p>
        <div style="padding:0 20px">
            <button class="login t btn btn-default btn-lg btn-block" style="background-color:#61bac0;outline:0;color:#fff">登录</button>
            <script>
            j('button.login').click(function(){
                if(j('#loginForm [name=phone]').val()=='请输入您的手机号'){
                    j('.login_error').text('手机号不能为空哦~');return
                }
                j.post('app/login/login',j('#loginForm').serializeArray(),function(d){
                    if(d.code==200){
                        show_alert(1,'登录成功',function(){location.reload(true);})
                    }else j('.login_error').text(d.desc);
                },'json')
            })
            
        </script>
        </div>
        <div style="padding:4px 20px 60px 20px;height:30px">
            <label class="fl cp"><input type="checkbox"/><small style="color:#ccc">记住密码</small></label>
            <label class="fr cp"><small class="toRegister" style="color:#999">去注册</small></label>
            
        </div>
    </div>

    <!-- 注册  -->
    <div class="center-block pr los2 dn">
        <a class="toLogin"><span class="pa cp" aria-hidden="true">×</span></a>
        <h3 class="">注册</h3>
        
        <form id="registerForm">
            <div class="form-group" style="padding:5px 20px 0 20px">
                <input class="form-control pr t" type="text" name="phone" value="请输入您的手机号" onfocus="if (value =='请输入您的手机号'){value =''}" onblur="if (value ==''){value='请输入您的手机号'}">
                <input class="form-control pr t" type="text" name="pwd" data-value="6-16位密码，区分大小写" value="6-16位密码，区分大小写" style="top:-1px">
                <input class="form-control pr t" type="text" name="pwd2" data-value="请确认新密码" value="请确认新密码" style="top:-2px">
            </div>
        </form>
        
        <div style="padding:0 20px">
            <button class="register t btn btn-default btn-lg btn-block" style="background-color:#61bac0;outline:0;color:#fff">注册</button>
            <script>
            j('button.register').click(function(){
                if(j('#registerForm [name=pwd]').val()!=j('#registerForm [name=pwd2]').val()){j('.register_error').text('2次密码不同');return}
                j.post('app/login/register',j('#registerForm').serializeArray(),function(d){
                    if(d.code==200){
                        show_alert(1,'注册成功，可以登录了哟~',function(){location.reload(true);})
                    }else j('.register_error').text(d.desc);
                },'json')
            })
            
        </script>
        </div>
        <div style="padding:4px 20px 60px 20px;height:30px">
            <label class="fl cp"><small class="toLogin" style="color:#999">已有账号</small></label>
            <label class="fr cp"><small class="register_error" style="color:red"></small></label>
        </div>
    </div>
    <!-- 忘记密码  -->
    <div class="center-block pr los3 dn">
        <a class="toLogin"><span class="pa cp" aria-hidden="true">×</span></a>
        <h3 class="">忘记密码</h3>
        
        
            <div class="form-group" style="padding:5px 20px 0 20px">
                <form id="forgotForm">
                <input class="form-control pr t" type="text" name="phone" value="请输入您的手机号" onfocus="if (value =='请输入您的手机号'){value =''}" onblur="if (value ==''){value='请输入您的手机号'}">
                <input class="form-control pr t" type="text" name="captcha" value="请输入验证码" onfocus="if (value =='请输入验证码'){value =''}" onblur="if (value ==''){value='请输入验证码'}" style="top:-1px">
                <input class="form-control pr t" type="text" name="pwd" data-value="请输入新密码" value="请输入新密码" style="top:-2px">
                <input class="form-control pr t" type="text" name="pwd2" data-value="请确认新密码" value="请确认新密码" style="top:-3px">
                </form>
                <button class="getCaptcha t btn btn-default pa" style="background-color:#61bac0;outline:0;color:#fff;top: 109px;right: 27px;z-index:20">获取验证码</button>
                <script>
                    (function(){
                        var t=0,ge = function(){
                            if(t==0)t=60;
                            j('.getCaptcha').addClass('disabled').text('等待'+t+'秒');
                            t--;
                            if(t==0){
                                j('.getCaptcha').text('获取验证码');j('.getCaptcha').removeClass('disabled').one('click',ge);
                            }else setTimeout(ge,1000)
                            
                        },gt=function(){
                            if(!j('#forgotForm [name=phone]').val().match(/1\d{10}/)){
                                 j('.forgot_error').text('手机号错误');j('.getCaptcha').one('click',gt);return 
                            }
                            j.getJSON('/tool/captcha/get_captcha',j('#forgotForm').serializeArray(),function(d){
                                if(d.code==200){
                                    show_alert(1,'发送成功');j('#forgotForm [name=captcha]').val(d.desc);
                                    ge();
                                }else j('.forgot_error').text(d.desc);
                            });
                            
                            
                        };
                        j('.getCaptcha').one('click',gt);
                    })()
                    
                </script>
            </div>
        
        
        <div style="padding:0 20px">
            <button class="forgot t btn btn-default btn-lg btn-block" style="background-color:#61bac0;outline:0;color:#fff">修改</button>
            <script>
            j('button.forgot').click(function(){
                if(j('#forgotForm [name=pwd]').val()!=j('#forgotForm [name=pwd2]').val()){j('.forgot_error').text('2次密码不同');return}
                j.post('app/login/forgot',j('#forgotForm').serializeArray(),function(d){
                    if(d.code==200){
                        show_alert(1,'修改成功，可以登录了哟~',function(){location.reload(true);})
                    }else j('.forgot_error').text(d.desc);
                },'json')
            })
            
        </script>
        </div>
        <div style="padding:4px 20px 60px 20px;height:30px">
            <label class="fl cp"><small class="toLogin" style="color:#999">记得密码</small></label>
            <label class="fr cp"><small class="forgot_error" style="color:red"></small></label>
        </div>
    </div>
</div>
    <a href="/app/index" class="t btn btn-default pa" style="top:10px;right:10px;background-color:#61bac0;outline:0;color:#fff;padding:10px 30px">跳过 > ></a>


<!--{subtemplate tool:footer}-->