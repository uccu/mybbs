 <!--{subtemplate _header}-->
  <header nav="1"></header>
 <style>
 .ip_1_2_3{float:right}
.ip_1_2_4{float:right;width:auto}
 </style>
<div class="a_cos_top">
	<div class="a_cos_top_con">
    	<div class="a_cos_top_con_1">COS角色</div>
        <div class="a_cos_top_con_2"></div>
         <div class="a_cos_top_con_3"><a href="app/character/lists/1">默认排序</a>&nbsp;|&nbsp;<a href="app/character/lists/1/fans">人气排序</a></div>
    </div>
</div>

<div class="ip_tu">
	<div class="ip_tu_zs">
<!--{loop $list $c}-->
    	<div class="ip_tu_1" style="    margin: 8px;">
        	<a href="/app/character/coser/{c.cid}"><div class="ip_tu_1_1 bips" style="background-image:url(pic/{c.thumb}.medium.jpg);height: 280px;"></div></a>
            <div class="ip_tu_1_2">
            	<div class="ip_wenzi_left">{c.name}</div>
                <div class="ip_1_2_4">{c.fans}</div>
                <div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2"></div>
                
            </div>
            <div class="ip_weizi_bot">出自：{c.pname}</div>
        </div>
        <!--{/loop}-->
    </div>
   
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