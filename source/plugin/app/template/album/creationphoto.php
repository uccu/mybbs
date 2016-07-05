 <!--{subtemplate _header}-->
<header nav="5"></header>
<div class="r_body" style="min-height:650px">
	<div class="r_body_z">
    	<div class="q_p_z_1">
        	<div class="h_p_z_1_left">相册</div>
            <div class="h_p_z_1_right"></div>
        </div>
        <div class="q_body_z_1">
        	
        	<a href="/app/album/admin"><div class="q_body_z_1_1">管理</div></a>
            <a href="/app/album/photoupdate"><div class="q_body_z_1_1">上传</div></a>
            <a href="/app/album/creationphoto"><div class="q_body_z_1_2">创建</div></a>
            
        </div>
    	<div class="s_body_z_3">
        	<form id="createAlbum"><div class="s_body_biaoti1"><input type="text" name="title" value="标题" onfocus="if (value =='标题'){value =''}" onblur="if (value ==''){value='标题'}" class="s_body_text1"></div></form>
        </div>
        <div class="s_body_z_2 cp">创建</div>
        <script>
            j('.s_body_z_2').click(function(){
                var v = j('[name=title]').val();
                console.log(v);
                if(!v || v=='标题')return;
                j.post('/app/album/create',j('#createAlbum').serializeArray(),function(d){
                    if(d.code==200)show_alert(1,'创建成功',function(){
                        location = '/app/album/photoupdate';
                    });else show_alert(3,d.desc)
                },'json')
            })
        
        </script>
    </div>
</div>

<!--{subtemplate _footer}-->