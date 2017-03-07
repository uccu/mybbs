<!--{subtemplate header}-->
<!--{eval addcss('type','inquiry','h5')}-->
<div class="search tc">
    <form method="post" action="/h5/inquiry/lists">
        <input type="text" name="search" placeholder="搜索问题" class="tc">
        <input type="submit" class="dn">
    </form>
</div>
<div class="title">
    {equip}
</div>

<div class="list container-fluid">
    <!--{loop $list $kk=>$v}-->
    <!--{eval foreach($v as $k=>$v2)$$k=$v2}-->
    <a href="/h5/inquiry/lists/{id}">
        <div class="row">
            <div class="col-xs-2 num tc">
                <!--{eval echo $kk+1}-->
            </div>
            <div class="col-xs-7">
                <div class="name">
                    {name}
                </div>
                <div class="tag">
                    <p>问题总数 <font> {count} </font> 条</p>
                </div>
            </div>
            <div class="col-xs-3 right tr">
                {if $today_count}<span>{today_count}</span>{/if}
                <img src="/pic/h5/inquiry/arrow@2x.png">
            </div>
        </div>
    </a>
    <!--{/loop}-->
</div>
<div class="pf bbg" style="width:100%;bottom:0;left:0;z-index:1">
    <a href="http://121.199.8.244:4000/customer.html"><img src="/pic/h5/d.png" alt="" class="img-responsive"></a>
    <span class="db pa clos" style="height:100%;width:40px;z-index:3;top:0;left:0"></span>
    <script>j('.clos').click(function(){j('.bbg').fadeOut()})</script>
</div>
<!--{subtemplate tool:footer}-->