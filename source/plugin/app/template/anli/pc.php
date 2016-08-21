<!--{subtemplate _header}-->
<!--{eval addcss('pc')}-->
<!--{eval addjs('pc')}-->


<div class="banner pr" style="background-image:url({anli.header});">
	<div class="ban_zong">
		<div class="ban_z">
			<div class="ban_z1">
				{anli.name}
			</div>
			<div class="ban_z2">
				<div class="ban_z2_left">
					<div class="ban_z2_left_1">
						<div class="ban_z2_left_1_1">相关信息</div>
						<div class="ban_z2_left_1_2">{anli.prama1}</div>
						<div class="ban_z2_left_1_3">{anli.prama2}</div>
						<a href="{anli.website}"><div class="ban_z2_left_1_4">访问网址</div></a>
					</div>
				</div>
				<span class="ban_span"></span>
				<div class="ban_z2_right">
					<div class="ban_z2_right_1">
						<div class="ban_z2_right_1_1">项目背景</div>
						<div class="ban_z2_right_1_2">
							{anli.background}
						</div>
					</div>
				</div>
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
            <img class="img-responsive center-block">
            <div class="pa pic-left t cp" style="width:76px;height:76px;left:-38px;top:45%;background:url(/pic/pic-left.png);z-index:10"></div>
            <div class="pa pic-right t cp" style="width:76px;height:76px;right:-38px;top:45%;background:url(/pic/pic-right.png);z-index:10"></div>
        </div>
        <script>
            $('.thumb-block').bind('click',function(){
                var t = $(this).find('span');
                $('.thumb-block').removeClass('active');
                $(this).addClass('active');
                $('.largeList img').attr('data-which',$(this).index()).attr('src',t.attr('data-path')+'.jpg');
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