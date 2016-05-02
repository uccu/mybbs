<!--{subtemplate seanime:header}-->
<!--{eval addcss()}-->
<!--{eval addjs()}-->

	<div class="box-b1">
        <span class="search_box t">
			<input class="search_input t-1 b-8 o-5 o-f1 b-f1 w-580" style="margin:180px auto 100px auto" placeholder="多条件请用空格隔开" />
			<div class="search_tags"><ul></ul></div>
		</span>
		<a class="search t button-1 bgc-1 bgc-h1"><i>搜索</i></a>
    </div>
	<div class="box-b1">
		
		
	</div>

<div class="box-b1 t padding-0 margin-auto">
<div class="sourceslist_box w-1000">
	<div class="sourceslist_top"></div>
	<div class="playbill w-1000 ofh tl">
			{if $playbill}
			<a class="t button-2 b-1 b-h5 c-h5 fr" href="seanime/playbill" target="overlay-iframe-2" rel="nofollow" style="margin:1px"><i>查看完整历史更新</i></a>
			{/if}
		</div>
		<div class="playbill w-1000 ofh pr">
			{if $playbill}
			<ul>
			<li class="playbill_n"><a class="button-1 button-1plus bgc-1"><i>24小时历史更新</i></a></li>
			<!--{loop $playbill_y $v}-->
			<li class="playbill_b"><a href="seanime/lists/aid/{v.aid}" class="t button-1 bgc-7 bgc-h7" title="{v.remark}"><i>{if $v['newname']}{v.newname}{else}{v.name}{/if} <em>（第{v.lastnum}话）</em></i></a></li>
			
			<!--{/loop}-->
			<!--{loop $playbill_t $v}-->
			<li class="playbill_b"><a href="seanime/lists/aid/{v.aid}" class="t button-1 bgc-5 bgc-h5" title="{v.remark}"><i>{if $v['newname']}{v.newname}{else}{v.name}{/if} <em>（第{v.lastnum}话）</em></i></a></li>
			
			<!--{/loop}-->
			</ul>
			{/if}
		</div>
	<ul class="sourceslist_menu">
		<li><a class="" href="seanime/lists"><i>所有资源</i></a></li>
		<li><a class="" href="seanime/lists/today"><i>今日更新</i></a></li>
		<li><a class="" href="seanime/lists/yesterday"><i>昨日更新</i></a></li>
		<li><a class="" href="seanime/lists/ltype/1"><i>种子资源</i></a></li>
		<li><a class="" href="seanime/lists/ltype/2"><i>磁力资源</i></a></li>
		<li><a class="" href="seanime/lists/ltype/3"><i>外链资源</i></a></li>
		<li><a class="" href="seanime/lists/ltype/4"><i>网盘资源</i></a></li>
	</ul>
	<ul class="sourceslist_menu sdtype">
	</ul>
	<div class="sourceslist">
	<ul class="sourceslist_title">
		<li><i>字幕组/压制组</i></li>
		<li><i>资源名称</i></li>
		<li><i>下载地址</i></li>
		<li><i>资源大小</i></li>
		<li><i>上传时间</i></li>
	</ul>
	<div class="sourceslist_body">
		<!--{loop $list $a=>$b}-->
		<ul class="sourceslist_block" sid="{b.sid}">
			<li>{if $b['subtitle']}<a href="seanime/lists/subtitle/{b.subtitle}"><i>{b.subtitle}</i></a>{else}<i>　</i>{/if}</li>
			<li style="text-align:left">
				<a class="sdtype" href="seanime/sdtype/{b.sdtype}"><i>{b.sdtype}</i></a>
				<a href="seanime/page/sid/{b.sid}/{b.stimeline}" rel="nofollow" target="overlay-iframe-2"><i>{$b['sname']}</i></a>
				<a target="_blank" href="{$b['outlink']}"><i class="outs">
					{if $b['outstation']==1}[动漫花园]
					{elseif $b['outstation']==2}[NYAA]
					{elseif $b['outstation']==3}[Leopard]
					{elseif $b['outlink']}[外站]
					{else}[本站]
					{/if}
					</i></a>
			</li>
			<li><a rel="external nofollow" href="seanime/down/straight/{b.sid}/{b.stimeline}"><i>{b.sloc_type}</i></a></li>
			<li><i>{b.size}</i></li>
			<li><i>{b.stimeline}</i></li>
		</ul>
		<!--{/loop}-->
	</div>
	</div>
	<div class="sourceslist_bottom">
		<!--{eval $count = count($list)}-->
		<!--{if $count<100}-->
		<a class="t button-1 button-n bgc-1 bgc-h1"><i>已加载全部 {count} 条资源</i></a>
		<!--{else}-->
		<a class="t button-1 bgc-1 bgc-h1 resource_gain"><i>加载更多</i></a>
		<!--{/if}-->
	</div>
	
</div>
</div>
<div id="overlay-2" class="overlay nos cd">
    <div class="overlay_bg overlay_cancel"></div>
    <div class="overlay_box ui-draggable">
        <div class="box-o0"><iframe id="overlay-iframe-2" name="overlay-iframe-2" style="width:800px;min-height:400px;height:70%;background:#fff;max-width: 99%;border: 0;"></iframe></div>
    </div>
</div>	
	




<!--{subtemplate seanime:footer}-->