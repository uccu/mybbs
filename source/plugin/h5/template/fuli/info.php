<!--{subtemplate header}-->
<div class="container">
<h4>{name}</h4>
<p style="color:#a1a1a1">发表于：{date}</p>
</div>
<hr style="color:#a1a1a1">
<div class="container">
{content}
</div>

<div class="pf bbg" style="width:100%;bottom:0;left:0;z-index:1">
    <img src="/pic/h5/d.png" alt="" class="img-responsive">
    <span class="db pa clos" style="height:100%;width:40px;z-index:3;top:0;left:0"></span>
    <script>j('.clos').click(function(){j('.bbg').fadeOut()})</script>
</div>
<!--{subtemplate tool:footer}-->