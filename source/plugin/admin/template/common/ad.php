<!--{subtemplate header}-->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="index">Home</a></li>
        <li><a href="common">基本设置</a></li>
        <li><a href="common/ad">社区广告</a></li>
    </ol>
    <div class="alert_box"></div>
</div>

<div class="container">
    <div class="col-md-2">
        <div class="list-group">
            <a href="common/pic" class="list-group-item">切图设置</a>
            <a class="list-group-item active cd">社区广告</a>
            <a href="common/shop" class="list-group-item">商城切图</a>
        </div>
       
    </div>
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-body">
                <form>
                    <img src="http://120.26.230.136:6087/pic/{ad.pic}" class="img-responsive" />
                    <div class="form-group">
                        <label>上传图片</label>
                        <input type="file" />
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <input class="form-control pic-form" name="pic2" type="text" value="{ad.pic}" disabled="disabled"/>
                        <input class="form-control pic-form" name="pic" type="hidden" value="{ad.pic}"/>
                    </div>
                    <textarea class="form-control" name="desc" rows="3" placeholder='描述'>{ad.desc}</textarea>
                    <div class="form-group">
                        <label for="value">外链地址</label>
                        <input class="form-control" type="text" name="url" value="{ad.url}" placeholder='http://'/>
                    </div>
                    <div class="form-group">
                        <label for="value">内容</label>
                        <textarea class="form-control" name="content" rows="10" placeholder='内容'>{ad.content}</textarea>
                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-success save">保存</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    j('[type=file]').change(function(){
        form = packFormData('[type=file]');
        j.ajax({
            url:'common/up_pic/common',
            data:form,
            contentType:false,
            processData:false,
            type:'post',
            beforeSend:function(xhr){
                j('.help-block').html('uploading file waiting...')
            },success:function(d){
                if(d.code!==200){
                    j('.help-block').html('upload failed');return
                }
                j('form img').attr('src','http://120.26.230.136:6087/pic/'+d.data[0]);
                j('.help-block').html('upload successed');
                j('[name=pic]').val(d.data[0]);
                j('[name=pic2]').val(d.data[0]);
            }
        })
    });
    j('.save').click(function(){
        var d = j('form').serializeArray();
        j('.alert_box').html('').append('<div id="alert" class="alert alert-success alert-dismissible fade in dn" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4>确认保存？</h4><p></p><p><button type="button" class="btn btn-success yes" style="margin-right:10px">添加</button><button type="button" class="btn btn-default" data-dismiss="alert">保存</button></p></div>');
        j('.alert').slideDown().find('.yes').one('click',function(){
            j.post('common/save_ad',d,function(){
                location.reload(true)
            })
        })
        
    });
</script>
<!--{subtemplate tool:footer}-->