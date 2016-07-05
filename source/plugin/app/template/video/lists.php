<!--{subtemplate _header}-->
<header nav="5"></header>
<div class="t_body_z" style="height:auto;margin: 50px auto;min-height:650px">
    	<div class="q_p_z_1">
        	<div class="h_p_z_1_left">视频</div>
            <div class="h_p_z_1_right"></div>
        </div>
        {if $thisuid == $me['uid']}
        <div class="q_body_z_1">
        	<a href="/app/video/admin"><div class="q_body_z_1_1">管理</div></a>
            <a href="/app/video/update"><div class="q_body_z_1_1">上传</div></a>
        </div>
        {/if}
    	<div class="d_shipin_1" style="overflow:hidden;height:auto;text-shadow: 0 0 10px #000;">
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
    
    <!--{subtemplate _footer}-->