<!--{subtemplate _header}-->
<div class="t_body_z" style="height:auto;margin: 50px auto;min-height:600px">
    	<div class="q_p_z_1">
        	<div class="h_p_z_1_left">视频</div>
            <div class="h_p_z_1_right"></div>
        </div>
        <div class="q_body_z_1">
        	<a href="/app/video/admin"><div class="q_body_z_1_1">管理</div></a>
            <a href="/app/video/update"><div class="q_body_z_1_1">上传</div></a>
        </div>
    	<div class="d_shipin_1" style="overflow:hidden;height:auto">
            <!--{loop $list $v}-->
            <div class="d_shipin_1_1" style="margin-bottom:20px">
            	<a>
            	<div class="t_z_2_2_1" style="background-image:url(/pic/{v.thumb}.medium.jpg);background-size:cover">
                	<div class="t_z_2_2_1_text">{v.title}</div>
                    <div class="t_z_2_2_1_tu1"><img src="images/xq_71.png"></div>
                </div></a>
                <div class="t_z_2_2_1_del" ><img vid="{v.vid}" class="cp" src="images/bc_03.png"></div>
            </div>
            <!--{/loop}-->
            
    	</div>
    </div>
    <script>
j('.t_z_2_2_1_del img').click(function(){
    var vid = j(this).attr('vid');
    show_alert(2,'确认删除该视频？',function(){
        j.post('/app/video/delete',{vid:vid},function(d){
            if(d.code==200)show_alert(1,'删除视频成功~',function(){
                location.reload(true)
            });
        })
    })
})
</script>
    <!--{subtemplate _footer}-->