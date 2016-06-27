<!--{subtemplate tool:header}-->
<!--{eval addcss('main')}-->
<!--{eval addjs('p')}-->


<!--{if !$me}-->
<style>
.back{z-index:-1;background-size:cover;top:0;left:0;width:100%;height:100%}
.lo{z-index:3;padding-top:200px;width:100%;position:fixed;background-color:rgba(0,0,0,0.5);height:100%}
.lo>div{
    width:400px;background:#f0f0f0;border-radius:5px;box-shadow: 0 0 100px;top:0
}
.lo h3{font-weight:normal;padding:40px 0 20px 0;margin-top:0}
input.form-control{border-radius:0;height:50px;color:#ccc}
input.form-control:focus{color:#555;z-index:13}
.lo span:first-child{
    right:16px;top:10px
}

</style>
<script>

j(function(){
    j('[name=pwd],[name=pwd2]').on({focus:function(){
        if(this.value ==j(this).attr('data-value')){
            j(this).attr('type','password');
            this.value =''
        }
    },blur:function(){
        if(this.value ==''){
            j(this).attr('type','text');
            this.value=j(this).attr('data-value')
        }
    }});
    j('.toRegister').click(function(){
        j('.los').slideUp();j('.los2').slideDown()
    });
    j('.los2 .toLogin,.toLogin2').click(function(){
        j('.los2').slideUp(); j('.los').slideDown()
    });
    j('.toForgot').click(function(){
        j('.los').slideUp();j('.los3').slideDown()
    });
    j('.los3 .toLogin').click(function(){
        j('.los3').slideUp(); j('.los').slideDown()
    });
    j('.toLogin').click(function(){
        j('.lo').fadeIn();
    });
    
});

</script>
<div class="container lo text-center dn">

    <!-- 登录  -->
    <div class="center-block pr los">
        <a onclick="j('.lo').fadeOut()"><span class="pa cp" aria-hidden="true">×</span></a>
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
            <button class="login t btn btn-default btn-lg btn-block" style="background-color:#ff6090;outline:0;color:#fff">登录</button>
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
        <a onclick="j('.lo').fadeOut()"><span class="pa cp" aria-hidden="true">×</span></a>
        <h3 class="">注册</h3>
        
        <form id="registerForm">
            <div class="form-group" style="padding:5px 20px 0 20px">
                <input class="form-control pr t" type="text" name="phone" value="请输入您的手机号" onfocus="if (value =='请输入您的手机号'){value =''}" onblur="if (value ==''){value='请输入您的手机号'}">
                <input class="form-control pr t" type="text" name="pwd" data-value="6-16位密码，区分大小写" value="6-16位密码，区分大小写" style="top:-1px">
                <input class="form-control pr t" type="text" name="pwd2" data-value="请确认新密码" value="请确认新密码" style="top:-2px">
            </div>
        </form>
        
        <div style="padding:0 20px">
            <button class="register t btn btn-default btn-lg btn-block" style="background-color:#ff6090;outline:0;color:#fff">注册</button>
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
                <button class="getCaptcha t btn btn-default pa" style="background-color:#ff6090;outline:0;color:#fff;top: 100px;right: 27px;z-index:20">获取验证码</button>
                <script>
                    (function(){
                        var t=0,ge = function(){
                            if(t==0)t=60;
                            j('.getCaptcha').addClass('disabled').text('等待'+t+'秒');
                            t--;
                            if(t==0){
                                j('.getCaptcha').text('获取验证码');j('.getCaptcha').removeClass('disabled').one('click',gt);
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
            <button class="forgot t btn btn-default btn-lg btn-block" style="background-color:#ff6090;outline:0;color:#fff">确定</button>
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
{/if}
<div class="nav{if $g['control']=='index'} pa{else}" style="background: #333;{/if}">

        <div class="nav_z">
            <div class="nav_z_left">
                <div class="nav_z_left_1"><img src="images/xq_06.png" class="nav_tu1"/></div>
                <a href="app/index"><div class="nav_z_left_2">主页</div></a>
                <a href="app/twostar"><div class="nav_z_left_3">二次元明星</div></a>
                <a><div class="nav_z_left_3 cp">漫吧</div></a>
                <a><div class="nav_z_left_3 cp">漫展&周边</div></a>

            {if !$me}
                <a><div class="nav_z_left_3 cp toLogin toLogin2">个人中心</div></a>
            </div>
            <div class="nav_z_right">
                <div class="nav_z_right_1">
                <input type="text" class="nav_text_1" value="搜索用户/标签" style="outline:0" onfocus="if (value =='搜索用户/标签'){value =''}" onblur="if (value ==''){value='搜索用户/标签'}"  /></div>
                <div class="nav_z_right_2 toLogin toRegister">注册</div>
                <div class="nav_z_right_3 toLogin toLogin2" >登录</div>
            
            {else}
                <a href="app/usercenter/index/{me.uid}"><div class="nav_z_left_3">个人中心</div></a>
            </div>
            <div class="nav_z_right_cos">
                <div class="nav_z_right_1_cos">
                <input type="text" class="nav_text_1" value="搜索用户/标签" style="outline:0" onfocus="if (value =='搜索用户/标签'){value =''}" onblur="if (value ==''){value='搜索用户/标签'}"></div>
                <div class="nav_nav_z">
                	<div class="nav_nav_z_1"><img src="pic/{me.avatar}.avatar.jpg" class="nav_nav_tu1 img-circle"></div>
                    <a href="app/usercenter/index/{me.uid}"><div class="nav_nav_z_2">{me.nickname}</div></a>
                </div>
                <a><div class="nav_nav_right logout cp"><ins>退出登录</ins></div></a>
                <script>
                    j('.logout').click(function(){
                        j.post('app/login/logout',function(){
                            show_alert(1,'退出成功~',function(){location.reload(true);})
                        })
                    })
                </script>

            {/if}
            </div>
        </div>
</div>








