<!--{subtemplate main/header}-->
<!--{eval addcss();}-->
<!--{eval addjs("rl");}-->
<div>
<div style="background: burlywood;text-align: left;padding-left: 50px;color: #fff;"></div>
<style>i.tuijian:hover{color:#fff !important}</style>
<div style="background: cadetblue;text-align: left;padding-left: 50px;color: #fff;">上次改源码时候出了点错误，30号12点后没有能更新资源，都没人提醒orz</div>
<div class="search">
	<div>
		<input placeholder="多条件请用空格隔开" />
		<div class="searchTags pa">
			<ul></ul>
		</div>
	</div>
	<div>
		<button>搜索</button>
	</div>
</div>
<hr style="height: 1px;border: none;background: -webkit-gradient(linear,left top,right top,color-stop(0, #ccc), color-stop(0.3, #fff),color-stop(0.5, #999),color-stop(0.8, #999));background: -moz-linear-gradient(left, #fff,#fff 20%, #999);" />
<div class="sourceslist_menu">
	<ul>
		<li><a class="baeffect baeffectw" href="//4moe.com/s/rl/st/1/"><i>所有资源</i></a></li>
		<li><a class="baeffect baeffectw" href="//4moe.com/s/rlt/st/1/"><i>今日更新</i></a></li>
		<li><a class="baeffect baeffectw" href="//4moe.com/s/rly/st/1/"><i>昨日更新</i></a></li>
		<li><a class="baeffect baeffectw" href="//4moe.com/s/rlo/st/1/"><i>种子资源</i></a></li>
		<li><a class="baeffect baeffectw" href="//4moe.com/s/rlm/st/1/"><i>磁力资源</i></a></li>
		<li><a class="baeffect baeffectw" href="//4moe.com/s/rll/st/1/"><i>外链资源</i></a></li>
		<li><a class="baeffect baeffectw" href="//4moe.com/s/rlp/st/1/"><i>网盘资源</i></a></li>
	</ul>
</div>
<hr style="height: 1px;border: none;background: -webkit-gradient(linear,left top,right top,color-stop(0, #ccc), color-stop(0.3, #fff),color-stop(0.5, #999),color-stop(0.8, #999));background: -moz-linear-gradient(left, #fff,#fff 20%, #999);" />
<div class="sourceslist_menu">
	<ul>
		<!--{loop $_G['seanime']['themefilter'] $k=>$v}-->
		<!--{if $k!=4}-->
		<li><a class="baeffect baeffectw" href="//4moe.com/s/rlf/st/1/{$v['pid']}"><i>{$v['pval']}</i></a></li>
		<!--{/if}-->
		<!--{/loop}-->
	</ul>
</div>
<div class="sourceslist">
	<div class="sourceslist_title">
		<ul>
			<li><i>字幕组/压制组</i></li>
			<li><i>资源名称{if $_G['maxrow']}({$_G['maxrow']}){/if}</i></li>
			<li><i>下载地址</i></li>
			<li><i>资源大小</i></li>
			<li><i>上传时间</i></li>
		</ul>
	</div>
	<div class="sourceslist_body">
		<!--{loop $_G['seanime']['resource']['list'] $a=>$b}-->
		<ul>
			<li>{if $b['subtitle']}<a href="//4moe.com/s/su/st/1/{$b['subtitle']}"><i>{$b['subtitle']}</i></a>{else}<i>　</i>{/if}</li>
			<li style="text-align:left">
				<a href="//4moe.com/s/rlf/st/1/{$b['sdtype']}/1/"><i>[{$_G['seanime']['themefilter'][$b['sdtype']]['pval']}]</i></a>
				<a href="//4moe.com/s/s/{$b['sid']}" target="_blank"><i>{$b['sname']}</i></a>
				<!--{if $b['outstation']==1}-->
				<a target="_blank" href="https://share.dmhy.org{$b['outlink']}"><i style="color:#CC9 !important">[动漫花园]</i></a>
				<!--{elseif $b['subtitle']=='Leopard-Raws'}-->
				<a target="_blank" href="http://leopard-raws.org/"><i style="color:#C99 !important">[Leopard]</i></a>
				<!--{elseif $b['outstation']==2}-->
				<a target="_blank" href="{$b['outlink']}"><i style="color:#C9C !important">[NYAA]</i></a>
				<!--{else}-->
				<i style="color:#9CC !important">[本站]</i>
				<!--{/if}-->
			</li>
			<li>
				<a class="baeffect" rel="external nofollow"  href="//4moe.com/d/{$b['sid']}" target="_blank"><i>
				<!--{if $b['sloc_type']==1}-->
				torrent
				<!--{elseif $b['sloc_type']==2}-->
				磁力
				<!--{elseif $b['sloc_type']==3}-->
				Link
				<!--{elseif $b['sloc_type']==4}-->
				网盘{if $b['pw']}{$_G['ssear']['pw']['sname']}:{$b['pw']}{/if}
				<!--{/if}-->
				</i></a>
			</li>
			<li><i>{$b['size']}</i></li>
			<li><i>{$b['stimeline']}</i></li>
		</ul>
		<!--{/loop}-->
	</div>
</div>
<div class="pageset">共 {$_G['maxpage']} 页/ {$_G['maxrow']} 个结果 </div>
</div>



<!--{subtemplate main/footer}-->