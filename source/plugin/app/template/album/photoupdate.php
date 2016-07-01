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
</style>
<div class="q_body">
	<div class="q_body_z">
    	<div class="q_p_z_1">
        	<div class="h_p_z_1_left">相册</div>
            <div class="h_p_z_1_right"></div>
        </div>
            
    	<div class="q_body_z_1">
            <div class="q_body_z_1_left">
            	<span class="r_select_2">上传到</span> 
                <select class="r_select1 albumk" style="padding:0 20px;border: 1px solid #ccc;background-position:152px;outline:0;width:177px">
                    <!--{loop $albums $a}-->
                        <option value="{a.aid}">{a.title}</option>
                    <!--{/loop}-->
                    </select>
            </div>
        	<a href="/app/album/admin"><div class="q_body_z_1_1">管理</div></a>
            <a href="/app/album/creationphoto"><div class="q_body_z_1_1">创建</div></a>
            <a href="/app/album/photoupdate"><div class="q_body_z_1_2">上传</div></a>
        </div>
        <div style="padding:0 50px" class="pr">
            <div class="listtwz dn" style="padding:10px；">
            <div class="listtwz2" style="overflow:hidden">
                <img src="/images/xcsc_17.png" class="upchei cp">
                </div>
                <div class="text-center">
                    <button class="btn btn-default" style="margin-bottom:50px">确认</button>
                </div>
            </div>
            <div class="row listtw dn">

            </div>
            <div class="sample row dn">
                <div class="col-sm-4 form-horizontal pp-block">
                    <div class="progress dn pa" style="left:0;top:0;width:100%;height:20px">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                            <span class="sr-only">uploading...</span>
                        </div>
                    </div>
                    <div style="height:100px;margin:20px"><img class="blpic center-block" src="http://test.hanyu365.com.cn/xuanman2/images/2.png" style="height:100px;max-width:200px;border-radius:6px;border:1px solid #ccc" /></div>
                    <div class="form-group">
                        <label class="control-label"></label>
                        <div class="col-sm-12" style=" padding-left: 24px;">
                            <textarea placeholder="描述：" class="form-control" style="resize:none" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">原作标签：</label>
                        <div class="col-sm-8">
                            <select onchange="search_chars(this)" class="r_select1 prosSel" style="padding:0 20px;border: 1px solid #ccc;background-position:152px;outline:0;width:177px">
                                <option value="0" selected></option>
                            <!--{loop $provenance $a}-->
                                <option value="{a.pid}">{a.name}</option>
                            <!--{/loop}-->
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">角色标签：</label>
                        <div class="col-sm-8">
                            <select class="r_select1 charsSel" style="padding:0 20px;border: 1px solid #ccc;background-position:152px;outline:0;width:177px">
                            </select>
                        </div>
                    </div>
                     <div class="form-group" style=" padding-left: 22px;">
                     <span style="padding-right: 22px;font-size: 13px;">其他标签：</span>
                     <!--{loop $tags $a}-->
                        <div class="btn-group t" data-toggle="buttons">
                            <label class="btn btn-default btn-sm">
                                <input type="checkbox" name="tag" tname="{a.name}" > {a.name}
                            </label>
                        </div>
                    <!--{/loop}-->
                        
                    </div>
                    <div class="form-group">
                        <label style="padding-left: 22px;">
                            <input type="radio" name="cover">
                                 &nbsp;&nbsp;&nbsp;&nbsp;设置专辑封面
                        </label>
                    </div>

                </div>
            </div>
        </div>
        <div class="r_body_z_1">
        	<div class="r_body_z_1_1"><img src="images/xcsc_17.png"></div>
            <div class="r_body_z_1_2">选择图片</div>
        </div>
        <a><div class="r_body_z_2 cp dn" style="margin-bottom:30px">开始上传</div></a>
        <div class="d_p_z_2 dn">
            <input type="file" id="uppic" accept="image/*" multiple="multiple" />
        </div>
        
    </div>
</div>


<script>
(function(){
    window.search_chars = function(z){
        var that = z;
        j.post('/app/character/search/'+j(z).val(),function(d){
            var d = d.data,r='';
            for(var k in d){
                r +='<option value="'+d[k].cid+'">'+d[k].name+'</option>'
            }
            j(that).parent().parent().parent().find('.charsSel').html(r)
        },'json')
    };
    var raw_base64_picz = [];
    j('.r_body_z_1 div,.upchei').click(function(){
        j('#uppic').click();
    });
    j('.listtwz button').click(function(){
        j('.listtwz').hide();
        j('.listtw,.r_body_z_2').show();
    });
    j('#uppic').change(function(){
        var files = this.files;
        for(var k in files){
            var file =files[k];
            if(!file || !/image\/\w+/.test(file.type))continue;
            j('.r_body_z_1').hide();
            var reader=new FileReader();
            reader.readAsDataURL(file);
            reader.onload=function(e){
                var img=new Image();
                img.onload=function(e){
                    var cc=j('<canvas>'),c=cc[0],cxt=c.getContext("2d"),width=img.width,height=img.height;
                    if(img.width>2000){width=2000;height*=2000/img.width}
                    cc.attr({width:width,height:height});
                    cxt.drawImage(img,0,0,width,height);
                    raw_base64_picz.push(c.toDataURL());
                    if(img.width>200){width=200;height*=200/img.width}
                    cc.attr({width:width,height:height});
                    cxt.drawImage(img,0,0,width,height);
                    var box = j(j('.sample').html());
                    box.find('.blpic')[0].src=c.toDataURL();
                    j('.listtw').append(box);
                    var imgs = j('<img>');
                    imgs[0].src = c.toDataURL();
                    j('.upchei').before(imgs);
                    j('.listtwz').show();
                };
                img.src=this.result;
                
            }
        }
    });
    var uploadp = function(aid,list,k){
        list.eq(k).find('.progress').show();
            var t=list.eq(k),data = {
                aid:aid,
                raw_base64_picz:raw_base64_picz[k],
                des:t.find('textarea').val(),
                pro:t.find('.prosSel').val(),
                cid:t.find('.charsSel').val(),
                tags:[],
                cover:t.find('[type=radio]:checked').length
            };
            var zz = list.eq(k).find('.active [name=tag]');
            for(var z in zz)data.tags.push(zz.eq(z).attr('tname'));
            j.post('/app/album/upload/'+aid,data,function(d){
                list.eq(k).remove();
                if(k<raw_base64_picz.length-1)uploadp(aid,list,k+1);
                else show_alert(1,'全部上传成功~',function(){
                    location='/app/album/index/'+aid;
                });
            },'json');
    };
    j('.r_body_z_2').one('click',function(){
        if(!raw_base64_picz.length)location.reload(true);
        j('select,input,textarea').attr('disabled','disabled');
        var list = j('.listtw .pp-block'),aid = j('.albumk').val();
        uploadp(aid,list,0);
        
    })
})();









</script>
<!--{subtemplate _footer}-->