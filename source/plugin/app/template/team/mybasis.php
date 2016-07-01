<!--{subtemplate _header}-->
<div class="u_body">
	<div class="u_b_z">
		<div class="u_b_z_1">
        	<div class="u_b_z_1_1">{team.name}</div>
            <a href="/app/team/mybasis"><div class="u_b_z_1_2">基本信息</div></a>
            <a href="/app/team/myphoto"><div class="u_b_z_1_3">相册</div></a>
            <a href="/app/team/myvideo"><div class="u_b_z_1_3">视频</div></a>
            <a href="/app/team/myrole"><div class="u_b_z_1_3">COS角色</div></a>
            <a href="/app/team/myactivity"><div class="u_b_z_1_3">社团活动</div></a>
        	<a href="/app/team/myapply"><div class="u_b_z_1_3">申请通知</div></a>
        </div>
		<div class="u_b_z_2">
        	<div class="u_b_z_2_1">
                <form id="teamInfo">
                    <div class="u_b_z_st1">
                        <div class="u_b_z_st1_1">社团名称</div>
                        <div class="u_b_z_st1_2"><input type="text" name="name" class="u_b_z_text1" value="{team.name}" onfocus="if (value =='{team.name}'){value =''}" onblur="if (value ==''){value='{team.name}'}"></div>
                    </div>
                    <div class="u_b_z_st2">
                        <div class="u_b_z_st2_1">社团简介</div>
                        <div class="u_b_z_st2_2"><textarea class="u_text1" name="desc" style="color:#999;padding:8px;resize:none">{team.desc}</textarea></div>
                    </div>
                </form>
            </div>
            <div class="u_b_z_2_2">
            	<img src="/pic/{team.thumb}.small.jpg" class="u_b_z_2_2_tu1">
            	<div class="u_b_z_2_fg cp">更换头像</div>
                <input type="file" style="display:none" id="changeAvatar" />
                <script>
                    j('.u_b_z_2_fg').click(function(){
                        j('#changeAvatar').click();
                    });j('#changeAvatar').change(function(){
                        if(!j(this).val())return;
                        var v = {avatar:1,small:1,box:'team',auto:1},f = packFormData(j(this),v);
                        j.ajax({
                            data:f,contentType:false,processData:false,type:'post',url:'/app/picture/upload',
                            success:function(d){
                                if(d.code==200)j.post('/app/team/change_avatar',{avatar:d.data.e},function(){
                                    show_alert(1,'更改成功',function(){
                                        j('.u_b_z_2_2_tu1').attr('src','/pic/'+d.data.e+'.small.jpg');
                                    });
                                },'json');
                            }
                        })
                    })
			    </script>
            </div>
        </div>
		<div class="u_b_z_3">
        	<div class="u_b_z_3_left">成员管理</div>
            <!--{loop $cosers $c}-->
            <div class="u_b_z_3_1">
            	<div class="u_b_z_3_1_top"><a href="/app/usercenter/index/{c.uid}"><img src="/pic/{c.avatar}.avatar.jpg" style="width:65px" class="img-circle"></a>
                	<div class="u_b_z_3_del cp" uid="{c.uid}"><img src="images/bc_03.png"></div>
                </div>
                <div class="u_b_z_3_1_bot">{c.nickname}</div>
            </div>
            <!--{/loop}-->
            <script>
                j('.u_b_z_3_del').click(function(){
                    var uid = j(this).attr('uid');
                    show_alert(2,'确认删除该团员？',function(){
                        j.post('/app/team/del_member',{uid:uid},function(d){
                            if(d.code==200){
                                show_alert(1,'删除成功~~',function(){
                                    location.relaod(true)
                                });
                            }else alert('发生错误');
                        },'json')
                    })
                })
            </script>
        </div>
		<div class="u_b_z_4">
        	<div class="u_b_z_4_left">社团封面</div>
            <div class="u_b_z_4_1"><img src="/pic/{team.pic}.medium.jpg" class="u_b_z_4_1_tu1">
            	<div class="u_b_z_4_fg">更换封面</div>
                <input type="file" style="display:none" id="changePic" />
                <script>
                    j('.u_b_z_4_fg').click(function(){
                        j('#changePic').click();
                    });j('#changePic').change(function(){
                        if(!j(this).val())return;
                        var v = {medium:1,large:1,box:'team',auto:0},f = packFormData(j(this),v);
                        j.ajax({
                            data:f,contentType:false,processData:false,type:'post',url:'/app/picture/upload',
                            success:function(d){
                                if(d.code==200)j.post('/app/team/change_pic',{pic:d.data.e},function(){
                                    show_alert(1,'更改成功',function(){
                                        j('.u_b_z_4_1_tu1').attr('src','/pic/'+d.data.e+'.medium.jpg');
                                    });
                                },'json');
                            }
                        })
                    })
			    </script>
            </div>
        </div>
		<div class="u_b_z_5">保存</div>
        <script>
            j('.u_b_z_5').click(function(){
                j.post('/app/team/change_info',j('#teamInfo').serializeArray(),function(d){
                    if(d.code==200){
                        show_alert(1,'修改成功',function(){
                            location.reload(true)
                        })
                    }
                },'json')
            })
        
        </script>

	</div>
</div>

<!--{subtemplate _footer}-->