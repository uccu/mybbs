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
        <img src="/pic/h5/inquiry/adoption@2x.png">{title}
    </div>
    <!--{loop $list_adopt $v}-->
    <!--{eval foreach($v as $k=>$v2)$$k=$v2}-->
    <div class="block">
        <div class="row">
            <div class="col-xs-3 avatar">
                <img src="{thumb}">
            </div>
            <div class="col-xs-9">
                <div class="name">
                    {nametrue}
                </div>
                <p style="color:#f1f1f1">{date}　</p>>
            </div>
            <div class="content">{content}</div>
        </div>
    </div>
    <!--{/loop}-->
</div>
{/if}
<!--{subtemplate tool:footer}-->