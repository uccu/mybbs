<!--{subtemplate header}-->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="index">Home</a></li>
        <li><a href="adviser">顾问</a></li>
        <li><a href="adviser/lists">顾问列表</a></li>
    </ol>
    <div class="alert_box"></div>
</div>

<div class="container">
    <div class="col-md-2">
        <div class="list-group">
            <a class="list-group-item active cd">顾问列表</a>
        </div>
       
    </div>
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-body form-inline">
                 <div class="form-group" style="margin-right:10px">
                    <label for="exampleInputName2">账号</label>
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
                            <th class="text-center">账号</th>
                            <th class="text-center">称呼</th>
                            <th class="text-center">创建时间</th>
                            <th class="text-center">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--{loop $list $user}-->
                        <tr>
                            <td>{user.uid}</td>
                            <td>{user.phone}</td>
                            <td>{user.nickname}</td>
                            
                            <td>{user.cdate}</td>

                            <td>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">查看详情</button>
                                <button type="button" style="margin-left:10px" class="btn btn-danger del_adviser">删除</button>
                            </td>
                        </tr>
                        <!--{/loop}-->
                    </tbody>
                </table>
                <div class="text-right fr">
                    <button type="button" class="btn btn-success add_adviser" data-toggle="alert" data-target="#alert">添加</button>
                    
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
                        <label>头像</label>
                        <input type="file" />
                        <p class="help-block"></p>
                        <img class='img-responsive img-circle' style="width:100px"  />
                    </div>
                    <div class="form-group">
                        <input class="form-control pic-form" name="avatar2" type="text" value="" disabled="disabled"/>
                        <input class="form-control pic-form" name="avatar" type="hidden" value=""/>
                    </div>
                    <div class="form-group">
                        <label for="move">手机号</label>
                        <input type="text" class="form-control" name="phone" >
                    </div>
                    <div class="form-group">
                        <label for="move">称呼</label>
                        <input type="text" class="form-control" name="nickname">
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
    j('.search').click(()=>{
        var a1=j('#example1').val();
        a1=a1?a1:0;
        location = 'adviser/lists/1/'+a1
    });
   getPageSet({currentPage},{maxPage},'href','adviser/lists/',folder[5]?'/'+folder[5]:'');
   j('#myModal').on('show.bs.modal',function(e){
        var b=j(e.relatedTarget),t=b.parent().parent(),id=t.find('td:eq(0)').text(),m=j(this);
        j.post('user/get_user_detail/'+id,(d)=>{
            m.find('[name=uid]').val(d.data.uid);
            m.find('[name=uid2]').val(d.data.uid);
            m.find('img').attr('src','http://120.26.230.136:6087/pic/'+d.data.avatar);
            m.find('[name=avatar]').val(d.data.avatar);
            m.find('[name=avatar2]').val(d.data.avatar);
            m.find('[name=phone]').val(d.data.phone);
            m.find('[name=nickname]').val(d.data.nickname);
            m.find('[name=name]').val(d.data.name);
            m.find('[name=age]').val(d.data.age.dateChange());
            m.find('[name=area]').val(d.data.area);
            m.find('[name=work]').val(d.data.work);
            m.find('[name=sex][value='+d.data.sex+']').click();
            m.find('[name=email]').val(d.data.email);
            m.find('[name=marry]').attr('checked',d.data.marry=='1'?'checked':false);
            m.find('[name=diary]').attr('checked',d.data.diary=='1'?'checked':false);
            m.find('[name=child]').attr('checked',d.data.child=='1'?'checked':false);
            m.find('[name=plastic]').attr('checked',d.data.plastic=='1'?'checked':false);
            m.find('[name=interest]').attr('checked',false);
            for(var k in d.data.interest)m.find('[name=interest][value='+d.data.interest[k]+']').attr('checked','checked');
            m.find('[name=score]').val(d.data.score);
            m.find('[name=invate]').val(d.data.invate);
            m.find('[name=adviser]').val(d.data.adviser);
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
        j.post('user/change_info',d,function(){
            location.reload(true)
        })
    });
    j('.add_adviser').click(function(){
        j('.alert_box').html('').append('<div id="alert" class="alert alert-success alert-dismissible fade in dn" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4>确认添加一个顾问账号？</h4><p>默认密码为123456</p><p><button type="button" class="btn btn-success yes" style="margin-right:10px">添加</button><button type="button" class="btn btn-default" data-dismiss="alert">取消</button></p></div>');
        j('.alert').slideDown().find('.yes').one('click',function(){
            j.post('adviser/add_adviser',function(){
                location.reload(true)
            })
        })
    });
    j('.del_adviser').click(function(){
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