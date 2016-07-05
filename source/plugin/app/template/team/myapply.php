<!--{subtemplate _header}-->
<header nav="5"></header>
<style>select{outline:0}</style>
<div class="u_body" style="height:auto">
	<div class="u_b_z" style="height:auto;min-height:710px;overflow:hidden">
		<div class="u_b_z_1" style="margin-bottom:40px">
        	<div class="u_b_z_1_1">{team.name}</div>
            <a href="/app/team/mybasis"><div class="u_b_z_1_3">基本信息</div></a>
            <a href="/app/team/myphoto"><div class="u_b_z_1_3">相册</div></a>
            <a href="/app/team/myvideo"><div class="u_b_z_1_3">视频</div></a>

            <a href="/app/team/myactivity"><div class="u_b_z_1_3">社团活动</div></a>
        	<a href="/app/team/myapply"><div class="u_b_z_1_2">申请通知</div></a>
        </div>
        <div class="y_body_fb">
        	<div class="y_body_fb_1">全部通过</div>
        </div>
        <!--{loop $list $u}-->
		<div class="aa_body_1">
        	<a href="/app/usercenter/index/{u.uid}"><div class="aa_body_1_1"><img src="/pic/{u.avatar}.avatar.jpg" class="aa_body_1_1_tu1"></div></a>
            <div class="aa_body_1_2"><a href="stardetails.html"><span class="aa_span_1">{u.nickname}</span></a><span class="aa_span_2">申请加入社团</span></div>
            <div class="aa_body_1_3">
            	<div class="aa_body_tongyi"><select uid="{u.uid}" class="aa_select_1"><option disabled selected></option><option value="1">同意</option><option value="2">不同意</option></select></div>
            </div>
        </div>
        <!--{/loop}-->
        <script>
            j('.aa_select_1').change(function(){
                var uid = j(this).attr('uid'),yes = j(this).val();
                j.post('/app/team/accept',{uid:uid,accept:yes},function(d){
                    if(d.code==200){
                        show_alert(1,yes==1?'已同意加入团队~':'已拒绝加入团队~',function(){
                            location.reload(true)
                        })
                    }else show_alert(3,d.desc)
                },'json')
            });
            j('.y_body_fb_1').click(function(){
                j.post('/app/team/accept_all',function(d){
                    if(d.code==200){
                        show_alert(1,'已同意所有人加入团队~',function(){
                            location.reload(true)
                        })
                    }else show_alert(3,d.desc)
                },'json')
            })
        </script>
	</div>
</div>

<!--{subtemplate _footer}-->