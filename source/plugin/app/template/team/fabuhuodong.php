<!--{subtemplate _header}-->
<header nav="4"></header>
<style>

</style>
<div class="u_body" style="height:auto">
	<div class="u_b_z" style="height:auto;min-height:710px;overflow:hidden">
		<div class="u_b_z_1" style="margin-bottom:10px">
        	<div class="u_b_z_1_1">{team.name}</div>
            <a href="/app/team/mybasis"><div class="u_b_z_1_3">基本信息</div></a>
            <a href="/app/team/myphoto"><div class="u_b_z_1_3">相册</div></a>
            <a href="/app/team/myvideo"><div class="u_b_z_1_3">视频</div></a>
            <!--a href="/app/team/myrole"><div class="u_b_z_1_3">COS角色</div></a-->
            <a href="/app/team/myactivity"><div class="u_b_z_1_2">社团活动</div></a>
        	<a href="/app/team/myapply"><div class="u_b_z_1_3">申请通知</div></a>
        </div>

    	<div class="z_body_1">发布新活动</div>
    	<div class="z_body_2"><input type="text" class="z_body_2_text1" value="标题" onfocus="if (value =='标题'){value =''}" onblur="if (value ==''){value='标题'}"></div>
    	<div class="z_body_3"><textarea class="z_body_text2"></textarea></div>
    	<div class="z_body_4 pr">
        	<img src="images/xcsc_17.png" class="z_body_4_1 cp" style="height:auto">
            <input type="file" style="display:none" id="pica" />
            <button class="btn btn-default pr dn" style="left:20px;color:#999">重新选择</button>

        </div>
        <a><div class="z_body_5 cp">发布</div></a>
    </div>
</div>
            <script>
                j('#pica').change(function(){
                    j('.z_body_4 button').show();
                    var file = this.files[0];
                    if(!file || !/image\/\w+/.test(file.type))show_alert(3,'非图片类型文件！');
                    var reader=new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload=function(e){
                        var img=new Image();
                        img.onload=function(e){
                            var cc=j('<canvas>'),c=cc[0],cxt=c.getContext("2d"),width=img.width,height=img.height;
                            if(img.width>1000){width=1000;height*=1000/img.width}
                            cc.attr({width:width,height:height});
                            cxt.drawImage(img,0,0,width,height);
                            j('.z_body_4_1')[0].src=c.toDataURL();
                        };
                        img.src=this.result;
                    }
                });
                j('.z_body_4_1,.z_body_4 button').click(function(){j('#pica').click()});
                j('.z_body_5').click(function(){
                    var v = j('.z_body_2_text1').val(),z=j('.z_body_text2').val();
                    if(!v || v=='标题')return;
                    if(!z)return;
                    j.post('/app/team/new_activity',{title:v,content:z,raw_base64_picz:j('.z_body_4_1').attr('src'),large:1,raw:1,medium:1,box:'team'},function(d){
                        if(d.code==200)show_alert(1,'创建成功',function(){
                            location = '/app/team/myactivity';
                        });
                    },'json')
                })
            </script>

<!--{subtemplate _footer}-->