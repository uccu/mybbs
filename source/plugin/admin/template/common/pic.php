<!--{subtemplate header}-->
<!--{eval addjs('jquery-ui.min',0,'admin')}-->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="index">Home</a></li>
        <li><a href="common">基本设置</a></li>
        <li><a href="common/pic">切图设置</a></li>
    </ol>
</div>

<div class="container">
    <div class="col-md-2">
        <div class="list-group">
            <a class="list-group-item active cd">切图设置</a>
            <a href="common/ad" class="list-group-item">社区广告</a>
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
                            <th class="text-center">值</th>
                            <th class="text-center" style="min-width:140px">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--{loop $pic $k=>$v}-->
                        <!--{eval $n=$k+1}-->
                        <tr>
                            <td class="text-center">{n}</td>
                            <td><a class="text_img cp" data-trigger="hover" 
                            title="{v.pic}" data-html="true" 
                            data-content="<img class='img-responsive' src='http://120.26.230.136:6087/pic/{v.pic}' />">{v.pic}</a></td>
                            <td>{v.type}</td>
                            <td>{v.value}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="opition">
                                    <button type="button" class="btn btn-info">修改</button>
                                    <button type="button" class="btn btn-danger">删除</button>
                                </div>
                            </td>
                        </tr>
                        <!--{/loop}-->
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery('tbody').sortable();
    jQuery('tbody').disableSelection();

</script>
<!--{subtemplate tool:footer}-->