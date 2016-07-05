<!--{template _header}-->

<header nav="4"></header>
<div class="o_body">
	<div class="o_body_z">
    	<div class="o_body_z_top">
        	<div class="o_body_z_top_1">账户资料</div>
            <a href="/app/usercenter/centerupdate"><div class="o_body_z_top_2">基本信息</div></a>
            <a href="/app/usercenter/centerupdatepwd"><div class="o_body_z_top_3">修改密码</div></a>
        </div>
        <div class="o_body_z_con">
        	<div class="o_body_z_con_z">
            	<div class="o_body_z_left">
                	<div class="o_body_z_left_1">昵称<input type="text" value="{me.nickname}" name="nickname" onfocus="if (value =='{me.nickname}'){value =''}" onblur="if (value ==''){value='{me.nickname}'}" class="o_text_1"></div>
                    <div class="o_body_z_left_1">地区<input type="text" value="{me.area}" name="area" onfocus="if (value =='{me.area}'){value =''}" onblur="if (value ==''){value='{me.area}'}" class="o_text_1"></div>
                    <div class="o_body_z_left_1">年龄<input type="text" value="{me.age}岁" name="age" onfocus="if (value =='{me.age}岁'){value =''}" onblur="if (value ==''){value='{me.age}岁'}" class="o_text_1"></div>
                    <div class="o_body_z_left_1">星座<input type="text" value="{me.constel}" name="constel" onfocus="if (value =='{me.constel}'){value =''}" onblur="if (value ==''){value='{me.constel}'}" class="o_text_1"></div>
                    <div class="o_body_z_left_1">爱好<input type="text" value="{me.interest}" name="interest" onfocus="if (value =='{me.interest}'){value =''}" onblur="if (value ==''){value='{me.interest}'}" class="o_text_1"></div>
                </div>
                <div class="o_body_z_right">
                	<img src="/pic/{me.avatar}.avatar.jpg" class="o_body_z_right_tu1 avatar">
                	<div class="o_body_z_right_fg avatar cp">更换头像</div>
                    <input type="file" id="changeAvatar" style="display:none">
                </div>
                <div class="o_body_z_right">
                	<img src="/pic/{me.thumb}.medium.jpg" class="o_body_z_right_tu1 thumb">
                	<div class="o_body_z_right_fg thumb cp">更换封面</div>
                    <input type="file" id="changeThumb" style="display:none">
                </div>
            </div>
            <div class="o_body_con_x">保存</div>
                    <script>
                        j('.o_body_z_right_fg.avatar').click(function(){
                            j('#changeAvatar').click();
                        });j('#changeAvatar').change(function(){
                            if(!j(this).val())return;
                            var v = {avatar:1,box:'user',auto:1},f = packFormData(j(this),v);
                            j.ajax({
                                data:f,contentType:false,processData:false,type:'post',url:'/app/picture/upload',
                                success:function(d){
                                    if(d.code==200)j.post('/app/usercenter/change_avatar',{avatar:d.data.e},function(){
                                        show_alert(1,'更改成功',function(){
                                            j('.o_body_z_right_tu1.avatar').attr('src','/pic/'+d.data.e+'.avatar.jpg');
                                        });
                                    },'json');
                                }
                            })
                        });
                        j('.o_body_z_right_fg.thumb').click(function(){
                            j('#changeThumb').click();
                        });j('#changeThumb').change(function(){
                            if(!j(this).val())return;
                            var v = {medium:1,box:'user',auto:1},f = packFormData(j(this),v);
                            j.ajax({
                                data:f,contentType:false,processData:false,type:'post',url:'/app/picture/upload',
                                success:function(d){
                                    if(d.code==200)j.post('/app/usercenter/change_thumb',{thumb:d.data.e},function(){
                                        show_alert(1,'更改成功',function(){
                                            j('.o_body_z_right_tu1.thumb').attr('src','/pic/'+d.data.e+'.medium.jpg');
                                        });
                                    },'json');
                                }
                            })
                        });
                        j('.o_body_con_x').click(function(){
                            var d = {};
                                d.nickname = j('[name=nickname]').val(),
                                d.area = j('[name=area]').val(),
                                d.age = j('[name=age]').val(),
                                d.constel = j('[name=constel]').val(),
                                d.interest = j('[name=interest]').val();
                            if(!d.nickname){
                                show_alert(3,'昵称必须填写');return
                            }
                            j.post('/app/usercenter/change_info',d,function(d){
                                if(d.code)show_alert(1,'修改成功~',function(){
                                    location.reload(true)
                                })
                            },'json')

                        })

                    </script>
        </div>
    </div>
</div>
<!--{template _footer}-->