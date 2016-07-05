<!--{subtemplate _header}-->
<header nav="5"></header>
<div class="u_body" style="height:auto">
	<div class="u_b_z" style="height:auto;min-height:710px;overflow:hidden">
		<div class="u_b_z_1" style="margin-bottom:40px">
        	<div class="u_b_z_1_1">{team.name}</div>
            <a href="/app/team/mybasis"><div class="u_b_z_1_3">基本信息</div></a>
            <a href="/app/team/myphoto"><div class="u_b_z_1_3">相册</div></a>
            <a href="/app/team/myvideo"><div class="u_b_z_1_2">视频</div></a>
            <a href="/app/team/myactivity"><div class="u_b_z_1_3">社团活动</div></a>
        	<a href="/app/team/myapply"><div class="u_b_z_1_3">申请通知</div></a>
        </div>
		<div class="d_shipin_1" style="overflow:hidden;height:auto">
            <!--{loop $list $v}-->
            <div class="d_shipin_1_1" style="margin-bottom:20px">
            	<a href="/app/video/index/{v.vid}">
            	<div class="t_z_2_2_1" style="background-image:url(/pic/{v.thumb}.medium.jpg);background-size:cover">
                	<div class="t_z_2_2_1_text">{v.title}</div>
                    <div class="t_z_2_2_1_tu1"><img src="images/xq_71.png"></div>
                </div></a>
            </div>
            <!--{/loop}-->
            
    	</div>
	</div>
</div>

<!--{subtemplate _footer}-->