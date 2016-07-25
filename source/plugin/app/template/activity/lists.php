 <!--{subtemplate _header}-->

 <style>
 .e_st_z_1{margin-bottom:20px}
 </style>
<div class="k_body">
	<div class="k_body_z">
		<div class="q_p_z_1">
                <div class="h_p_z_1_left">社团活动</div>
                <div class="h_p_z_1_right"></div>
            </div>
		<div class="k_shetuan_z">
           <!--{loop $activity $a}-->
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
