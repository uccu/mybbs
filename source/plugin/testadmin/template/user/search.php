<!--{subtemplate adminloader:_header}-->
<div class="panel panel-default">
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="{g.plugin}/{g.control}/lists">
            <div class="form-group">
                <label class="control-label col-sm-2">用户ID</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="uid">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">用户名</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="nickname">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">手机号</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="phone">
                </div>
            </div>
            <!--<div class="form-group">
                <label class="control-label col-sm-2">团队名</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="name">
                </div>
            </div>-->
            <div class="form-group">
                <label class="control-label col-sm-2">团队ID</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="tid">
                </div>
                <div class="col-sm-1">
                    <span class="pa cp" style="left:0;top:7px" data-toggle="tooltip" data-placement="bottom" title="团队里可查询到ID">?</span>
                    <script>j('[data-toggle="tooltip"]').tooltip()</script>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-1">
                    <button type="submit" class="btn btn-default">搜索</button>
                </div>
            </div>
        </form>



    </div>
</div>
<!--{subtemplate adminloader:_footer}-->