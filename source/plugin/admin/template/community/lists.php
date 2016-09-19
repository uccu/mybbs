<!--{subtemplate header}-->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="index">Home</a></li>
        <li><a href="community">社区</a></li>
        <li><a href="community/lists">帖子列表</a></li>
    </ol>
    <div class="alert_box"></div>
</div>

<div class="container">
    <div class="col-md-2">
        <div class="list-group">
            <a class="list-group-item active cd">帖子列表</a>
            <a href="community/replys" class="list-group-item">回复列表</a>
        </div>
       
    </div>
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-body form-inline">
                 <div class="form-group" style="margin-right:10px">
                    <label for="exampleInputName2">用户：</label>
                    <input type="text" class="form-control" id="example1" placeholder="">
                </div>
                <button type="submit" class="btn btn-default search">搜索</button>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="text-center table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">用户</th>
                            <th class="text-center">标题</th>
                            <th class="text-center">发布时间</th>
                            <th class="text-center">回复</th>
                            <th class="text-center">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--{loop $list $p}-->
                        <tr>
                            <td>{p.hid}</td>
                            <td><a href="user/lists/1/{p.phone}">{p.nickname}</a></td>
                            <td>{p.title}</td>
                            <td>{p.cdate}</td>
                            <td>
                                <a type="button" class="btn btn-warning" href="community/replys/1/{p.hid}">查看</a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">详情</button>
                                <button type="button" style="margin-left:10px" class="btn btn-danger del">删除</button>
                            </td>
                        </tr>
                        <!--{/loop}-->
                    </tbody>
                </table>
                <div class="text-right fr">
                   
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
                        <label for="move">帖子ID</label>
                        <input type="text" class="form-control" disabled="disabled" name="hid2">
                        <input type="hidden" class="form-control" name="hid">
                    </div>
                    <div class="form-group">
                        <label for="move">用户ID</label>
                        <input type="text" class="form-control" disabled="disabled" name="uid2">
                        
                    </div>
                    <div class="form-group">
                        <label for="move">喜欢的项目：</label>
                        <!--{loop $tags $tag}-->
                        <label>
                            <input type="checkbox" id="inlineCheckbox1" name="tag" value="{tag.tid}"> {tag.tname}
                        </label>
                        <!--{/loop}-->
                    </div>
                    <div class="form-group">
                        <label>图片11</label>
                        <input type="file" id="pic0" />
                        <p class="help-block help-block2"></p>
                        <img id="pic_pic0" class='img-responsive' style="width:100px"  />
                    </div>
                    <div class="form-group">
                        <input class="form-control pic-form" name="pic02" type="text" value="" disabled="disabled"/>
                        <input class="form-control pic-form" name="pic0" type="hidden" value=""/>
                    </div>
                    <div class="form-group">
                        <label>图片2</label>
                        <input type="file" id="pic1" />
                        <p class="help-block help-block2"></p>
                        <img id="pic_pic1" class='img-responsive' style="width:100px"  />
                    </div>
                    <div class="form-group">
                        <input class="form-control pic-form" name="pic12" type="text" value="" disabled="disabled"/>
                        <input class="form-control pic-form" name="pic1" type="hidden" value=""/>
                    </div>
                    <div class="form-group">
                        <label>图片3</label>
                        <input type="file" id="pic2" />
                        <p class="help-block help-block2"></p>
                        <img id="pic_pic2" class='img-responsive' style="width:100px"  />
                    </div>
                    <div class="form-group">
                        <input class="form-control pic-form" name="pic22" type="text" value="" disabled="disabled"/>
                        <input class="form-control pic-form" name="pic2" type="hidden" value=""/>
                    </div>
                    <div class="form-group">
                        <label for="move">标题</label>
                        <input type="text" class="form-control" name="title" >
                    </div>
                    <div class="form-group">
                        <label for="value">内容</label>
                        <textarea class="form-control" name="content" rows="10" placeholder='内容'></textarea>
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
   var goods = 'thread',control = 'community';
   j('.search').click(()=>{
        var a1=j('#example1').val();
        a1=a1?a1:0;
        location = control+'/lists/1/'+a1
    });
   getPageSet({currentPage},{maxPage},'href',control+'/lists/',(folder[5]?'/'+folder[5]:'')+(folder[6]?'/'+folder[6]:''));
   j('#myModal').on('show.bs.modal',function(e){
        var b=j(e.relatedTarget),t=b.parent().parent(),id=t.find('td:eq(0)').text(),m=j(this);
        j.post(location.origin+'/admin/'+control+'/get_'+goods+'_detail/'+id,(d)=>{
            for(var k in d.data){
                m.find('[type!=radio][name='+k+']').val(d.data[k]);
                m.find('[type!=radio][name='+k+'2]').val(d.data[k]);
                m.find('#pic_'+k).attr('src',location.origin+'/pic/'+d.data[k]);
                m.find('[name=tag]').attr('checked',false);
                for(var k in d.data.tag)m.find('[name=tag][value='+d.data.tag[k]+']').click();
            }
            

        },'json');
        m.find('.help-block').html('');
    });
   j('#myModal [type=file]').change(function(){
        var that = j(this),id = that.attr('id'),f = that.attr('data-circle') ? {circle:1} : {},
        form = packFormData('#'+id,f);
        j.ajax({
            url:location.origin+'/_admin/common/up_pic/'+control,
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
        for(e in d){d[e].name = d[e].name=='tag'?'tag[]':d[e].name}
        j.post(control+'/change_'+goods,d,function(){
            location.reload(true)
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