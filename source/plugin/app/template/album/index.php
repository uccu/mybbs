<pre>
<!--{loop $g['template'] $k=>$v}-->
<h2><!--{eval echo $k}--></h2>
<p><!--{eval var_dump($v)}--></p>
<!--{/loop}-->
</pre>

<!--{template _header}-->
<script type="text/javascript">
	
</script>
<div class="l_body">
	<div class="l_body_z">
    	<div class="l_body_z_bottom">刀剑乱舞（<font color="#5cbac0">{$pictures.pid}</font>/{$pictures.array}）</div>
    	<div class="l_body_z_top">
            <div class="l_body_z_top_content">
            	<img src="images/xct_07.png" class="l_body_tu2"/>
            	<div class="l_body_left"><img src="images/xc_03.png" /></div>
                <div class="l_body_right"><img src="images/xc_05.png" /></div>
            </div>
        </div>
		{if $pictures['tag']}
        <div class="l_body_tag">
			<!--{loop $pictures['tag'] $k => $v}-->
				<div>{$v}</div>
			<!--{/loop}-->
            
            <span><img src="images/xc_10.png" /></span>
        </div>
		{/if}
		<div style="width:100%;height:10px;"></div>
        <div class="l_body_content">
        	镰仓时代的刀工，粟田口国吉所作打刀。随身跟着一只小狐狸，除了有想表达的感情，其他都让狐狸来表达。而且会以观察他人反应为乐。并不是为了掩饰感情，而是不擅长和人交际。
        </div>
    </div>
</div>
<div class="l_lunbo">
<style>
.pre_x{
position:absolute;width:38px;height:38px;top:38px;left:0;background:url(/images/xct_27.png)
}
.aft_x{
position:absolute;width:38px;height:38px;top:38px;right:0;background:url(/images/xct_30.png)
}
.l_lunbo_z_3{width:170px;height:130px;float:none;display:inline-block}
.bor{width:170px;height:130px;border:2px solid #5cbac0;padding:4px;}
</style>
<div class="pr center-block" style="width:1050px;">
	<div class="pre_x"></div>
	<div class="l_lunbo_z text-center pr">
        <div class="l_lunbo_z_3 bor"><img src="images/xct_19.png" class="l_lunbo_tu3"/></div>
        <div class="l_lunbo_z_3"><img src="images/xct_21.png" class="l_lunbo_tu3"/></div>
        <div class="l_lunbo_z_3"><img src="images/xct_23.png" class="l_lunbo_tu3"/></div>
        <div class="l_lunbo_z_3"><img src="images/xct_25.png" class="l_lunbo_tu3"/></div>
        <div class="l_lunbo_z_3"><img src="images/xct_21.png" class="l_lunbo_tu3"/></div>
    </div>
	<div class="aft_x"></div>
</div>

</div>
<!--{template _footer}-->