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
    <div class="small-pic pa">
        <!--{loop $img $v}-->
        <div class="pic dib t"></div>
        <!--{/loop}-->
    </div>
</div>
<script>
    



</script>
{/if}
<!--{subtemplate tool:footer}-->