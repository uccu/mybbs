 <!--{subtemplate _header}-->
 <header nav="5"></header>
<div class="q_body">
	<div class="q_body_z">
    	<div class="q_p_z_1">
        	<div class="h_p_z_1_left">相册</div>
            <div class="h_p_z_1_right"></div>
        </div>
    	<div class="q_body_z_1">
        	<a href="/app/album/admin"><div class="q_body_z_1_2">管理</div></a>
            <a href="/app/album/photoupdate"><div class="q_body_z_1_1">上传</div></a>
            <a href="/app/album/creationphoto"><div class="q_body_z_1_1">创建</div></a>
            
        </div>
        <div class="d_p_z_2">
        <!--{loop $list $v}-->
            <div class="d_p_z_2_1">
            	<div class="d_p_z_2_1_top pr" style="background-repeat: no-repeat;background-image: url(/images/xq_48.png);">
                	<a href="/app/album/admin_pic/{v.aid}">
						{if $v['thumb']}
						<div class="pa" style="background-image:url(/pic/{$v.thumb}.medium.jpg);background-size:cover;width:167px;height:167px;top:16px;left:16px" data-toggle="tooltip" data-placement="bottom" title="进入相册内图片管理"></div>
						{/if}
					</a>
					<div class="d_p_z_2_top_num">{$v.count}</div>
					<div class="d_p_z_2_top_del"><img aid="{v.aid}" class="cp" src="images/bc_03.png"></div>
                </div>
                <div class="d_p_z_2_1_bottom">{$v.title}</div>
            </div>
        <!--{/loop}-->
        </div> 
        
    </div>
</div>
<script>
j('.d_p_z_2_top_del img').click(function(){
    var aid = j(this).attr('aid');
    show_alert(2,'确认删除该相册？',function(){
        j.post('/app/album/delete',{aid:aid},function(d){
            if(d.code==200)show_alert(1,'删除相册成功~',function(){
                location.reload(true)
            });else show_alert(3,d.desc)
        })
    })
})
</script>
<!--{subtemplate _footer}-->