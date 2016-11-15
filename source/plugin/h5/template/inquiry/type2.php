<!--{subtemplate header}-->
<!--{eval addcss('type','inquiry','h5')}-->
<div class="search tc">
    <form method="post" action="/h5/inquiry/lists">
        <input type="text" name="search" placeholder="搜索问题">
        <input type="submit" class="dn">
    </form>
</div>


<div class="list container-fluid">
    <!--{loop $list $kk=>$v}-->
    <!--{eval foreach($v as $k=>$v2)$$k=$v2}-->
    <div class="row">
        <div class="col-xs-2 avatar">
            {eval echo $kk+1}
        </div>
        <div class="col-xs-7">
            <div class="name">
                <a href="/h5/inquiry/type/{id}">{name}</a>
            </div>
            <div class="tag">
                <p>问题总数 <font> {count} </font> 条</p>
            </div>
        </div>

    </div>
    <!--{/loop}-->
</div>

<!--{subtemplate tool:footer}-->