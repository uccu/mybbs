<!--{subtemplate header}-->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="index">Home</a></li>
        <li><a href="permission">权限</a></li>
        <li><a href="permission/lists">权限设置</a></li>
    </ol>
    <div class="alert_box"></div>
</div>

<div class="container">
    <div class="col-md-2">
        <div class="list-group">
            <a class="list-group-item active cd">权限设置</a>
        </div>
       
    </div>
    <div class="col-md-10">
        
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="text-center table table-striped sortable-theme-bootstrap" data-sortable>
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">账号</th>
                            <th class="text-center">管理员等级</th>
                            <th class="text-center">创建时间</th>
                            <th class="text-center">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--{loop $list $user}-->
                        <tr>
                            <td>{user.uid}</td>
                            <td>{user.phone}</td>
                            <td>{if $user['user_type']==2}普通管理员
                                {else}超级管理员
                                {/if}
                            </td>
                            
                            <td>{user.cdate}</td>

                            <td>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">查看详情</button>
                                {if $user['user_type']==2 && $user['uid']!=$uid}
                                <button type="button" style="margin-left:10px" class="btn btn-danger del_permission">删除</button>
                                {/if}
                            </td>
                        </tr>
                        <!--{/loop}-->
                    </tbody>
                </table>
                <div class="text-right fr">
                    {if $userType>2}<button type="button" class="btn btn-success add_permission" data-toggle="alert" data-target="#alert">添加</button>{/if}
                    
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
                        <label for="move">UID</label>
                        <input type="text" class="form-control" disabled="disabled" id="uid" name="uid2">
                        <input type="hidden" class="form-control" id="uid" name="uid">
                    </div>
                   
                    <div class="form-group">
                        <label for="move">手机号</label>
                        <input type="text" class="form-control" name="phone" >
                    </div>
                    
                    <div class="form-group">
                        <label for="move">重设密码</label>
                        <input type="password" class="form-control" name="pwd" placeholder="">
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

   getPageSet({currentPage},{maxPage},'href','permission/lists/',folder[5]?'/'+folder[5]:'');
   j('#myModal').on('show.bs.modal',function(e){
        var b=j(e.relatedTarget),t=b.parent().parent(),id=t.find('td:eq(0)').text(),m=j(this);
        j.post('user/get_user_detail/'+id,(d)=>{
            m.find('[name=uid]').val(d.data.uid);
            m.find('[name=uid2]').val(d.data.uid);
            m.find('[name=phone]').val(d.data.phone);
            m.find('[name=pwd]').val('');
        },'json');
        m.find('.help-block').html('');
    });
   j('#myModal [type=file]').change(function(){
        var form = packFormData('#myModal [type=file]',{uid:j('#myModal [name=uid]').val()});
        j.ajax({
            url:'common/up_avatar',
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
                j('#myModal [name=avatar]').val(d.data[0]);
                j('#myModal [name=avatar2]').val(d.data[0]);
            }
        })
    });
    j('#myModal .save').click(function(){
        var s=j(this),d=j('#myModal form').serializeArray();
        for(e in d){d[e].name = d[e].name=='interest'?'interest[]':d[e].name}
        j.post('user/change_info',d,function(d){
            if(d.code!==200)alert(d.desc);
            location.reload(true)
        })
    });
    j('.add_permission').click(function(){
        j('.alert_box').html('').append('<div id="alert" class="alert alert-success alert-dismissible fade in dn" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4>确认添加一个顾问账号？</h4><p>默认密码为123456</p><p><button type="button" class="btn btn-success yes" style="margin-right:10px">添加</button><button type="button" class="btn btn-default" data-dismiss="alert">取消</button></p></div>');
        j('.alert').slideDown().find('.yes').one('click',function(){
            j.post('permission/add_permission',function(){
                location.reload(true)
            })
        })
    });
    j('.del_permission').click(function(){
        var id=j(this).parent().parent().find('td:eq(0)').text();
        j('.alert_box').html('').append('<div id="alert" class="alert alert-danger alert-dismissible fade in dn" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4>确认删除？</h4><p>所有该顾问的客户都会还原成无顾问的状态</p><p><button type="button" class="btn btn-danger yes" style="margin-right:10px">删除</button><button type="button" class="btn btn-default" data-dismiss="alert">取消</button></p></div>');
        j('.alert').slideDown().find('.yes').one('click',function(){
            j.post('user/del_user',{uid:id},function(){
                location.reload(true)
            })
        })
    });
</script>
<!--{subtemplate tool:footer}-->