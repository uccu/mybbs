<!--{subtemplate header}-->
<!--{eval addcss('type','inquiry','h5')}-->
<div class="search tc">
    <form method="post" action="/h5/inquiry/lists">
        <input type="text" name="search" placeholder="搜索问题">
        <input type="submit" class="dn">
    </form>
</div>


<div class="list container-fluid">
    <!--{loop $list $v}-->
    <!--{eval foreach($v as $k=>$v2)$$k=$v2}-->
    <div class="row">
        <div class="col-xs-3 avatar">
            <a href="/h5/inquiry/type/{id}"><img src="{img}"></a>
        </div>
        <div class="col-xs-6">
            <div class="name">
                <a href="/h5/inquiry/type/{id}">{name}</a>
            </div>
            <div class="tag">
                <p>{lable}<font>{count}</font></p>
            </div>
        </div>
        <div class="col-xs-3">
            
        </div>
    </div>
    <!--{/loop}-->
</div>

<!--{subtemplate tool:footer}-->