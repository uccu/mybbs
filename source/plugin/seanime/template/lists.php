<!--{subtemplate seanime:header}-->
<!--{eval addcss()}-->
<!--{eval addjs()}-->

<div class="box-b1 t">
<div class="sourceslist_box w-1000">
	<div class="sourceslist_top"></div>
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
				<a class="sdtype" href=""><i>{b.sdtype}</i></a>
				<a href=""><i>{$b['sname']}</i></a>
				<!--{if $b['outstation']==1}-->
				<a class="outs" target="_blank" href="#"><i>[动漫花园]</i></a>
				<!--{elseif $b['subtitle']=='Leopard-Raws'}-->
				<a class="outs" target="_blank" href="#"><i>[Leopard]</i></a>
				<!--{elseif $b['outstation']==2}-->
				<a class="outs" target="_blank" href="#"><i>[NYAA]</i></a>
				<!--{else}-->
				<a class="outs" target="_blank" href="#"><i>[本站]</i></a>
				<!--{/if}-->
			</li>
			<li><a rel="external nofollow" href=""><i>{b.sloc_type}</i></a></li>
			<li><i>{b.size}</i></li>
			<li><i>{b.stimeline}</i></li>
		</ul>
		<!--{/loop}-->
	</div>
	</div>
	<div class="sourceslist_bottom">
		<a class="t button-1 bgc-1 bgc-h1 resource_gain"><i>加载更多</i></a>
		
	</div>
	
</div>
</div>
	
	




<!--{subtemplate seanime:footer}-->