<!--{subtemplate _header}-->
<!--{eval addcss('case')}-->
<!--{eval addjs('case')}-->


<div class="banner" style="background-image:url(pic/case/banner.png)"></div>
<div class="subnav">
    <div class="container mediaz">
        <ul class="list-inline t">
            <li><a class="subnav_all" data-tid="0">全部案例</a></li>
            <!--{loop $subnav $v}-->
            <li><a data-tid="{v.tid}">{v.name}</a></li>
            <!--{/loop}-->
        </ul>
    </div>
</div>
<hr>
<!--{loop $subsubnav $v}-->
<div class="subsubnav dn subsubnav_{$v[0]['sid']}">
    <div class="container mediaz">
        <ul class="list-inline t">
            <!--{loop $v $v2}-->
            <li><a data-tid="{v2.tid}">{v2.name}</a></li>
            <!--{/loop}-->
        </ul>
    </div>
</div>
<!--{/loop}-->

<div class="anli">
    <div class="container mediaz">
        <div class="row t">
            
        </div>
    </div>
    
</div>
<div class="more">
<div class="container mediaz">
    <div class="col-xs-5" style="height:1px;background:#ccc"></div>
    <div class="col-xs-2 tc">
        <span class="dib pr cp">MORE</span>
        <p class="pr dn" style="color:#ccc;top:-8px">已经没有了~</p>
    </div>
    <div class="col-xs-5" style="height:1px;background:#ccc"></div>
</div>
</div>

<!--{subtemplate _footer}-->