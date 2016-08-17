<!--{subtemplate _header}-->
<!--{eval addcss('app')}-->
<!--{eval addjs('app')}-->


<div class="banner pr" style="background-image:url({anli.header});height:500px">
	<div class="banner_in pa tc">
        <div class="container mediaz tl" style="margin:auto">
            <h3>{anli.name}</h3>
            <footer>{anli.suport}</footer>
        </div>
	</div>
</div>
<div class="infoView pr">
    <div class="container mediaz tc">
        <div class="row">
            <div class="col-xs-7 tl" style="background:#ccc;padding-left:120px;padding-right:80px;">
                <h4>项目背景</h4>
                <p>bakabaka bakabaka bakabaka bakabaka bakabaka bakabaka bakabaka bakabaka </p>
            </div>
            <div class="col-xs-5 tl" style="background:#aaa">
                <h4>联系顾问</h4>
                <phone>400 8166 717</phone>
            </div>
        
        </div>


    </div>
</div>
<div class="picView pr">
    <div class="container mediaz tc">
        <h2>部分UI展示</h2>
        <ul class="thumbList list-inline tl">
            <!--{loop $pic $v}-->
            <li class="thumb-block cp t">
                <span class="thumb db" data-path="{v.path}" style="background-image:url({v.path}.small.jpg)"></span>
            </li>
            <!--{/loop}-->
        </ul>
        <div class="largeList pr" style="min-height:200px">
            <img >
            <div class="pa pic-left t cp" style="width:76px;height:76px;left:-38px;top:45%;background:url(/pic/pic-left.png)"></div>
            <div class="pa pic-right t cp" style="width:76px;height:76px;right:-38px;top:45%;background:url(/pic/pic-right.png)"></div>
        </div>
        <script>
            $('.thumb-block').bind('click',function(){
                var t = $(this).find('span');
                $('.thumb-block').removeClass('active');
                $(this).addClass('active');
                $('.largeList img').attr('data-which',$(this).index()).attr('src',t.attr('data-path')+'.large.jpg');
            }).eq(0).click();
            $('.pic-left').bind('click',function(){
                var e = parseInt($('.largeList img').attr('data-which'))-1;
                if(e<0)e = $('.thumb-block:last').index();
                $('.thumb-block').eq(e).click();
            });
            $('.pic-right').bind('click',function(){
                var e = parseInt($('.largeList img').attr('data-which'))+1,h = $('.thumb-block:last').index();
                if(e>h)e=0;
                $('.thumb-block').eq(e).click();
            });
        
        </script>
    </div>
    <div class="pf anliMenu tc">
        <div class="row">
            <div class="col-xs-4 tc" data-z="上一个案例">
                <a {if $lastAnli}href="/app/anli/{lastAnli.aid}"{/if}><span class="lastAnli dib cp t"></span></a>
            </div>
            <div class="col-xs-4 tc" data-z="返回列表">
                <a href="/app/cases"><span class="listAnli dib cp t"></span></a>
            </div>
            <div class="col-xs-4 tc" data-z="下一个案例">
                <a {if $nextAnli}href="/app/anli/{nextAnli.aid}"{/if}><span class="nextAnli dib cp t"></span></a>
            </div>
        </div>
        
    </div>
</div>
<div style="height:40px;background:#ddd">
<div class="anli">
    <div class="container mediaz tc">
        <h2 class="_">浏览了该案例的人，还浏览了</h2>
        <div class="row t tl">
        <!--{loop $rand $v}-->
            <div class="col-xs-4 anli-block">
                <a href="app/anli/{v.aid}">
                    <div class="anli-block-in pr cp">
                        <div class="anli-pic" {if $v['thumb']}style="background-image:url({v.thumb})"{/if}></div>
                        <h4>{v.name}</h4>
                        <p>{v.des}</p>
                    </div>
                </a>
            </div>
        <!--{/loop}-->
            
        </div>
    </div>
</div>

<!--{subtemplate _footer}-->