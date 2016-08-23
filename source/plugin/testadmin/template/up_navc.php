<!--{subtemplate adminloader:_header}-->
<form id="form" data-default="{g.plugin}/api/get_navc/{id}">
    <div class="form-group">
        <input type="hidden" name="tid" value="{id}">
        <input type="hidden" name="sid" value="{sid}">
    </div>
    <div class="form-group">
        <label>分类名字</label>
        <input type="text" class="form-control"  name="name">
    </div>
    <div class="form-group">
        <label>优先级</label>
        <input type="text" class="form-control"  name="pos">
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-success insave t" for="form" data-action="_{g.plugin}/api/set_navc/{id}">保存</button>
    </div>
</form>

<!--{subtemplate adminloader:_footer}-->