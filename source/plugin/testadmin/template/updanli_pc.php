<!--{subtemplate adminloader:_header}-->
<form id="form" data-default="{g.plugin}/api/get_anli_pc/{id}">
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
        <label>网址</label>
        <input type="text" class="form-control"  name="website">
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-success insave t" for="form" data-action="_{g.plugin}/api/set_anli_pc/{id}">保存</button>
    </div>
</form>

<!--{subtemplate adminloader:_footer}-->