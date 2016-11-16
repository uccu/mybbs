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
<div class="container info">
    <div class="name">
        {title}
    </div>
    <div class="avatar">
        <img src="{thumb}">
        <font style="color:#666">{nickname}· </font> <font style="color:#a1a1a1">{date}</font>
    </div>

</div>

{/if}
<!--{subtemplate tool:footer}-->