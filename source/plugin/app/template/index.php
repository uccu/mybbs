<!--{subtemplate tool:header}-->
<style>
    .T{min-width:1200px}
    .t1>img{width:100%}
    .nav{
        width:100%;background-color:rgba(0,0,0,0.5);padding:20px;top:0;left:0;
    }
    .nav_e{max-width:1200px;margin:auto}

    .g1 img{
        top:0px;
    }

    .g img{
        opacity:0;top:100px;
    }
    .g2{
        left:42%;top:20%;
    }
    .g3{
        left:60%;opacity:0
    }
</style>
<div class="T t1 pr">
    <img src="/pic/background.png">
    <div class="nav clear pa tc">
        <div class="nav_e">
            <a href="#"><img src="/pic/logo.png" class="fl"></a>
            <a href="#"><img src="/pic/phone.png" class="fr"></a>
        </div>
    </div>
    <div class="pa g2 g3 t-2">
        <img src="/pic/b1.png" >

        <div style="margin:60px;padding-left:100px" class="pr">
            <a href="http://fir.im/zc5e?utm_source=fir&utm_medium=qr" target="_blank"><img src="/pic/b2.png" class="db" style="height:103px"></a>
            <a href="/ywws.apk" target="_blank"><img src="/pic/b3.png" class="db" style="height:103px"></a>
            <img src="/pic/b4.png" class="pa" style="top:0;right:50px">
        </div>




    </div>
</div>

<div class="T tc pr g g1">
    <img class="nav_e img-responsive pr t-1" src="/pic/p1.png">
</div>
<div class="T tc pr g g1" style="background:#e3eeff;height:750px;padding-top:100px">
    <img class="nav_e img-responsive pr t-1" src="/pic/p2.png">
</div>

<div class="T tc pr g g1" style="height:750px;padding-top:100px">
    <img class="nav_e img-responsive pr t-1" src="/pic/p3.png">
</div>

<div class="T tc pr g g1" style="background:#e3eeff;height:750px;padding-top:100px">
    <img class="nav_e img-responsive pr t-1" src="/pic/p4.png">
</div>

<div class="T tc pr g g1" style="height:750px;padding-top:100px">
    <img class="nav_e img-responsive pr t-1" src="/pic/p5.png">
</div>

<div class="T tc pr" style="background:#005dad;height:217px;">
    <a href="http://fir.im/zc5e?utm_source=fir&utm_medium=qr" target="_blank""><img class="nav_e img-responsive dib" src="/pic/d1.png"></a>
    <img class="nav_e img-responsive dib" src="/pic/d0.png" style="margin:45px 120px">
    <a href="/ywws.apk" target="_blank"><img class="nav_e img-responsive dib" src="/pic/d2.png"></a>
</div>
<div class="T tc">
<div class="tl pr" style="width:1200px;margin:auto">
    <img class="img-responsive fl" src="/pic/z1.png" style="margin:40px 0;margin-right:20px">
    <div class="fl pr t" style="top:53px;width:190px" >
        <p style="color:#000;font-size:12px">扫码关注</p>
        <p style="color:#000;font-size:12px">微信服务号：yunwws</p>
    </div>
    <div class="fl pr" style="top:10px;width:1px;height:120px;background:#fff;top:22px;margin-right:63px"></div>

    <div class="fl pr t" style="top:40px;width:285px" >
        <p style="color:#000;font-size:14px;margin:0;padding-bottom:6px">全国免费热线</p>
        <p style="color:#000;font-size:20px;margin:0;">137-642-43215   <small style="color:#666;font-size:12px;">(8:30 - 18:30)</small></p>
        
        <p style="color:#666;font-size:12px;margin:0;">咨询、建议、投诉：<a href="mailto:qingcesh@163.com">qingcesh@163.com</a></p>
    </div>
    <div class="fl pr" style="top:10px;width:1px;height:120px;background:#fff;top:22px;margin-right:63px"></div>
    <div class="fl pr t" style="top:42px;" >
        <p style="color:#666;font-size:12px;margin:0;padding-bottom:12px">地址：中国上海市长宁区延安西路777号601室</p>
        <p style="color:#666;font-size:12px;margin:0;padding-bottom:12px">Copyright © 上海擎测机电工程技术有限公司 版权所有&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  沪ICP备：17000939号</p>
    </div>


</div>
</div>
<script>

j(function(){
    j(document).scroll(function(e){
        var a = j(document).scrollTop()+j(window).height();

        j('.g').each(function(e){
            var b = j(this).offset().top;
            if(b+300<a && b+1300>a)j(this).removeClass('g')
        })
    });
    j('.g2').removeClass('g3');
})  

</script>


<!--{subtemplate tool:footer}-->