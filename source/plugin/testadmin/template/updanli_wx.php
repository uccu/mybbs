<!--{subtemplate adminloader:_header}-->
<form id="form" data-default="{g.plugin}/api/get_anli_wx/{id}">
    <div class="form-group">
        <input type="hidden" name="aid" value="{id}">
    </div>
    <div class="form-group">
        <label>文字1</label>
        <input type="text" class="form-control"  name="prama1">
    </div>
    <div class="form-group">
        <label>文字2</label>
        <input type="text" class="form-control"  name="prama2">
    </div>
    <div class="form-group">
        <label>支持</label>
        <input type="text" class="form-control"  name="suport">
    </div>
    <div class="form-group">
        <label>下载</label>
        <input type="text" class="form-control"  name="download">
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-success insave t" for="form" data-action="_{g.plugin}/api/set_anli_wx/{id}">保存</button>
    </div>
</form>

<!--{subtemplate adminloader:_footer}-->