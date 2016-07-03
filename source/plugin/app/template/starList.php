<!--{subtemplate _header}-->
<header nav=1></header>
<style>
.ip_tu_1{margin:9px}
</style>
<div class="a_cos_top">
	<div class="a_cos_top_con">
    	<div class="a_cos_top_con_1">COS明星</div>
        <div class="a_cos_top_con_2"></div>
         <div class="a_cos_top_con_3">
            <a href="/app/starlist/index/1">默认排序</a>&nbsp;|&nbsp;<a href="/app/starlist/index/1/fans">人气排序</a></div>
    </div>
</div>
<div class="container" style="width: 1040px;overflow:hidden;height:auto;min-height:500px">
<!--{loop $list $c}-->
    	<div class="ip_tu_1">
        	<a href="/app/usercenter/index/{c.uid}"><div class="ip_tu_1_1"><img src="/pic/{c.thumb}.medium.jpg" class="ip_tu1"></div></a>
            <div class="ip_tu_1_2">
            	<div class="ip_1_2_1"><img src="/pic/{c.avatar}.avatar.jpg" class="ip_tu3"></div>
                <div class="ip_1_2_2">{c.nickname}</div>
                <div class="ip_wenzi_right">
                {if $c['sign']}签约明星{else}明星COSER{/if}
                </div>
            </div>
            <div class="ip_tu_1_3"><div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2"></div>
            <div class="ip_1_2_4">{c.fans}</div></div>
        </div>
<!--{/loop}-->
        

</div>


<nav class="text-center">
                    <ul class="pagination pageset">
                        <script>
                            getPageSet({currentPage},{maxPage},'href','{g.plugin}/{g.control}/{g.method}/',
                            (folder[5]?'/'+folder[5]:'')+(folder[6]?'/'+folder[6]:'')+
                            (folder[7]?'/'+folder[7]:''));
                            j('.a_cos_top_con_3 a').eq(folder[5]?1:0).css('color','#75cbdb')
                        </script>
                    </ul>
                </nav>
<!--{subtemplate _footer}-->