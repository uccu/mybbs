<!--{subtemplate _header}-->
<header nav="4"></header>
<div class="u_body" style="height:auto">
	<div class="u_b_z" style="height:auto;min-height:710px;overflow:hidden">
		<div class="u_b_z_1" style="margin-bottom:40px">
        	<div class="u_b_z_1_1">{team.name}</div>
            <a href="/app/team/mybasis"><div class="u_b_z_1_3">基本信息</div></a>
            <a href="/app/team/myphoto"><div class="u_b_z_1_2">相册</div></a>
            <a href="/app/team/myvideo"><div class="u_b_z_1_3">视频</div></a>

            <a href="/app/team/myactivity"><div class="u_b_z_1_3">社团活动</div></a>
        	<a href="/app/team/myapply"><div class="u_b_z_1_3">申请通知</div></a>
        </div>
		<div class="d_p_z_2">
        <!--{loop $list $v}-->
            <div class="d_p_z_2_1">
            	<div class="d_p_z_2_1_top pr" style="background-repeat: no-repeat;background-image: url(/images/xq_48.png);">
                	<a href="/app/album/index/{v.aid}">
						<div class="pa" style="background-image:url(/pic/{$v.thumb}.medium.jpg);background-size:cover;width:167px;height:167px;top:16px;left:16px"></div>
					</a>
					<div class="d_p_z_2_top_num">{$v.count}</div>
                </div>
                <div class="d_p_z_2_1_bottom">{$v.title}</div>
            </div>
        <!--{/loop}-->
        </div> 

	</div>
</div>

<!--{subtemplate _footer}-->