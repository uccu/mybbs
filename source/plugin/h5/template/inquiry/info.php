<!--{subtemplate header}-->
<!--{eval addcss('info','inquiry','h5')}-->
<!--{eval addjs('info','inquiry','h5')}-->
{if $img}
<div class="banner ofh pr">
    <div class="large-pic pr">
        <!--{loop $img as $v}-->
        <div class="pic" style="background-image:url($v)"></div>
        <!--{/loop}-->
    </div>
    <div class="small-pic">
        <!--{loop $img as $v}-->
        <div class="pic"></div>
        <!--{/loop}-->
    </div>
</div>
{/if}
<!--{subtemplate tool:footer}-->