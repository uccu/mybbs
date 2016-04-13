<!--{subtemplate main/header}-->
<!--{eval $r = $_G['seanime']['resource']['page']}-->
<!--{eval $ts = $_G['seanime']['resource']['theme']}-->
<!--{eval addcss();}-->
<div style="
    height: 100px;
"></div>

<ul class="resource_info">
	<div class='title'>INFO</div>
	<li>动漫出处：{$ts['name']}</li>
	<li>所在主题：{$ts['name']}</li>
	<li>资源类型：{$r['formname']}</li>
	<li>主题管理：{$ts['username']}</li>
	<li>资源名称：{$r['sname']}</li>
	<li>资源分辨率：{$r['quality']}</li>
	<li>资源大小：{$r['size']}</li>
	<li>字幕组/翻译：{$r['subtitle']}</li>
	<li>上传日期：{$r['date']}</li>
	<li>上传者：{$r['username']}</li>
	<li>点击次数：{$r['sshowtimes']}</li>
	<li>下载次数：{$r['sdowntimes']}</li>
	<!--{if $r['hash']}-->
	<li>hash：{$r['hash']}</li>
	<li>magnet：<a href="magnet:?xt=urn:btih:{$r['hash']}">magnet:?xt=urn:btih:{$r['hash']}</a></li>
	<!--<li>thunder：<a href="{$r['thunder']}">迅雷下载</a></li>-->
	<!--{if $_G['uid']}-->
	<li>torrent1：<a href="//4moe.com/dt/{$r['sid']}">下载方式1</a><i style="color:red">(推荐)</i></li>
	<li>torrent2：<a href="//4moe.com/dv/{$r['sid']}">下载方式2</a></li>
	<li>torrent3：<a href="//4moe.com/dr/{$r['sid']}">下载方式3</a></li>
	<li>torrent4：<a href="//4moe.com/dc/{$r['sid']}">下载方式4</a></li>
	<li>torrent5：<a href="//4moe.com/dz/{$r['sid']}">下载方式5</a></li>
	<li>torrent6：<a href="//4moe.com/di/{$r['sid']}">下载方式6</a></li>
	<!--{else}-->
	<li>torrent1：登陆后显示下载链接！<i style="color:red">(推荐)</i></li>
	<li>torrent2：登陆后显示下载链接！</li>
	<li>torrent3：登陆后显示下载链接！</li>
	<li>torrent4：登陆后显示下载链接！</li>
	<li>torrent5：登陆后显示下载链接！</li>
	<li>torrent6：登陆后显示下载链接！</li>
	<!--{/if}-->
	<!--{if $r['base32']}-->
	<li>magnet：<a href="magnet:?xt=urn:btih:{$r['base32']}">magnet:?xt=urn:btih:{$r['base32']}</a></li>
	<!--{/if}-->
	<!--{/if}-->
	<!--{if $r['sloc_type']==1}-->
	<!--{if $_G['uid']}-->
	<li>站内下载：<a href="//4moe.com/d/{$r['sid']}">下载</a></li>
	<!--{else}-->
	<li>站内下载：登陆后显示下载链接！</li>
	<!--{/if}-->
	<!--{elseif $r['sloc_type']==2}-->
	<li>magnet：<a href="//4moe.com/d/{$r['sid']}">magnet:?xt=urn:btih:{$r['base32']}</a></li>
	<!--{elseif $r['sloc_type']==3}-->
	<li>直连：<a href="//4moe.com/d/{$r['sid']}">站外下载</a></li>
	<!--{elseif $r['sloc_type']==4}-->
	<li>网盘：<a href="//4moe.com/d/{$r['sid']}">网盘下载</a>　密码：<p>{$r['pw']}</p></li>
	<!--{/if}-->
</ul>
<!--{if $r['hash']}-->
<ul class="resource_info">
	<div class='title'>LIST</div>
	<a href="#" class="getlist" target="_blank"><i class="t">获取文件列表</i></a>
	<i style='margin:0 10px'>(第一次获取可能超级慢)|</i>
	<i class="error_report t cp" title="如果遇到乱码/没有显示/显示错误时提交">错误提交</i>
	<script>
	jq('.getlist').attr('href','//233hd.com/torrent2.php?poa&x='+_s.s_a()[3]);
	jq('.error_report').click(function(){
		jq.post('//4moe.com/s/ajax/error_report/',{search:btoa(location)},function(d){if(d.code==200)alert('提交成功')},'json')
	}).tooltip();
	</script>
</ul>
<!--{/if}-->
<!--{if $r['des'] || $r['subtitle']==='Leopard-Raws'}-->
<ul class="resource_info">
	<div class='title'>DETAIL</div>
	<li>{if $r['des']}{$r['des']}{else}<img src="http://i4.piimg.com/1f2422a328733ab9.png" />{/if}</li>
</ul>
<!--{/if}-->
<ul class="resource_info comment">
	<div class='title'>COMMENT</div>
	<div class='comment_extend'>
		<div class='comment_reply'></div>
		<div class='pageset_reply'></div>
		<li class='comment_post'>
			<div class='avator_pic'>
				<img src='http://4moe.com/uc_server/avatar.php?uid={$_G['uid']}&size=small' />
			</div>
			<div class="comment_info">
				<textarea placeholder="暂时无法评论"></textarea>
				<div class="biaoqing">
					<i class="bsh_f1 yanwenzi">颜文字( ´_ゝ｀)</i>
					<i class="bsh_f1">@</i>
					<i class="bsh_f1 y">Post</i>
					<div class="biaoqing_box">
						<a>(⌒▽⌒)</a><a>（￣▽￣）</a><a>(=・ω・=)</a><a>(｀・ω・´)</a><a>(〜￣△￣)〜</a><a>(･∀･)</a><a>(°∀°)ﾉ</a><a>(￣3￣)</a><a>╮(￣▽￣)╭</a><a>( ´_ゝ｀)</a><a>←_←</a><a>→_→</a><a>(&lt;_&lt;)</a><a>(&gt;_&gt;)</a><a>(;¬_¬)</a><a>("▔□▔)/</a><a>(ﾟДﾟ≡ﾟдﾟ)!?</a><a>Σ(ﾟдﾟ;)</a><a>Σ( ￣□￣||)</a><a>(´；ω；`)</a><a>（/TДT)/</a><a>(^・ω・^ )</a><a>(｡･ω･｡)</a><a>(●￣(ｴ)￣●)</a><a>ε=ε=(ノ≧∇≦)ノ</a><a>(´･_･`)</a><a>(-_-#)</a><a>（￣へ￣）</a><a>(￣ε(#￣) Σ</a><a>ヽ(`Д´)ﾉ</a><a>(╯°口°)╯(┴—┴</a><a>（#-_-)┯━┯</a><a>_(:3」∠)_</a><a>(笑)</a><a>(汗)</a><a>(泣)</a><a>(苦笑)</a>
					</div>
				</div>
			</div>
		</li>
	</div>
	<div class="comment_ajax">
	</div>
	<div class='pageset'>
	<script>
		jq('.resource_info img').lazyload({effect : "fadeIn" });
		/*document.write(_f.sp(1,{$_G['seanime']['resource']['comment']['maxpage']}));*/
	
	</script>
	</div>
</ul>

<!--{subtemplate main/footer}-->