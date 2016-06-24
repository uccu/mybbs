<!--{subtemplate tool:header}-->
<style>
body{}
.back{z-index:-1;background-size:cover;top:0;left:0;width:100%;height:100%}
.lo{z-index:2;padding-top:200px}
.lo>div{
    width:400px;background:#f0f0f0;border-radius:5px;box-shadow: 0 0 100px;
}
.lo h3{font-weight:normal;padding:40px 0 20px 0}
input.form-control{border-radius:0;height:50px;color:#ccc}
input.form-control:focus{color:#555;z-index:13}
.lo span:first-child{
    right:16px;top:10px
}
</style>
<script>
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
    $('[name=pwd]').on({focus:function(){
        if (this.value =='6-16位密码，区分大小写'){
            $(this).attr('type','password');
            this.value =''
        }
    },blur:function(){
        if (this.value ==''){
            $(this).attr('type','text');
            this.value='6-16位密码，区分大小写'
        }
    }})
    
});

</script>
<!--{loop $list $p}-->
<div class="back pa dn" style="background-image:url(/pic/{p.pic}.jpg)"></div>
<!--{/loop}-->
<div class="container lo text-center dn">
    <div class="center-block pr los">
        <a href="/app/index"><span class="pa cp" aria-hidden="true">×</span></a>
        <h3 class="">登录</h3>
        
        <form id="loginForm">
            <div class="form-group" style="padding:5px 20px 0 20px">
                <input class="form-control pr" type="text" name="phone" value="请输入您的手机号" onfocus="if (value =='请输入您的手机号'){value =''}" onblur="if (value ==''){value='请输入您的手机号'}">
                <input class="form-control pr" type="text" name="pwd" value="6-16位密码，区分大小写"  style="top:-1px">
            </div>
        </form>
        <p class="text-left cp" style="padding:0 20px"><a><strong style="color:#999">忘记密码</strong></a></p>
        <div style="padding:0 20px">
            <button class="login t btn btn-default btn-lg btn-block" style="background-color:#61bac0;outline:0;color:#fff">登录</button>
            <script>
            j('button.login').click(function(){
                j.post('app/login/login',j('#loginForm').serializeArray(),function(d){
                    if(d.code==200)location.reload(true)
                },'json')
            })
            
        </script>
        </div>
        <div style="padding:4px 20px 60px 20px;height:30px">
            <label class="fl cp"><input type="checkbox"/><small style="color:#ccc">记住密码</small></label>
            <label class="fr cp"><small style="color:#999">去注册</small></label>
        </div>
    </div>
</div>
    <a href="/app/index" class="t btn btn-default pa" style="top:10px;right:10px;background-color:#61bac0;outline:0;color:#fff;padding:10px 30px">跳过 > ></a>


<!--{subtemplate tool:footer}-->