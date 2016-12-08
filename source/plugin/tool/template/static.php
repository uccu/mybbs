<!--{subtemplate tool:header}-->
<style>
.container img{max-width:100%}
.container p{font-size:14px}
.describe::before{
    content: '“';
    font-size: 40px;
    height: 20px;
    position: relative;
    top: 15px;
    color: #ccc;
    line-height: 0px;
}
.describe::after{
    content: '”';
    font-size: 40px;
    height: 20px;
    position: relative;
    top: 20px;
    color: #ccc;
    line-height: 0px;
}
</style>
<div class="container">
<h3>{title}</h3>
<p style="font-size:12px;color:#bbb">{time}</p>
{if $title}
<hr style="color:#bbb">
{/if}

{value}


</div>

{footer}

<!--{subtemplate tool:footer}-->