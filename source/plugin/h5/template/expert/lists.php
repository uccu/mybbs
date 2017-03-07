<!--{subtemplate header}-->
<!--{eval addcss('lists','expert','h5')}-->

<div class="search tc">
    <span class="db">搜索专家</span>
    <form method="post" class="dn">
        <input type="text" name="search">
        <input type="submit" class="dn">
    </form>
</div>
<script>
j('.search .db').click(function(){
    j(this).addClass('dn');j('.search form').removeClass('dn');
    j('.search [name=search]').focus();
});
j('.search [name=search]').blur(function(){
    j('.search form').addClass('dn');j('.search .db').removeClass('dn');
})

</script>


<div class="list container-fluid">

    <!--{loop $list $v}-->
    <!--{eval foreach($v as $k=>$v2)$$k=$v2}-->
    <div class="row">
        <div class="col-xs-3 avatar">
            <a href="/h5/expert/info/{uid}"><img src="{thumb}"></a>
        </div>
        <div class="col-xs-9">
            <div class="name">
                <a href="/h5/expert/info/{uid}">{nametrue}</a>
                <img src="/pic/h5/expert/zj@2x.png">
            </div>
            <div class="tag">
                <p>{lable}　</p>
                <p>从业经验：{experience}　</p>
            </div>
        </div>
    </div>
    <div class="row tc">
        <div class="col-xs-4"><span class="nn">关注</span> {follow}</div>
        <div class="col-xs-4"><span class="nn">粉丝</span> {fans}</div>
        <div class="col-xs-4"><span class="nn">回答</span> {answer}</div>
    </div>
    <!--{/loop}-->
</div>


<div class="pf bbg" style="width:100%;bottom:0;left:0;z-index:1">
    <a href="http://121.199.8.244:4000/customer.html"><img src="/pic/h5/d.png" alt="" class="img-responsive"></a>
    <span class="db pa clos" style="height:100%;width:40px;z-index:3;top:0;left:0"></span>
    <script>j('.clos').click(function(){j('.bbg').fadeOut()})</script>
</div>
<!--{subtemplate tool:footer}-->