<!--{subtemplate header}-->
<!--{eval addcss('info','inquiry','h5')}-->
<!--{eval addjs('info','inquiry','h5')}-->
{if $img}
<div class="banner ofh pr">
    <div class="large-pic pr">
        <!--{loop $img $k=>$v}-->
        <div class="pic pa t-1" style="background-image:url({v});left:{$k}00%"></div>
        <!--{/loop}-->
    </div>
    <div class="small-pic pa tc">
        <!--{loop $img $v}-->
        <div class="pic dib t"></div>
        <!--{/loop}-->
    </div>
</div>
{/if}
<div class="info">
    <div class="name">
        {title}
    </div>
    <div class="avatar">
        <img src="{thumb}">
        <font style="color:#666">{nickname} · </font><font style="color:#a1a1a1">{date}</font>
    </div>
</div>

<div class="info">
    <div class="content">
        {content}
    </div>
</div>
{if $list_adopt}
<div class="info">
    <div class="title">
        <img src="/pic/h5/inquiry/adoption@2x.png">该答案已被作者采纳
    </div>
    <!--{loop $list_adopt $v}-->
    <!--{eval foreach($v as $k=>$v2)$$k=$v2}-->
    <div class="block">
        <div class="row">
            <div class="col-xs-2 avatar">
                <img src="{thumb}">
            </div>
            <div class="col-xs-7">
                <h5>{nickname}</h5>
                <p style="color:#a1a1a1">{date}　</p>
            </div>
            <div class="col-xs-3 avatar2">
                <img src="/pic/h5/inquiry/zan0@2x.png"><span>{zan}</span>
            </div>
            <div class="content2 col-xs-12">{content}</div>
            <div class="reply col-xs-12">
                <div style="background:url(/pic/h5/reply.png);height:10px;background-size:100%;margin-top:15px"></div>
                <div style="background:#eee;padding:8px;color:#777;"><font style="color:#a1a1a1">作者回复：</font>{thank}</div>
            </div>
        </div>
    </div>
    <!--{/loop}-->
</div>
{/if}


{if $list_reply}
<div class="info reply">
    <div class="title2">
        最新答案
    </div>
    <!--{loop $list_reply $v}-->
    <!--{eval foreach($v as $k=>$v2)$$k=$v2}-->
    <div class="block">
        <div class="row">
            <div class="col-xs-2 avatar">
                <img src="{thumb}">
            </div>
            <div class="col-xs-7">
                <h5>{nickname}</h5>
                <p style="color:#a1a1a1">{date}　</p>
            </div>
            <div class="col-xs-3 avatar2">
                <img src="/pic/h5/inquiry/zan0@2x.png"><span>{zan}</span>
            </div>
            <div class="content2 col-xs-12">{content}</div>
        </div>
    </div>
    <!--{/loop}-->
</div>
{/if}



<div class="info">
    <div class="title">
        <img src="/pic/h5/inquiry/view@2x.png">查看更多答案请下载APP
    </div>
    <div class="content">
        <a href="http://121.199.8.244:4000/customer.html"><img src="/pic/h5/inquiry/download@2x.png" class="img-responsive center-block"></a>
    </div>
</div>
<!--{subtemplate tool:footer}-->