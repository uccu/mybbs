<!--{subtemplate _header}-->
<header nav="2"></header>
<style>
.c_td_1{margin:7px}
</style>
<div class="a_cos_top">
	<div class="a_cos_top_con">
    	<div class="a_cos_top_con_1">COS团体</div>
        <div class="a_cos_top_con_2"></div>
         <div class="a_cos_top_con_3"><a href="/app/teamlist/index/1">默认排序</a>&nbsp;|&nbsp;<a href="/app/teamlist/index/1/fans">人气排序</a></div>
    </div>
</div>
<div class="container" style="width: 1040px;overflow:hidden;height:auto;min-height:500px">
    <!--{loop $list $t}-->
    	<div class="c_td_1">
        	<div class="c_td_1_1">
            	<a href="/app/teamcenter/index/{t.tid}" >
                    <div class="c_td_1_1 bips" style="background-image:url(/pic/{t.pic}.medium.jpg);background-size:cover">
                        <div class="c_td_1_1_z">
                            <div class="c_td_1_z_1 "><img class="img-circle" style="width:60px;height:60px" src="/pic/{t.thumb}.avatar.jpg"></div>
                            <div class="c_td_1_z_2">{t.name}</div>
                        </div>
                    </div>
                </a>
                <div class="c_td_1_2">{t.desc}</div>
            </div>
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