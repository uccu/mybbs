j(function(j){
   var folder =location.pathname.split("/");
   j('.insave').on('click',function(){
        var s=j(this),f=s.attr('for'),d=j('form#'+f).serializeArray();
        if(d)j.post(s.attr('data-action'),d,function(c){
            if(c.code!==200){alert(c.code+':'+c.desc)}
            if(s.attr('data-action').match(/\/0$/))location = folder[1]+'/'+folder[2]+'/'+folder[3];
            else location.reload(true)
        },'json')
    });
    var defaultForm = j('form[data-default]');
    for(var i=0;i <defaultForm.length;i++){
        j.getJSON(j(defaultForm[i]).attr('data-default'),function(f){
            for(var g in f.data){
                j('[name='+g+'],[name='+g+'2]').val(f.data[g]);
                if(j('[name='+g+'].advancedTextarea')[0] && j('[name='+g+']')[0].tagName=='TEXTAREA')j('[name='+g+']').advancedTextarea(500);
                if(f.data[g] && j('[name='+g+']').parent().find('[type=file]'))j('[name='+g+']').parent().find('img').attr('src','pic/'+f.data[g]);
        }
        })
    }
    j('.indel').click(function(){
        var t=j(this),url=t.attr('data-action');
        j('.alert_box').html('')
        .append('<div id="alert" class="alert alert-'+
        (t.hasClass('btn-success')?'success':'danger')
        +' alert-dismissible fade in dn" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4>'+
        (t.attr('data-title')?t.attr('data-title'):'确认删除？')
        +'</h4><p>'+
        (t.attr('data-content')?t.attr('data-content'):'')
        +'</p><p><button type="button" class="btn btn-'+
        (t.hasClass('btn-success')?'success':'danger')
        +' yes" style="margin-right:10px">'+
        (t.attr('data-button')?t.attr('data-button'):'删除')
        +'</button><button type="button" class="btn btn-default" data-dismiss="alert">取消</button></p></div>');
        j('.alert').slideDown().find('.yes').one('click',function(){
            j.post(url,function(d){
                if(d.code!=200){alert(d.desc);return}
                else location.reload(true)
            })
        })
    });
    j('form [type=file]').change(function(){
        var t=j(this),p=t.parent(),id=this.id,f={},form;
        if(t.attr('data-circle'))f.circle = t.attr('data-circle');
        if(t.attr('data-box'))f.box = t.attr('data-box');
        form = packFormData('#'+id,f);
        j.ajax({
            url:'weixin/admin/up_pic',data:form,contentType:false,processData:false,type:'post',
            beforeSend:function(){
                p.find('.help-block').html('uploading file waiting...')
            },success:function(d){
                if(d.code!==200){
                    t.parent().find('.help-block').html('upload failed :'+d.desc);return
                }
                p.find('.help-block').html('upload successed');
                p.find('[name='+id+']').val(d.data[0]);
                p.find('[name='+id+'2]').val(d.data[0]);
                p.find('img').attr('src','pic/'+d.data[0]);
            }
        })
    });
    
});
