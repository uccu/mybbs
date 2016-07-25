<!--{subtemplate _header}-->
<header nav="5"></header>
<style>
.e_st_z_1{margin-bottom:10px}


</style>
<div class="u_body" style="height:auto">
	<div class="u_b_z" style="height:auto;min-height:710px;overflow:hidden">
		<div class="u_b_z_1" style="margin-bottom:10px">
        	<div class="u_b_z_1_1">{team.name}</div>
            <a href="/app/team/mybasis"><div class="u_b_z_1_3">基本信息</div></a>
            <a href="/app/team/myphoto"><div class="u_b_z_1_3">相册</div></a>
            <a href="/app/team/myvideo"><div class="u_b_z_1_3">视频</div></a>

            <a href="/app/team/myactivity"><div class="u_b_z_1_2">社团活动</div></a>
        	<a href="/app/team/myapply"><div class="u_b_z_1_3">申请通知</div></a>
        </div>
        <div class="y_body_fb">
            <a href="/app/team/fabuhuodong"><div class="y_body_fb_1">发布</div></a>
        </div>
        <div>
            <!--{loop $list $a}-->
            <div class="e_st_z_1">
                <a href="/app/activity/index/{a.aid}"><div class="e_st_z_1_1 bips" style="background-image:url(/pic/{a.pic}.medium.jpg);background-size:cover"></div></a>
                <div class="e_st_z_1_2">{a.title}</div>
                <a href="/app/activity/index/{a.aid}"><div class="e_st_z_1_3">查看详情</div></a>
            </div>
            
            <!--{/loop}-->
        </div>
    </div>
</div>

<!--{subtemplate _footer}-->