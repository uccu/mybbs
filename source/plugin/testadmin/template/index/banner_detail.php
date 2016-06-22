<!--{subtemplate adminloader:_header}-->
<div class="panel panel-default">
    <div class="panel-body">
        <form id="form" class="form-horizontal" data-default="{g.plugin}/{g.control}/get_{g.method}/{id}">
            <div class="form-group">
                <label class="control-label col-sm-2">BID</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="bid">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">标题</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="title">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">内容</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="content" rows=5></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">图片</label>
                <div class="col-sm-4">
                    <input type="file" id="pic" data-raw="1" data-box="banner" data-small="1"/>
                    <p class="help-block"></p>
                    <img id="pic_pic" class='img-responsive' />
                    <input class="form-control" name="pic" type="text" value="" disabled="disabled"/>
                    <input name="pic" type="hidden" value=""/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">按钮文字</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="button">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">链接目标</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="href">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-1">
                    <button type="button" class="btn btn-success insave t" for="form" data-action="{g.plugin}/{g.control}/save_{g.method}/{id}">保存</button>
                </div>
            </div>
        </form>
        
    </div>
</div>


<!--{subtemplate adminloader:_footer}-->