<!--{subtemplate tool:header}-->
<!--{eval addjs('p',0,'admin')}-->
<div class="container">
    <div class="page-header">
        <h1>△ <small>后台</small></h1>
    </div>
<ul class="nav nav-tabs" style="margin-bottom:30px">
    <li role="presentation" class="ga"><a href="ga">记录</a></li>
    
</ul>
</div>


<div class="container">
    <div class="col-md-2">
        <div class="list-group">
            <a class="list-group-item active cd">发布新记录</a>
            <a href="ga/lists" class="list-group-item">记录列表</a>
        </div>
       
    </div>
    <div class="col-md-10">
        
        <div class="panel panel-default">
            <div class="panel-body">
                <form>
                    
                    <div class="text-center">
                        <span class="input input--hoshi" style="width:100%;margin-left:0;max-width:none">
                            <input class="input__field input__field--hoshi" type="text" name="title" style="width:100%;height:57px;line-hieght:57px">
                            <label class="input__label input__label--hoshi input__label--hoshi-color-3">
                                <span class="input__label-content input__label-content--hoshi">标题</span>
                            </label>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="move">内容</label>
                        <textarea type="text" class="form-control" name="area" rows="20" placeholder=''></textarea>
                    </div>
                    
                </form>
                <div><button type="button" class="btn btn-default upload t">发布</button></div>
            </div>
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
                        <label for="move">标识</label>
                        <input type="text" class="form-control" disabled="disabled" id="uid" name="name2">
                        <input type="hidden" class="form-control" id="uid" name="name">
                    </div>
                    <div class="form-group">
                        <label for="move">周期</label>
                        <select class="form-control" name="type">
                            <option value="Y">年</option>
                            <option value="m">月</option>
                            <option value="d">天</option>
                            <option value="H">小时</option>
                            <option selected="selected" value="s">一次</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="move">次数限制</label>
                        <input type="text" class="form-control" name="stimes">
                    </div>
                    <div class="form-group">
                        <label for="move">变化积分</label>
                        <input type="text" class="form-control" name="score">
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
   var goods = 'setting',control = 'score';
  

   j('#myModal').on('show.bs.modal',function(e){
        var b=j(e.relatedTarget),t=b.parent().parent(),m=j(this);
        m.find('[name=name]').val(t.find('td:eq(0)').text());
        m.find('[name=name2]').val(t.find('td:eq(0)').text());
        m.find('[name=type]').val(t.find('td:eq(2)').attr('data-type'));
        m.find('[name=stimes]').val(t.find('td:eq(3)').text());
        m.find('[name=score]').val(t.find('td:eq(4)').text());
        m.find('.help-block').html('');
    });
   
    j('#myModal .save').click(function(){
        var s=j(this),d=j('#myModal form').serializeArray();
       
        j.post(control+'/change_'+goods,d,function(){
            location.reload(true)
        })
    });
    
   
</script>
<!--{subtemplate tool:footer}-->