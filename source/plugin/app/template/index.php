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
        <div class="ofh pr" style="height:300px">
            <ul class="picList list-inline pa t tl">
                <!--{eval $pic = [1,2,3,4,5,6,7]}-->
                <!--{loop $pic $k=>$v}-->
                <li class="pic-block cp z-pic-d">
                    <span class="pic db"></span>
                </li>
                <!--{/loop}-->
            </ul>
        </div>
        <script>
            $('.z-pic-d').bind('click',function(){
                var tt = $('.pic-block').eq($(this).index());
                var al = $('.picList').offset().left;
                var tl = tt.offset().left;
                var tw = tt.width();
                var ww = 1200;
                var z = ww/2-(tl-al)-tw/2;
                $('.picList').css('left',z);
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