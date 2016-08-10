<!--{subtemplate _header}-->
<!--{eval addcss('case')}-->
<!--{eval addjs('case')}-->


<div class="banner">
    <img src="pic/case/banner.png" style="width:100%;min-width:1200px" />
</div>
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

    </div>
</div>


<!--{subtemplate _footer}-->