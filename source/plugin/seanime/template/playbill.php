<!--{subtemplate seanime:header}-->
<!--{eval addcss()}-->
<!--{eval addjs()}-->
<div class="playbill">
<!--{loop $na $k=>$v}-->

<h3>星期{v}</h3>
<div>
<ul>
<!--{loop $playbill_14[$k] $v1}-->
<li>
<a href="seanime/lists/aid/{v1.aid}" target="_top" class="t button-1 bgc-6 bgc-h6"><i>{if $v1['newname']}{v1.newname}{else}{v1.name}{/if} <em>（第{v1.lastnum}话）</em></i></a>

</li>
<!--{/loop}-->
<!--{loop $playbill_7[$k] $v1}-->
<li>
<a href="seanime/lists/aid/{v1.aid}" target="_top" class="t button-1 bgc-7 bgc-h7"><i>{if $v1['newname']}{v1.newname}{else}{v1.name}{/if} <em>（第{v1.lastnum}话）</em></i></a>

</li>
<!--{/loop}-->
<!--{loop $playbill_24[$k] $v1}-->
<li>
<a href="seanime/lists/aid/{v1.aid}" target="_top" class="t button-1 bgc-5 bgc-h5"><i>{if $v1['newname']}{v1.newname}{else}{v1.name}{/if} <em>（第{v1.lastnum}话）</em></i></a>

</li>

<!--{/loop}-->
</ul>
</div>


<!--{/loop}-->
</div>
<script>
	jq(function(){jq( ".playbill" ).accordion( "option", "active", {$w} )});
	
	
</script>
<!--{subtemplate seanime:footer}-->