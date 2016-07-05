<!--{subtemplate _header}-->
<header nav="5"></header>
<div class="u_body" style="height:auto">
	<div class="u_b_z" style="height:auto;min-height:710px;overflow:hidden">
		<div class="u_b_z_1" style="margin-bottom:10px">
        	<div class="u_b_z_1_1">{team.name}</div>
            <a href="/app/team/mybasis"><div class="u_b_z_1_3">基本信息</div></a>
            <a href="/app/team/myphoto"><div class="u_b_z_1_3">相册</div></a>
            <a href="/app/team/myvideo"><div class="u_b_z_1_3">视频</div></a>

            <a href="/app/team/myactivity"><div class="u_b_z_1_3">社团活动</div></a>
        	<a href="/app/team/myapply"><div class="u_b_z_1_3">申请通知</div></a>
        </div>
		<div class="ip_tu">
	<div class="ip_tu_zs">
<!--{loop $list $c}-->
    	<div class="ip_tu_1" style="    margin: 8px;">
        	<a href="/app/character/coser/{c.cid}"><div class="ip_tu_1_1"><img src="/pic/{c.thumb}.medium.jpg" class="ip_tu1"></div></a>
            <div class="ip_tu_1_2">
            	<div class="ip_wenzi_left">{c.name}</div>
                <div class="ip_1_2_3"><img src="images/xqq_08.png" class="ip_tu2"></div>
                <div class="ip_1_2_4">{c.fans}</div>
            </div>
            <div class="ip_weizi_bot">出自：{c.pname}</div>
        </div>
        <!--{/loop}-->
    </div>
   
</div>
	</div>
</div>

<!--{subtemplate _footer}-->