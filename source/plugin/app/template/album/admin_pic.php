<!--{subtemplate _header}-->
<header nav="4"></header>
<style>
.pp-block{color:#ccc}
.pp-block .control-label{font-size:13px;}
.btn-default.active, .btn-default.focus, .btn-default:active, .btn-default:focus, .btn-default:hover, .open>.dropdown-toggle.btn-default{
    background:#fff;border:1px solid #5cbac0;color:#5cbac0 !important;box-shadow: none;
}
.btn-group .btn{margin:10px;border-radius:6px;color:#ccc}
select[disabled]{background:#f0f0f0}
.listtwz img{width:100px;height:100px;margin:20px;float:left;border-radius:5px}
.del{width:960px;height:30px;margin:0 auto; text-align:right;}
.del font{margin-left:30px;}
.ph1{width:100%;height:auto; overflow:hidden; }
.ph1_1{height:120px;position:relative;}
.ph1_1_tu{max-width:100%;max-height:120px;border-radius:10px;}
.ph1_1.checked::after{
    content:' ';position:absolute;width:24px;height:24px; top:10px; right:10px;background:url(/images/xzxz.png)
}


</style>
<div class="q_body">
	<div class="q_body_z">
    	<div class="q_p_z_1">
        	<div class="h_p_z_1_left">相册</div>
            <div class="h_p_z_1_right"></div>
        </div>
            
    	<div class="q_body_z_1">
            <div class="q_body_z_1_left">
            	<span class="r_select_2">更换相册</span> 
                <select class="r_select1 albumk" style="padding:0 20px;border: 1px solid #ccc;background-position:152px;outline:0;width:177px">
                        <option value="0" selected disabled > </option>
                    <!--{loop $list $a}-->
                        <option value="{a.aid}">{a.title}</option>
                    <!--{/loop}-->
                </select>
                <script>
                    j('.albumk').change(function(){
                        j.post('/app/album/get_pic/'+j(this).val(),function(d){
                            j('.ph1').html('');
                            for(var k in d.data){
                                var e = '<div class="ph1_1 col-sm-2" pid="'+d.data[k].pid+'"><img src="/pic/'+d.data[k].src+'.small.jpg" class="img-reponsive ph1_1_tu"/></div>';
                                j('.ph1').append(e);
                            }
                            j('.ph1_1').unbind('click').bind('click',function(){
                                j(this).toggleClass('checked')
                            })
                        },'json')
                    });
                    j('.albumk').val(folder[4]);j('.albumk').change()
                </script>    
            </div>
        	<a href="/app/album/admin"><div class="q_body_z_1_2">管理</div></a>
            <a href="/app/album/creationphoto"><div class="q_body_z_1_1">创建</div></a>
            <a href="/app/album/photoupdate"><div class="q_body_z_1_1">上传</div></a>
        </div>

        <div class="del">
			<input type="checkbox" />&nbsp;全选
            <font color="#5cbac0" class="cp dell">删除</font>
		</div>
        <div class="ph1">
        	
            
        </div>
    </div>
</div>

<script>
    j('[type=checkbox]').click(function(){
        if(j(this)[0].checked){
            j('.ph1_1').addClass('checked')
        }else{
            j('.ph1_1').removeClass('checked')
        }
    });
    function deletePic(){
        var g = j('.ph1_1.checked');
        if(!g.length){
            show_alert(1,'删除成功~',function(){
                location.reload(true)
            });return
        }
        var r = j(g[0]);
        j.post('/app/album/del_pic/'+r.attr('pid'),function(d){
            if(d.code!=200){show_alert(3,d.desc);return}
            r.remove();deletePic();
        },'json')
    }
    j('.dell').click(function(){
        var g = j('.ph1_1.checked');
        if(!g.length)return;
        show_alert(2,'确认删除？',function(){
            deletePic()
        })
    })
</script>

<!--{subtemplate _footer}-->