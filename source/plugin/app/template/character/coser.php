 <!--{subtemplate _header}-->
  <header nav="1"></header>
 <style>
.ip_tu_1s{margin:8px}
.ip_tu_zong{height:auto;overflow:hidden}
.tj_z1{height:;min-height:650px}
.ip_1_2_3{float:left}
.ip_1_2_4{float:left;width:auto}
 </style>
<div class="a_cos_top">
	<div class="b_cos_top_con">
    	<div class="b_cos_top_con_1">{char.name}</div>
        <div class="b_cos_top_con_2">&nbsp;|&nbsp;<a>{char.pname}</a></div>
         <div class="b_cos_top_con_3"><a href="/app/character/coser/{char.cid}">默认排序</a>&nbsp;|&nbsp;<a href="/app/character/coser/{char.cid}/1/fans">人气排序</a></div>
    </div>
</div>

<div class="tj_z1">
    <div class="ip_tu_zong">
<!--{loop $list $c}-->

    	<div class="ip_tu_1s">
        	<a href="/app/usercenter/index/{c.uid}"><div class="ip_tu_1_1"><img src="/pic/{c.thumb}.medium.jpg" class="ip_tu1"></div></a>
            <div class="ip_tu_1_2">
            	<div class="ip_1_2_1"><img src="/pic/{c.avatar}.avatar.jpg" class="ip_tu3"></div>
                <div class="ip_1_2_2">{c.nickname}</div>
                <div class="ip_1_2_4">{c.fans}</div>
                <div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2"></div>
                
            </div>
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
                            j('.b_cos_top_con_3 a').eq(folder[6]?1:0).css('color','#75cbdb')
                        </script>
                    </ul>
                </nav>

<!--{subtemplate _footer}-->