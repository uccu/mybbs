<!--{subtemplate header}-->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="index">Home</a></li>
        <li><a href="common">基本设置</a></li>
        <li><a href="common/area">地区列表</a></li>
    </ol>
    <div class="alert_box"></div>
</div>

<div class="container">
    <div class="col-md-2">
        <div class="list-group">
            <a href="common/pic" class="list-group-item">切图设置</a>
            <a href="common/ad" class="list-group-item">社区广告</a>
            <a href="common/shop" class="list-group-item">商城切图</a>
            <a class="list-group-item active cd">地区列表</a>
            <a href="common/work" class="list-group-item">工作列表</a>
        </div>
       
    </div>
    <div class="col-md-10">
       <div class="panel panel-default">
            <div class="panel-body form-inline">
                 <div class="form-group" style="margin-right:10px">
                    <label for="exampleInputName2">省市</label>
                    <input type="text" class="form-control" id="example1" placeholder="">
                </div>
                <div class="form-group" style="margin-right:10px">
                    <label for="exampleInputEmail2">城市</label>
                    <input type="text" class="form-control" id="example2" placeholder="">
                </div>
                <button type="submit" class="btn btn-default search">搜索</button>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="text-center table table-striped sortable-theme-bootstrap" data-sortable>
                    <thead>
                        <tr>
                            <th class="text-center">省市</th>
                            <th class="text-center">城市</th>
                            <th class="text-center">区县</th>
                            <th class="text-center">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--{loop $list $p}-->
                        <tr>
                            <td>{p.province}</td>
                            <td>{p.city}</td>
                            <td>{p.district}</td>
                            <td>
                                <!--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">修改</button>-->
                                <button type="button" style="margin-left:10px" class="btn btn-danger del">删除</button>
                            </td>
                        </tr>
                        <!--{/loop}-->
                    </tbody>
                </table>
                <div class="text-right fr">
                    <button type="button" class="btn btn-success add" data-toggle="modal" data-target="#myModal">添加</button>
                    
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
                        <label for="move">省市</label>
                        <input type="text" class="form-control" name="province" >
                    </div>
                    <div class="form-group">
                        <label for="move">城市</label>
                        <input type="text" class="form-control" name="city" >
                    </div>
                    <div class="form-group">
                        <label for="move">区县</label>
                        <input type="text" class="form-control" name="district" >
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
   var goods = 'area',control = 'common';
   j('.search').click(()=>{
        var a1=j('#example1').val(),a2=j('#example2').val();
        a1=a1?a1:0;a2=a2?a2:0;
        location = control+'/area/'+a1+'/'+a2
    });
   j('#myModal').on('show.bs.modal',function(e){
        var b=j(e.relatedTarget),t=b.parent().parent(),m=j(this);
        m.find('input').val('');
        m.find('[name=province]').val(t.find('td:eq(0)').text());
        m.find('[name=city]').val(t.find('td:eq(1)').text());
        m.find('[name=district]').val(t.find('td:eq(2)').text());
        m.find('.help-block').html('');
    });
   
    j('#myModal .save').click(function(){
        var s=j(this),d=j('#myModal form').serializeArray();
        j.post(control+'/change_'+goods,d,function(){
            location.reload(true)
        })
    });

    j('.del').click(function(){
        var t=j(this).parent().parent(),province=t.find('td:eq(0)').text(),city=t.find('td:eq(1)').text(),district=t.find('td:eq(2)').text();
        j('.alert_box').html('').append('<div id="alert" class="alert alert-danger alert-dismissible fade in dn" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4>确认删除？</h4><p></p><p><button type="button" class="btn btn-danger yes" style="margin-right:10px">删除</button><button type="button" class="btn btn-default" data-dismiss="alert">取消</button></p></div>');
        j('.alert').slideDown().find('.yes').one('click',function(){
            j.post(control+'/del_'+goods,{province:province,city:city,district:district},function(){
                location.reload(true)
            })
        })
    });
</script>
<!--{subtemplate tool:footer}-->