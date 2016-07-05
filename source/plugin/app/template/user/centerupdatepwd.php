<!--{template _header}-->
<header nav="5"></header>

<div class="p_body">
	<div class="p_body_z">
    	<div class="o_body_z_top">
        	<div class="o_body_z_top_1">账户资料</div>
            <a href="/app/usercenter/centerupdate"><div class="o_body_z_top_3">基本信息</div></a>
            <a href="/app/usercenter/centerupdatepwd"><div class="o_body_z_top_2">修改密码</div></a>
        </div>
       	<div class="p_body_1">
        	<div class="p_body_1_1">旧密码<input name="pwd1" type="password" class="o_text_1"></div>
            <div class="p_body_1_1">新密码<input name="pwd2" type="password" class="o_text_1"></div>
            <div class="p_body_1_1">确认新密码<input name="pwd3" type="password" class="o_text_1"></div>
        </div> 
        <div class="p_body_con_x">提交</div>
    </div>

</div>
                    <script>
            j('.p_body_con_x').click(function(){
                var pwdl = j('[name=pwd1]').val(),
                    new1 = j('[name=pwd2]').val(),
                    new2 = j('[name=pwd3]').val();
                if(new1!=new2){show_alert(3,'两次新密码不同');return}
                j.post('/app/usercenter/change_password',{old:pwdl,new:new1},function(d){
                    if(d.code==200)show_alert(1,'修改成功~',function(){
                        location="/app/usercenter/index/{me.uid}"
                    });else show_alert(3,d.desc)
                },'json')

            })
        </script>

<!--{template _footer}-->