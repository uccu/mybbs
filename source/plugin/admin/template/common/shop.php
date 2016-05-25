<!--{subtemplate header}-->

<div class="container">
    <ol class="breadcrumb">
        <li><a href="index">Home</a></li>
        <li><a href="common">基本设置</a></li>
        <li><a href="common/shop">商城切图</a></li>
    </ol>
    <div class="alert_box"></div>
</div>

<div class="container">
    <div class="col-md-2">
        <div class="list-group">
            <a href="common/pic" class="list-group-item">切图设置</a>
            <a href="common/ad" class="list-group-item">社区广告</a>
            <a class="list-group-item active cd">商城切图</a>
        </div>
    </div>
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="text-center table table-striped sortable-theme-bootstrap" data-sortable>
                    <thead>
                        <tr>
                            <th class="text-center">编号顺序</th>
                            <th class="text-center">图片</th>
                            <th class="text-center">链接类型</th>
                            <th class="text-center">ID/值</th>
                            <th class="text-center" style="min-width:140px">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--{loop $pic $k=>$v}-->
                        <!--{eval $n=$k+1}-->
                        <tr>
                            <td class="text-center">{n}</td>
                            <td><a class="text_img cp" data-trigger="hover" 
                            title="图片" data-html="true" 
                            data-content="<img class='img-responsive' src='http://120.26.230.136:6087/pic/{v.pic}' />">{v.pic}</a></td>
                           
                            <td><a data-type="{v.type}">
                                {if $v['type']=='none'}
                                无
                                {elseif $v['type']=='article'}
                                资料
                                {elseif $v['type']=='forum'}
                                帖子
                                {elseif $v['type']=='link'}
                                外部链接
                                {elseif $v['type']=='project'}
                                项目
                                {elseif $v['type']=='product'}
                                产品
                                {elseif $v['type']=='shop'}
                                商品
                                {/if}
                                </a></td>
                             <td><a data-value="{v.value}">{v.value}</a></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="opition">
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">修改</button>
                                    <button type="button" class="btn btn-danger del_pic">删除</button>
                                </div>
                            </td>
                        </tr>
                        <!--{/loop}-->
                        
                    </tbody>
                </table>
                <div class="text-right">
                    <button type="button" class="btn btn-success add_pic" data-toggle="alert" data-target="#alert">添加</button>
                    
                </div>
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
                        <label>切图图片</label>
                        <input type="file" />
                       
                        <p class="help-block"></p>
                    </div>
                    <input class="form-control pic-form" name="pic2" type="text" value="" disabled="disabled"/>
                    <input class="form-control pic-form" name="pic" type="hidden" value=""/>
                    <input class="form-control pic-form" name="id" type="hidden" value=""/>
                    <div class="form-group">
                        <label for="exampleInputFile">链接类型</label>
                        <select class="form-control" name="type">
                            <option value="article">资料</option>
                            <option value="forum">帖子</option>
                            <option value="project">项目</option>
                            <option value="product">产品</option>
                            <option value="shop">商品</option>
                            <option value="link">外部链接</option>
                            <option value="none" selected=“selected”>无</option>
                        </select>
                     </div>
                    <div class="form-group">
                        <label for="value">ID/值</label>
                        <input type="text" class="form-control" id="value" name="value" placeholder="值">
                    </div>
                    <div class="form-group">
                        <label for="move">移动到 第N个切图之后</label>
                        <input type="text" class="form-control" id="move" name="move">
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
    j('#myModal').on('show.bs.modal',function(e){
        var b=j(e.relatedTarget),t=b.parent().parent().parent(),r=t.find('.text_img').text(),
        y=t.find('[data-type]').attr('data-type'),v=t.find('[data-value]').attr('data-value'),id=t.find('td:eq(0)').text(),m=j(this);
        m.find('[name=pic]').val(r);m.find('[name=pic2]').val(r);m.find('[name=type]').val(y);
        m.find('[name=value]').val(v);m.find('[name=id]').val((parseInt(id)-1).toString());
        m.find('.help-block').html('');m.find('[name=move]').val('');
    });
    j('#myModal [type=file]').change(function(){
        form = packFormData('#myModal [type=file]');
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
                j('.help-block').html('upload successed');
                j('#myModal [name=pic]').val(d.data[0]);
                j('#myModal [name=pic2]').val(d.data[0]);
            }
        })
    });
    j('#myModal .save').click(function(){
        var s=j(this),d=j('#myModal form').serializeArray();
        j.post('common/change_shop',d,function(){
            location.reload(true)
        })
    });
    j('.del_pic').click(function(){
        var id=j(this).parent().parent().parent().find('td:eq(0)').text();
        j('.alert_box').html('').append('<div id="alert" class="alert alert-danger alert-dismissible fade in dn" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4>确认删除？</h4><p></p><p><button type="button" class="btn btn-danger yes" style="margin-right:10px">删除</button><button type="button" class="btn btn-default" data-dismiss="alert">取消</button></p></div>');
        j('.alert').slideDown().find('.yes').one('click',function(){
            j.post('common/del_shop',{id:parseInt(id)-1},function(){
                location.reload(true)
            })
        })
    });
    j('.add_pic').click(function(){
        j('.alert_box').html('').append('<div id="alert" class="alert alert-success alert-dismissible fade in dn" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4>确认添加？</h4><p></p><p><button type="button" class="btn btn-success yes" style="margin-right:10px">添加</button><button type="button" class="btn btn-default" data-dismiss="alert">取消</button></p></div>');
        j('.alert').slideDown().find('.yes').one('click',function(){
            j.post('common/add_shop',function(){
                location.reload(true)
            })
        })
        
    });
</script>
<!--{subtemplate tool:footer}-->