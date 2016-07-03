<!--{subtemplate _header}-->
<header nav="4"></header>
<div class="p_body">
	<div class="p_body_z">
    	<div class="q_p_z_1">
        	<div class="h_p_z_1_left">直播</div>
            <div class="h_p_z_1_right"></div>
        </div>
       	<div class="p_body_1">
        	<div class="p_body_1_1">YY直播<input type="text" value="{if $z['yy']}{z.yy}{else}地址{/if}" onfocus="if (value =='地址'){value =''}" onblur="if (value ==''){value='地址'}" class="o_text_2"></div>
            <div class="p_body_1_1">B站直播间<input type="text" value="{if $z['bilibili']}{z.bilibili}{else}地址{/if}" onfocus="if (value =='地址'){value =''}" onblur="if (value ==''){value='地址'}" class="o_text_2"></div>
            <div class="p_body_1_1">雅虎直播<input type="text" value="{if $z['yahu']}{z.yahu}{else}地址{/if}" onfocus="if (value =='地址'){value =''}" onblur="if (value ==''){value='地址'}" class="o_text_2"></div>
        </div> 
        <div class="p_body_con_x">上传</div>
    </div>

</div>
    <script>
        
        j('.p_body_con_x').click(function(){
            var a = j('.p_body_1_1 input').eq(0).val();
            if(a=='地址')a='';
            var b = j('.p_body_1_1 input').eq(1).val();
            if(b=='地址')b='';
            var c = j('.p_body_1_1 input').eq(2).val();
            if(c=='地址')c='';
                j.post('/app/usercenter/change_live',{y:a,b:b,h:c},function(d){
                if(d.code==200)show_alert(1,'修改成功~',function(){
                    location = '/app/usercenter/index/{me.uid}'
                });else show_alert(3,'修改失败：'+d.desc);
            },'json')
        });
    </script>
    <!--{subtemplate _footer}-->
