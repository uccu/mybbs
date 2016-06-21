<!--{subtemplate adminloader:_header}-->
<div class="panel panel-default">
    <div class="panel-body">
        <form id="form" class="form-horizontal" data-default="{g.plugin}/{g.control}/get_{g.method}/{id}">
            <div class="form-group">
                <label class="control-label col-sm-2">SID</label>
                <div class="col-sm-2">
                    <input type="text" disabled class="form-control" name="sid">
                </div>
            </div>    
            <div class="form-group">
                <label class="control-label col-sm-2">缩略图</label>
                <div class="col-sm-4">
                    <input type="file" id="pic" data-circle="0" data-box="recommend" />
                    <p class="help-block"></p>
                    <img id="pic_pic" class='img-responsive' style="width:100px"  />
                    <input class="form-control" name="pic" type="text" value="" disabled="disabled"/>
                    <input name="pic" type="hidden" value=""/>
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