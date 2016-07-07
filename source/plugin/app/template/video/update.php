<!--{subtemplate _header}-->
<header nav="5"></header>
<div class="t_body_z" style="height:auto;margin: 50px auto;min-height:650px">
    	<div class="q_p_z_1">
        	<div class="h_p_z_1_left">视频</div>
            <div class="h_p_z_1_right"></div>
        </div>
        <div class="q_body_z_1">
        	<a href="/app/video/admin"><div class="q_body_z_1_1">管理</div></a>
            <a href="/app/video/update"><div class="q_body_z_1_2">上传</div></a>
        </div>
    	<div class="p_body_1" style="height:auto">
            <form id="createVideo">
                <div class="p_body_1_1">标题<input type="text" name="title" class="o_text_1"></div>
                <div class="p_body_1_1">Flash地址<input type="text" name="addr" class="o_text_1"></div>
            </form>
                <div class="p_body_1_1">图片<button class="o_text_1" style="background:#ff6090;color:#fff" data-toggle="tooltip" data-placement="right" title="推荐 600x375">选择图片</button></div>
                <div class="dn"><input type="file" id="thumbpic" accept="image/*"></div>
                <div class="text-left" style="margin-top:20px;margin-left: 125px;"><img style="height:100px" id="thumbp"></div>
        </div> 
    	
        <div class="s_body_z_2">上传</div>
    </div>
    <script>
                j('#thumbpic').change(function(){
                    var file = this.files[0];
                    if(!file)return;
                    if(!file || !/image\/\w+/.test(file.type))show_alert(3,'非图片类型文件！');
                    var reader=new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload=function(e){
                        var img=new Image();
                        img.onload=function(e){
                            var cc=j('<canvas>'),c=cc[0],cxt=c.getContext("2d"),width=img.width,height=img.height;
                            if(img.width>800){width=800;height*=800/img.width}
                            cc.attr({width:width,height:height});
                            cxt.drawImage(img,0,0,width,height);
                            j('#thumbp')[0].src=c.toDataURL();
                        };
                        img.src=this.result;
                    }
                });
                j('.p_body_1_1 button').click(function(){j('#thumbpic').click()});
            j('.s_body_z_2').bind('click',function(){
                var v = j('[name=title]').val(),z=j('[name=addr]').val();
                if(!v || v=='标题'){show_alert(3,'标题不能为空');return}
                if(!z || z=='地址'){show_alert(3,'地址不能为空');return}
                if(!j('#thumbpic').val()){show_alert(3,'未选择图片');return}
                j(this).unbind('click');
                j.post('/app/video/create',{title:v,addr:z,raw_base64_picz:j('#thumbp').attr('src'),large:1,medium:1,box:'video'},function(d){
                    if(d.code==200)show_alert(1,'创建成功',function(){
                        location = '/app/video/lists';
                    });else show_alert(3,d.desc);
                },'json')
            })
    </script>
    <!--{subtemplate _footer}-->
