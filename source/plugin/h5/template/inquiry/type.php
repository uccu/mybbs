<!--{subtemplate header}-->
<!--{eval addcss('type','inquiry','h5')}-->
<div class="search tc">
    <form method="post" action="/h5/inquiry/lists">
        <input type="text" name="search" placeholder="搜索问题" class="tc">
        <input type="submit" class="dn">
    </form>
</div>
<div class="title">
    请选择设备问诊问题
</div>

<div class="list container-fluid">
    <!--{loop $list $v}-->
    <!--{eval foreach($v as $k=>$v2)$$k=$v2}-->
    <a href="/h5/inquiry/type/{id}">
        <div class="row">
            <div class="col-xs-2 avatar">
                <img src="{img}">
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

<!--{subtemplate tool:footer}-->