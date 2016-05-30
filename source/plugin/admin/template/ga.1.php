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
                <table class="text-center table table-striped sortable-theme-bootstrap" data-sortable>
                    <thead>
                        <tr>
                            <th class="text-center">标识</th>
                            <th class="text-center">说明</th>
                            <th class="text-center">周期</th>
                            <th class="text-center">次数限制</th>
                            <th class="text-center">变化积分</th>
                            <th class="text-center">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--{loop $list $p}-->
                        <tr>
                            <td>{p.name}</td>
                            <td>{p.desc}</td>
                            <td data-type="{p.type}">
                                {if $p['type']=='d'}天
                                {elseif $p['type']=='w'}周
                                {elseif $p['type']=='H'}小时
                                {elseif $p['type']=='m'}月
                                {elseif $p['type']=='Y'}年
                                {elseif $p['type']=='s'}一次
                                {/if}
                            </td>
                            <td>{p.stimes}</td>
                            <td>{p.score}</td>
                            <td>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">修改</button>
                                
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