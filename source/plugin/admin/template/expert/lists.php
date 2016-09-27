<!--{subtemplate header}-->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="index">Home</a></li>
        <li><a href="expert">专家</a></li>
        <li><a href="expert/lists">专家列表</a></li>
    </ol>
    <div class="alert_box"></div>
</div>

<div class="container">
    <div class="col-md-2">
        <div class="list-group">
            <a class="list-group-item active cd">专家列表</a>
            <a href="reservation/lists" class="list-group-item">预约列表</a>
        </div>
       
    </div>
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-body form-inline">
                 <div class="form-group" style="margin-right:10px">
                    <label for="exampleInputName2">专家名字：</label>
                    <input type="text" class="form-control" id="example1" placeholder="">
                </div>
                <button type="submit" class="btn btn-default search">搜索</button>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="text-center table table-striped sortable-theme-bootstrap" data-sortable>
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">名字</th>
                            <th class="text-center">头像</th>
                            <th class="text-center">门店</th>
                            <th class="text-center">预约</th>
                            
                            <th class="text-center">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--{loop $list $p}-->
                        <tr>
                            <td>{p.eid}</td>
                            <td>{p.ename}</td>
                            <td><img class='img-responsive center-block img-circle' style="width:40px" src="http://www.scthalia.com:6087/pic/{p.ethumb}" /></td>
                            <td><a href="store/lists/1/0/{p.sid}" type="button" class="btn btn-warning">查看</a></td>
                            <td><a href="reservation/lists/1/{p.eid}" type="button" class="btn btn-warning">查看</a></td>
                            
                            <td>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">详情</button>
                                <button type="button" style="margin-left:10px" class="btn btn-danger del">删除</button>
                            </td>
                        </tr>
                        <!--{/loop}-->
                    </tbody>
                </table>
                <div class="text-right fr">
                    <button type="button" class="btn btn-success add" data-toggle="alert" data-target="#alert">添加</button>
                    
                </div>
                <nav>
                    <ul class="pagination pageset">
                        
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">修改</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="move">专家ID</label>
                        <input type="text" class="form-control" disabled="disabled" id="uid" name="eid2">
                        <input type="hidden" class="form-control" id="uid" name="eid">
                    </div>
                    <div class="form-group">
                        <label for="move">门店ID</label>
                        <input type="text" class="form-control" name="sid">
                    </div>
                    <div class="form-group">
                        <label>头像</label>
                        <input type="file" id="ethumb" data-circle="1" />
                        <p class="help-block"></p>
                        <img id="pic_ethumb" class='img-responsive img-circle' style="width:40px"  />
                    </div>
                    <div class="form-group">
                        <input class="form-control pic-form" name="ethumb2" type="text" value="" disabled="disabled"/>
                        <input class="form-control pic-form" name="ethumb" type="hidden" value=""/>
                    </div>
                    
                    <div class="form-group">
                        <label for="move">名字</label>
                        <input type="text" class="form-control" name="ename" >
                    </div>
                    <div class="form-group">
                        <label for="value">简介</label>
                        <input type="text" class="form-control" name="desc" >
                    </div>
                    <div class="form-group">
                        <label for="value">擅长</label>
                        <textarea class="form-control" name="good" rows="2" placeholder=''></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary save">保存</button>
            </div>
        </div>
    </div>
</div>
<script>
    if(folder[5])j('.add').hide();
   var goods = 'expert',control = 'expert';
   j('.search').click(()=>{
        var a1=j('#example1').val();
        a1=a1?a1:0;
        location = control+'/lists/1/0/'+a1
    });
   getPageSet({currentPage},{maxPage},'href',control+'/lists/',(folder[5]?'/'+folder[5]:'')+(folder[6]?'/'+folder[6]:''));
   j('#myModal').on('show.bs.modal',function(e){
        var b=j(e.relatedTarget),t=b.parent().parent(),id=t.find('td:eq(0)').text(),m=j(this);
        j.post(location.origin+'/_admin/'+control+'/get_'+goods+'_detail/'+id,(d)=>{
            for(var k in d.data){
                m.find('[name='+k+']').val(d.data[k]);
                m.find('[name='+k+'2]').val(d.data[k]);
                m.find('#pic_'+k).attr('src',location.origin+'/pic/'+d.data[k]);
            }
            m.find('[name=interest]').attr('checked',false);
            for(var k in d.data.interest)m.find('[name=interest][value='+d.data.interest[k]+']').click();
        },'json');
        m.find('.help-block').html('');
    });
   j('#myModal [type=file]').change(function(){
        var that = j(this),id = that.attr('id'),f = that.attr('data-circle') ? {circle:1} : {},
        form = packFormData('#'+id,f);
        j.ajax({
            url:location.origin+'/admin/common/up_pic/'+goods,
            data:form,
            contentType:false,
            processData:false,
            type:'post',
            beforeSend:()=>
                that.parent().find('.help-block').html('uploading file waiting...')
            ,success:d=>{
                if(d.code!==200){
                    that.parent().find('.help-block').html('upload failed');return
                }
                that.parent().find('.help-block').html('upload successed');
                j('#myModal [name='+id+']').val(d.data[0]);
                j('#myModal [name='+id+'2]').val(d.data[0]);
                that.parent().find('img').attr('src',location.origin+'/pic/'+d.data[0]);
            }
        })
    });
    j('#myModal .save').click(function(){
        var s=j(this),d=j('#myModal form').serializeArray();
        for(e in d){d[e].name = d[e].name=='interest'?'interest[]':d[e].name}
        j.post(control+'/change_'+goods,d,function(){
            location.reload(true)
        })
    });
    j('.add').click(function(){
        j('.alert_box').html('').append('<div id="alert" class="alert alert-success alert-dismissible fade in dn" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4>确认添加？</h4><p></p><p><button type="button" class="btn btn-success yes" style="margin-right:10px">添加</button><button type="button" class="btn btn-default" data-dismiss="alert">取消</button></p></div>');
        j('.alert').slideDown().find('.yes').one('click',function(){
            j.post(control+'/add_'+goods,function(){
                location.reload(true)
            })
        })
    });
    j('.del').click(function(){
        var id=j(this).parent().parent().find('td:eq(0)').text();
        j('.alert_box').html('').append('<div id="alert" class="alert alert-danger alert-dismissible fade in dn" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4>确认删除？</h4><p></p><p><button type="button" class="btn btn-danger yes" style="margin-right:10px">删除</button><button type="button" class="btn btn-default" data-dismiss="alert">取消</button></p></div>');
        j('.alert').slideDown().find('.yes').one('click',function(){
            j.post(control+'/del_'+goods+'/'+id,function(){
                location.reload(true)
            })
        })
    });
</script>
<!--{subtemplate tool:footer}-->