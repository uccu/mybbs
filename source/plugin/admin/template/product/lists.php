<!--{subtemplate header}-->
<script type="text/javascript">
		window.UEDITOR_CONFIG = 'http://www.scthalia.com:6087/source/plugin/admin/js/';
		
	</script>
	<!--{eval addjs('ueditor.config')}-->
    <!--{eval addjs('ueditor.all.min')}-->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="index">Home</a></li>
        <li><a href="product">产品</a></li>
        <li><a href="product/lists">产品列表</a></li>
    </ol>
    <div class="alert_box"></div>
</div>

<div class="container">
    <div class="col-md-2">
        <div class="list-group">
            <a class="list-group-item active cd">产品列表</a>
        </div>
       
    </div>
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-body form-inline">
                <div class="form-group" style="margin:10px">
                        <label for="move">所属项目:</label>
                        <select class="form-control" id="example1">
                            <option selected=“selected” value="0">未选择</option>
                            <!--{loop $projects $project}-->
                            <option value="{$project.jid}">{project.jname}</option>
                            <!--{/loop}-->
                        </select>
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
                            <th class="text-center">缩略图</th>
                            <th class="text-center">创建时间</th>
                            <th class="text-center">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--{loop $list $p}-->
                        <tr>
                            <td>{p.did}</td>
                            <td>{p.dname}</td>
                            <td><img class='img-responsive center-block' style="width:80px" src="http://www.scthalia.com:6087/pic/{p.dthumb}" /></td>
                            <td>{p.cdate}</td>
                            <td>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">查看详情</button>
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
                        <label for="move">产品ID</label>
                        <input type="text" class="form-control" disabled="disabled" id="uid" name="did2">
                        <input type="hidden" class="form-control" id="uid" name="did">
                    </div>
                    <div class="form-group">
                        <label for="move">所属项目：</label>
                        <!--{loop $projects $project}-->
                        <label>
                            <input type="checkbox" id="inlineCheckbox1" name="interest" value="{project.jid}"> {project.jname}
                        </label>
                        <!--{/loop}-->
                    </div>
                    <div class="form-group">
                        <label>缩略图</label>
                        <input type="file" id="dthumb"  />
                        <p class="help-block help-block1"></p>
                        <img id="pic_dthumb" class='img-responsive' style="width:100px"  />
                    </div>
                    <div class="form-group">
                        <input class="form-control pic-form" name="dthumb2" type="text" value="" disabled="disabled"/>
                        <input class="form-control pic-form" name="dthumb" type="hidden" value=""/>
                    </div>
                    <div class="form-group">
                        <label>展示图</label>
                        <input type="file" id="dpic" />
                        <p class="help-block help-block2"></p>
                        <img id="pic_dpic" class='img-responsive' style="width:100px"  />
                    </div>
                    <div class="form-group">
                        <input class="form-control pic-form" name="dpic2" type="text" value="" disabled="disabled"/>
                        <input class="form-control pic-form" name="dpic" type="hidden" value=""/>
                    </div>
                    <div class="form-group">
                        <label for="move">产品名字</label>
                        <input type="text" class="form-control" name="dname" >
                    </div>
                    <div class="form-group">
                        <label for="value">产品介绍</label>
                        <textarea  name="introduction" rows="10" id="introduction" placeholder='内容'></textarea>
                    </div>
                    <div class="form-group">
                        <label for="value">产品特色</label>
                        <textarea  name="fealture" rows="10" id="introduction2" placeholder='内容'></textarea>
                    </div>
                    <div class="form-group">
                        <label for="value">产品效果</label>
                        <textarea  name="effect" rows="10" id="introduction3" placeholder='内容'></textarea>
                    </div>
                    <div class="form-group">
                        <label for="value">购买方式</label>
                        <textarea  name="purchase" rows="10" id="introduction4" placeholder='内容'></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default closemodel" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary save">保存</button>
            </div>
        </div>
    </div>
</div>
<script>
   var goods = 'product',control = 'product';
   j('.search').click(()=>{
        var a1=j('#example1').val();
        a1=a1?a1:0;
        location = control+'/lists/1/'+a1
    });
   getPageSet({currentPage},{maxPage},'href',control+'/lists/',(folder[5]?'/'+folder[5]:'')+(folder[6]?'/'+folder[6]:''));
   j('#myModal').on({'hide.bs.modal':()=>location.reload(true),'show.bs.modal':function(e){
        var b=j(e.relatedTarget),t=b.parent().parent(),id=t.find('td:eq(0)').text(),m=j(this);
        j.post(location.origin+'/_admin/'+control+'/get_'+goods+'_detail/'+id,(d)=>{
            for(var k in d.data){
                m.find('[name='+k+']').val(d.data[k]);
                m.find('[name='+k+'2]').val(d.data[k]);
                m.find('#pic_'+k).attr('src',location.origin+'/pic/'+d.data[k]);
            }
			window.UEDITOR_CONFIG.initialFrameHeight=500;
			UE.getEditor('introduction');
            UE.getEditor('introduction2');
            UE.getEditor('introduction3');
            UE.getEditor('introduction4');
            m.find('[name=interest]').attr('checked',false);
            for(var k in d.data.interest)m.find('[name=interest][value='+d.data.interest[k]+']').click();
        },'json');
        m.find('.help-block').html('');
   }});
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