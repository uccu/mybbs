<!--{subtemplate adminloader:_header}-->
<div class="panel panel-default">
    <div class="panel-body">
        <form id="form" class="form-horizontal" data-default="{g.plugin}/{g.control}/get_{g.method}/{uid}">
            <div class="form-group">
                <label class="control-label col-sm-2">用户ID</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" disabled name="uid">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">手机</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" disabled name="phone">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">昵称</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="nickname">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">地区</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="area">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">年龄</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="age">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">星座</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="constel">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">兴趣</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="interest">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">状态</label>
                <div class="col-sm-6">
                    <select class="form-control" name="sign">
                        <option selected=“selected” value="0">普通用户</option>
                        <option value="1">签约明星</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">重置密码</label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" name="password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-1">
                    <button type="button" class="btn btn-success insave t" for="form" data-action="{g.plugin}/{g.control}/save_{g.method}/{uid}">保存</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!--{subtemplate adminloader:_footer}-->