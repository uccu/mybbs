<!--{subtemplate _header}-->
<!--{eval addcss('wx')}-->
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
    <div class="container mediaz tc" >
        <div class="row" >
            <div class="col-xs-5 tl pr">
                <h4>扫码浏览</h4>
                <img src="/pic/wx_01.png">
                <img src="/pic/wx_02.png" class="pa" style="top:35px;right:60px">
                <span class="db pa" style="height:130px;width:130px;background:#ccc;top:40px;right:66px;background-size:100% 100%;background-image:url({anli.download})"></span>
            </div>
            <div class="col-xs-7 tl" style="padding-left:80px;padding-bottom:65px;height:267px">
                <h4>项目背景</h4>
                <p>{anli.background}</p>
            </div> 
        </div>
    </div>
</div>
<div style="height:40px;background:#ddd">
<div class="picView pr">
    <div class="container mediaz tc">
        <h2>部分UI展示</h2>
        <div class="ofh pr" style="height:auto">
            <img src="/pic/shape.png">
            <ul class="picList list-inline pa t tl">
                <!--{loop $pic $k=>$v}-->
                <li class="pic-block cp z-pic-d">
                    <span class="pic db" style="background-image:url({v.path})"></span>
                </li>
                <!--{/loop}-->
            </ul>
            <ul class="pictList list-inline pr t tc" style="width:300px;margin:auto">
                <!--{loop $pic $k=>$v}-->
                <li class="pict-block cp z-pic-d pr t">
                </li>
                <!--{/loop}-->
            </ul>
            
        </div>
        <script>
        
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