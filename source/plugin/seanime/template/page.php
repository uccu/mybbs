<!--{subtemplate seanime:header}-->
<!--{eval addcss()}-->
<!--{eval addjs()}-->
<div class="sname">
	<i>{r.sname}</i>
</div>
<div class="t">
	<a class="button-1 bgc-1 bgc-h1" href="seanime/lists/sdtype/{r.sdtype}" target="_top"><i class="sdtype change">{r.sdtype}</i></a>
	{if $r['aid']!=69}<a class="button-1 bgc-6 bgc-h6" href="seanime/lists/aid/{r.aid}" target="_top"><i>{r.name}</i></a>{/if}
	{if $r['subtitle']}<a class="button-1 bgc-7 bgc-h7" href="seanime/lists/subtitle/{r.subtitle}" target="_top"><i>{r.subtitle}</i></a>{/if}
	{if $r['outlink']}
	<a class="button-1 bgc-5 bgc-h5" href="{r.outlink}" target="_top"><i>
		{if $r['outstation']==1}DMHY
		{elseif $r['outstation']==2}NYAA
		{elseif $r['outstation']==3}Leopard
		{else}源站
		{/if}
	</i></a>{/if}
</div>
<hr />
<!--{if $right>7 || $user['uid']==$r['suid']}-->
<div class="t">
	<a href="seanime/upload/sid/{r.sid}" class="t button-2 b-1 b-h5 c-h5 upd_re"><i>修改</i></a>
	<a class="t button-2 b-1 b-h5 c-h5 del_re"><i>删除</i></a>
	<script>
		jq('.del_re').click(function(){
			if(confirm('确认删除？')){
				jq.post('seanime/ajax/resource/del',{sid:{r.sid}},function(d){
					if(!d.code){alert(d.data);return}
					window.parent.location.hash = '';
					window.parent.location.reload(true);
				},'json');
			}

		})
		
	</script>
</div>
<hr />
<!--{/if}-->
<div class="t" style=" overflow: hidden;margin: 10px;">
	<ul>
	<li><i>up： {r.uname}</i></li>
	{if $r['hash']}<li><i>hash(sha1)： {r.hash}</i></li>{/if}
	{if $r['base32']}<li><i>hash(base32)： {r.base32}</i></li>{/if}
	{if $r['size']}<li>size： <i class="size change">{r.size}</i></li>{/if}
	<li><i>date： {r.date}</i></li>
	</ul>
</div>
<hr />
<div class="t">
	{if $r['sloc_type']==1}
	<a class="button-1 bgc-1 bgc-h1" href="seanime/down/straight/{r.sid}/{r.stimeline}" target="_top"><i>torrent</i></a>
	<a class="button-1 bgc-1 bgc-h1" href="seanime/down/thunder/{r.sid}/{r.stimeline}" target="_top"><i>torrent</i></a>
	{elseif $r['sloc_type']==2}
	<a class="button-1 bgc-2 bgc-h2" href="seanime/down/straight/{r.sid}/{r.stimeline}" target="_top"><i>magnet</i></a>
	<a class="button-1 bgc-1 bgc-h1" href="seanime/down/thunder/{r.sid}/{r.stimeline}" target="_top"><i>torrent</i></a>
	{elseif $r['sloc_type']==3}
	<a class="button-1 bgc-7 bgc-h7" href="seanime/down/straight/{r.sid}/{r.stimeline}" target="_top"><i>站外打开</i></a>
	{elseif $r['sloc_type']==4}
	<a class="button-1 bgc-6 bgc-h6" href="seanime/down/straight/{r.sid}/{r.stimeline}" target="_top"><i>网盘 {if $r['pw']}密码:{r.pw}{/if}</i></a>
	
	{/if}
</div>
{if $r['sdes']}
<hr />
<div class="t" style=" overflow: hidden;margin: 10px;">
	{r.sdes}
	
	
</div>
{/if}

{if $r['hash']}
<hr />
<div class="t">
	<a class="button-1 bgc-4 bgc-h4" href="http://233hd.com/torrent2.php?poa&x={r.sid}" target="_blank"><i>获取文件列表</i></a>
	
	
</div>
{/if}
<!--{subtemplate seanime:footer}-->